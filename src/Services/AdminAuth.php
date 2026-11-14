<?php
declare(strict_types=1);
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\AdminAuthSettings\Services;

use BasicApp\AdminAuth\Config\AdminAuth as AdminAuthConfig;
use BasicApp\AdminAuth\Interfaces\AdminInterface;
use BasicApp\AdminAuthSettings\Settings\AdminAuthSettings;

class AdminAuth implements AdminInterface
{
    protected AdminAuthConfig $authConfig;

    protected AdminAuthSettings $authSettings;

    public function __construct(AdminAuthConfig $authConfig)
    {
        $this->authConfig = $authConfig;

        $this->authSettings = new AdminAuthSettings;
    }

    public function getAdminName(): ?string
    {
        return $this->authSettings->login;
    }

    public function getAdminEmail(): ?string
    {
        return $this->authSettings->email;
    }

    public function getAdminAvatarImageUrl(?string $default = null): ?string
    {
        if ($this->authSettings->avatar_image_path)
        {
            return base_url($this->authSettings->avatar_image_path);
        }

        return $default ? base_url($default) : null;
    }

    public function getAdminLogoutUrl(): ?string
    {
        return site_url('admin/logout');
    }

    public function getAdminAccountMenu(): array
    {
        return [
            'auth-settings' => [
                'label' => lang('Admin.Settings'),
                'url' => site_url('admin/auth-settings'),
                'icon' => 'fa-user'
            ]
        ];
    }
}
