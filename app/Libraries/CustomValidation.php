<?php
declare(strict_types = 1);

namespace App\Libraries;

use App\Entities\UserEntity;
use App\Models\UserModel;

class CustomValidation
{
    public function validate_password(string $str, string $username, array $data, string &$error = null): bool
    {
        /** @var UserModel $userModel */
        $userModel = model('App\Models\UserModel');
        /** @var UserEntity $user */
        $user = $userModel->getUserByUsername($data[$username]);
        if (empty($user) || !$user->verifyPassword($str)) {
            $error = 'Wrong username or password';

            return false;
        }

        return true;
    }
}
