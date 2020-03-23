<?php
namespace App\Service;
use App\Entity\User;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface ScorerInterface
 * @package App\Services
 */
interface ScorerInterface {

    /**
     * Подсчитать значение скоринга для пользователя
     *
     * @param User $user
     * @param OutputInterface|null $output Если передан, выводит расшифровку скоринга
     * @return int
     */
    public function score(User $user, OutputInterface $output = null): int;
}