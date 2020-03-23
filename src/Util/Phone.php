<?php
namespace App\Util;

/**
 * Библиотека для работы с телефонами
 *
 *
 * @package App\Util
 */
class Phone {
    //
    // Возможные операторы связи
    //
    const MTS = 'МТС';
    const BEELINE = 'Билайн';
    const MEGAFON = 'Мегафон';
    const OTHER = 'Другой';

    //
    // Коды операторов связи
    //
    private const MTS_CODES = ['901', '902', '904', '908', '910', '911', '912', '913', '914', '915', '916', '917', '918', '919', '950', '978', '980', '981', '982', '983', '984', '985', '986', '987', '988', '989'];
    private const BEELINE_CODES = ['900', '902', '903', '904', '905', '906', '908', '909', '950', '951', '953', '960', '961', '962', '963', '964', '965', '966', '967', '968', '969', '980', '983', '986'];
    private const MEGAFON_CODES = ['902', '904', '908', '920', '921', '922', '923', '924', '925', '926', '927', '928', '929', '930', '931', '932', '933', '934', '936', '937', '938', '939', '950', '951', '999'];

    /**
     * Список всех возможных кодов операторов
     *
     *
     * @return string[]
     */
    public static function allCodes()
    {
        return array_merge(self::MTS_CODES, self::BEELINE_CODES, self::MEGAFON_CODES);
    }

    /**
     * Нормализовать телефон в формат 8#########
     *
     * @param string $phone
     * @return string
     */
    public static function normalize($phone) {
        if (!$phone) {
            return $phone;
        }
        if (substr('+7', $phone) === 0) {
            $phone = str_replace('+7', '8', $phone);
        }
        $phone = preg_replace('/\D/', '', $phone);
        return $phone;
    }

    /**
     * Определяет оператора сотовой связи по номеру телефона
     *
     *
     * @param string $phone
     * @return string
     */
    public static function detect($phone) {
        $phone = self::normalize($phone);
        //Код оператора
        $code = substr($phone, 1, 3);
        if (in_array($code, self::BEELINE_CODES)) {
            return self::BEELINE;
        }
        if (in_array($code, self::MTS_CODES)) {
            return self::MTS;
        }
        if (in_array($code, self::MEGAFON_CODES)) {
            return self::MEGAFON;
        }
        return self::OTHER;
    }

}