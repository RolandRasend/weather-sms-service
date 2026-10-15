<?php
declare(strict_types=1);

namespace App\Helper;

use App\Model\ErrorReasonDTO;

/**
 * @author      robertthieme
 * @since       15.10.26
 */
class PasswordStrength
{
    public function checkStrength(string $password): ErrorReasonDTO
    {
        $errorReason = new ErrorReasonDTO();
        $byteLength = strlen($password);
        $charLength = mb_strlen($password);
        $errorReason->setTooLong($byteLength > 1000);
        //sub 8 passwords are unsafe; values above 1000 can be handled with argon2 but are a DOS risk
        $errorReason->setHasMinimumLength($charLength >= 8);
        $errorReason->setSpecialCharacter(preg_match('/[^\p{L}\p{N}]/u', $password) == 1);
        foreach (preg_split('//u', $password, -1, PREG_SPLIT_NO_EMPTY) as $character) {
            if (!$errorReason->getHasNumber() && preg_match('/\p{N}/u', $character) === 1) {
                $errorReason->setHasNumber(true);
            }
            if (!$errorReason->getUppercase()) {
                $errorReason->setUppercase(preg_match('/\p{Lu}/u', $character) === 1);
            }
            if (!$errorReason->getLowercase()) {
                $errorReason->setLowercase(preg_match('/\p{Ll}/u', $character) === 1);
            }
        }

        return $errorReason;
    }

    public function generateReasonMessage(ErrorReasonDTO $DTO): string
    {
        $message = '';
        if ($DTO->getTooLong()) {
            $message .= 'Password must be 1000 bytes or shorter.' . PHP_EOL;
        }
        if (!$DTO->getHasNumber()) {
            $message .= 'No numbers provided.' . PHP_EOL;
        }
        if (!$DTO->getUppercase()) {
            $message .= 'No uppercase characters provided.' . PHP_EOL;
        }
        if (!$DTO->getLowercase()) {
            $message .= 'No lowercase characters provided.' . PHP_EOL;
        }
        if (!$DTO->getSpecialCharacter()) {
            $message .= 'No special characters provided.' . PHP_EOL;
        }
        if (!$DTO->getHasMinimumLength()) {
            $message .= 'Password is shorter than 8 characters.' . PHP_EOL;
        }

        return !empty($message) ?
        'Your provided password was not accepted and has the following issues:' . PHP_EOL . $message
        : $message;
    }
}