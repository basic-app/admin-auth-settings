<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\AdminAuthSettings\Rules;

use BasicApp\AdminAuthSettings\Settings\AdminAuthSettings;

class AdminAuthSettingsRules
{
    public function admin_auth_settings_login(
        $value,
        string $param,
        array $data,
        &$error = null,
        &$field = null) : bool {

        if ($value != service('adminAuth')->login)
        {
            $error = lang('Admin.Invalid login or password.');

            return false;
        }

        return true;
    }

    public function admin_auth_settings_password(
        $value,
        string $param,
        array $data,
        &$error = null,
        &$field = null) : bool {
        
        helper(['admin_auth_settings']);

        if (!admin_auth_settings_validate_password($value, (string) service('adminAuth')->password_hash))
        {
            $error = lang('Admin.Invalid login or password.');

            $field = 'login';

            return false;
        }

        return true;
    }
}