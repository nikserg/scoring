<?php
namespace App\Form\DataTransformer;
use App\Util\Phone;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class PhoneTransformer
 *
 * Храним телефон в формате 8##########
 * Выводим в формате 8 (###) ###-##-##
 *
 * @package App\Form\DataTransformer
 */
class PhoneTransformer implements DataTransformerInterface {
    /**
     * @param string $phone
     * @return mixed
     */
    public function transform($phone)
    {
        return $phone;
    }

    public function reverseTransform($phone)
    {
        return Phone::normalize($phone);
    }
}