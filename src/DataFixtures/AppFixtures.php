<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\Person;

/**
 * Class AppFixtures
 *
 * Генерирует тестовые записи для пользователей
 *
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    protected const AMOUNT = 100; //Количество записей для генерации

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager, Faker $faker)
    {
        //Предполагаем, что все пользовтели - русские
        $faker = Factory::create('ru_RU');

        //Генератор для чувствительных к полу имен
        $person = new \Faker\Provider\ru_RU\Person($faker);

        for ($i=0; $i<self::AMOUNT; $i++)
        {
            $user = new User();
            $user->setEmail($faker->email);
            //Фиксируем случайный пол
            $gender = rand(0, 1) ? Person::GENDER_FEMALE : Person::GENDER_MALE;
            $user->setFirstName($person->firstName($gender));
            $user->setLastName($person->lastName($gender));
            //Генерируем телефон в наиболее коротком варианте
            $user->setPhone($faker->numerify('8##########'));
            $user->setGrade($faker->randomKey(User\Grade::NAMES));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
