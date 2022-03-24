<?php

namespace App\Validations;

class CustomRules
{
    function check_old_password(string $str, string &$error = null): bool
    {
        $model = new \App\Models\AdminModel;
        if (empty($str)) {
            return true;
        }

        $username = session()->get('akun_username');
        $dataModel = $model->getData($username);

        $password = $dataModel['password'];

        if (password_verify($str, $password)) {
            return true;
        } else {
            return false;
        }
    }
}
