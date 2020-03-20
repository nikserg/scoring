<?php
/**
 * Created by PhpStorm.
 * User: n.zarubin
 * Date: 20.03.2020
 * Time: 12:59
 */
namespace App\Entity\User;

/**
 * Образование
 *
 * @package App\Entity\User
 */
class Grade {
    const HIGH_SCHOOL = 'high_school';
    const SPECIAL = 'special';
    const HIGHER = 'higher';

    const NAMES = [
        self::HIGH_SCHOOL => 'Среднее',
        self::SPECIAL => 'Специальное',
        self::HIGHER => 'Высшее',
    ];
}