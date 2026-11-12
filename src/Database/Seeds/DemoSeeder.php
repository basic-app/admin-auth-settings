<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\AdminAuthSettings\Database\Seeds;

use BasicApp\Core\Seeder;
use BasicApp\AdminAuthSettings\Settings\AdminAuthSettings;

class DemoSeeder extends Seeder
{
    public function run()
    {
        helper(['admin_auth_settings']);
        
        service('settings')->setMany([
            'AdminAuthSettings.login' => 'admin',
            'AdminAuthSettings.password_hash' => admin_auth_settings_encode_password('admin')
        ]);
    }
}
