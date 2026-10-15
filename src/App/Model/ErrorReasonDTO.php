<?php
declare(strict_types=1);

namespace App\Model;

/**
 * @author      robertthieme
 * @since       15.10.26
 *
 * This DTO holds reasons why a password failed the check
 * a failed category will be set to "false"
 * all properties start out false and will be set true if requirement is met
 */
class ErrorReasonDTO
{
    private bool $hasMinimumLength = false;
    private bool $specialCharacter = false;
    private bool $uppercase = false;
    private bool $lowercase = false;
    private bool $number = false;
    private bool $tooLong = false;

    public function getHasNumber(): bool
    {
        return $this->number;
    }

    public function setHasNumber(bool $number): ErrorReasonDTO
    {
        $this->number = $number;
        return $this;
    }

    public function getUppercase(): bool
    {
        return $this->uppercase;
    }

    public function setUppercase(bool $uppercase): ErrorReasonDTO
    {
        $this->uppercase = $uppercase;
        return $this;
    }

    public function getSpecialCharacter(): bool
    {
        return $this->specialCharacter;
    }

    public function setSpecialCharacter(bool $specialCharacter): ErrorReasonDTO
    {
        $this->specialCharacter = $specialCharacter;
        return $this;
    }

    public function getHasMinimumLength(): bool
    {
        return $this->hasMinimumLength;
    }

    public function setHasMinimumLength(bool $hasMinimumLength): ErrorReasonDTO
    {
        $this->hasMinimumLength = $hasMinimumLength;
        return $this;
    }

    public function getLowercase(): bool
    {
        return $this->lowercase;
    }

    public function setLowercase(bool $lowercase): ErrorReasonDTO
    {
        $this->lowercase = $lowercase;
        return $this;
    }

    public function getTooLong(): bool
    {
        return $this->tooLong;
    }

    public function setTooLong(bool $tooLong): ErrorReasonDTO
    {
        $this->tooLong = $tooLong;
        return $this;
    }


}