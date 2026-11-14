<?php
declare(strict_types=1);
/**
 * @author Basic App Dev Team
 * @license MIT
 */
use CodeIgniter\Router\RouteCollection;

if (!function_exists('admin_auth_settings_routes'))
{
    function admin_auth_settings_routes(RouteCollection $routes)
    {
        $routes->match(
            ['GET', 'POST'], 
            'admin/login', 
            '\BasicApp\AdminAuthSettings\Controllers\LoginController::index'
        );

        $routes->post(
            'admin/logout', 
            '\BasicApp\AdminAuthSettings\Controllers\LogoutController::index'
        );

        $routes->match(
            ['GET', 'POST'], 
            'admin/auth-settings', 
            '\BasicApp\AdminAuthSettings\Controllers\AuthSettingsController::index'
        );
    }
}

if (!function_exists('admin_auth_settings_encode_password'))
{
    function admin_auth_settings_encode_password(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}

if (!function_exists('admin_auth_settings_validate_password'))
{
    function admin_auth_settings_validate_password(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }
}
