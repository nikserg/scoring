<?php

namespace App\Command;

use App\Entity\User;
use App\Form\RegisterType\GradeType;
use App\Repository\UserRepository;
use App\Service\ScorerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Команда подсчета скоринга
 *
 *
 * @package App\Command
 */
class ScoreCommand extends Command
{
    protected static $defaultName = 'app:score';

    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var ScorerInterface
     */
    protected $scorer;
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * ScoreCommand constructor.
     * @param UserRepository $userRepository
     * @param ScorerInterface $scorer
     * @param EntityManagerInterface $entityManager
     * @param string|null $name
     */
    public function __construct(UserRepository $userRepository, ScorerInterface $scorer, EntityManagerInterface $entityManager, string $name = null)
    {
        $this->userRepository = $userRepository;
        $this->scorer = $scorer;
        $this->entityManager = $entityManager;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setDescription('Подсчет значения скоринга');
        $this->addArgument('id', InputArgument::OPTIONAL, 'ID пользователя для подсчета. Если не задан, пересчет для всех пользователей');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws EntityNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($id = $input->getArgument('id')) {
            $output->writeln('Пересчет скоринга для пользователя #' . $id);
            $user = $this->userRepository->find($id);
            if (!$user) {
                throw new EntityNotFoundException('Не найден пользователь #'.$id);
            }
            $user->setScore($this->scorer->score($user, $output));
            $this->entityManager->persist($user);
        } else {
            $output->writeln('Пересчет скоринга для всех пользователей');
            $total = $this->userRepository->count([]);
            foreach ($this->userRepository->findAll() as $index => $user) {
                $output->writeln($index + 1 . '/' . $total . ' Пользователь #' . $user->getId());
                $user->setScore($this->scorer->score($user, $output));
                $this->entityManager->persist($user);
                $output->writeln('***');
            }
        }
        $output->writeln('Запись изменений в БД...');
        $this->entityManager->flush();
        $output->writeln('Готово.');
        return 0;
    }


}