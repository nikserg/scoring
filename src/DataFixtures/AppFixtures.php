<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
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
     * @var Generator
     */
    protected $faker;
    /**
     * @var \Faker\Provider\ru_RU\Person
     */
    protected $person;

    public function __construct(Generator $faker, Person $person)
    {
        $this->faker = $faker;
        $this->person = $person;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<self::AMOUNT; $i++)
        {
            $user = new User();
            $user->setEmail($this->faker->email);
            //Фиксируем случайный пол
            $gender = rand(0, 1) ? Person::GENDER_FEMALE : Person::GENDER_MALE;
            //Имя и фамилия, в зависимости от пола
            $user->setFirstName($this->person->firstName($gender));
            $user->setLastName($this->person->lastName($gender));
            //Генерируем телефон в наиболее коротком варианте
            $user->setPhone($this->faker->numerify('8##########'));
            //Образование
            $user->setGrade($this->faker->randomKey(User\Grade::NAMES));
            //Согласие на обработку данных
            $user->setPersonalData($this->faker->boolean);

            //Сохраняем
            $manager->persist($user);
        }

        $manager->flush();
    }
}
