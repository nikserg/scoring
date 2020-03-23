<?php
namespace App\Service;
use App\Entity\User;
use App\Util\Phone;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Скоринг по умолчанию
 *
 *
 * @package App\Services
 */
class DefaultScorer implements ScorerInterface {

    protected const MAIL_OTHER = 'Другой';
    protected const CRITERIA = [
        'phone' => [
            Phone::MEGAFON  => 10,
            Phone::BEELINE => 5,
            Phone::MTS => 3,
            Phone::OTHER => 1,
        ],
        'email' => [
            'gmail.com' => 10,
            'yandex.ru' => 8,
            'mail.ru' => 6,
            self::MAIL_OTHER => 3,
        ],
        'grade' => [
            User\Grade::HIGHER => 15,
            User\Grade::SPECIAL => 10,
            User\Grade::HIGH_SCHOOL => 5,
        ],
        'personal_data' => [
            true => 4,
            false => 0,
        ],
    ];

    public function score(User $user, OutputInterface $output = null): int
    {
        $score = 0;

        //Определяем оператора
        $opsos = Phone::detect($user->getPhone());
        $bonus = self::CRITERIA['phone'][$opsos];
        if ($output) {
            $output->writeln('Оператор: '.$opsos.', балл: +'.$bonus);
        }
        $score += $bonus;

        //Определяем ящик
        $domain = substr($user->getEmail(), strpos($user->getEmail(), '@') + 1);
        $domain = strtolower($domain);
        if (!isset(self::CRITERIA['email'][$domain])) {
            $domain = self::MAIL_OTHER;
        }
        $bonus = self::CRITERIA['email'][$domain];
        if ($output) {
            $output->writeln('Почтовый ящик: '.$domain.', балл: +'.$bonus);
        }
        $score += $bonus;


        //Образование
        $bonus = self::CRITERIA['grade'][$user->getGrade()];
        if ($output) {
            $output->writeln('Образование: '.User\Grade::NAMES[$user->getGrade()].', балл: +'.$bonus);
        }
        $score += $bonus;

        //Общий балл
        if ($output) {
            $output->writeln('Общий балл: '.$score);
        }
        return $score;
    }
}