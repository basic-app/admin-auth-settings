<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\AdminAuthSettings\Settings;

use BasicApp\Core\SettingsEntity;
use BasicApp\AdminAuth\Interfaces\AdminInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
use BasicApp\Core\Traits\Upload;
use BasicApp\Core\Traits\UnlinkChanged;

class AdminAuthSettings extends SettingsEntity implements AdminInterface
{
    use Upload, UnlinkChanged;

    protected $attributes = [
        'login' => null,
        'password_hash' => null,
        'avatar_image_path' => null,
        'avatar_image_original_name' => null
    ];

    public function rules() : array
    {
        return [
            'login' => [
                'label' => 'Admin.Login',
                'rules' => ['max_length[255]', 'required']
            ],
            'new_password' => [
                'label' => 'Admin.Password',
                'rules' => ['max_length[255]', 'permit_empty']
            ],
            'avatar_image' => [
                'label' => 'Admin.Avatar Image',
                'rules' => ['permit_empty', 'uploaded', 'is_image']
            ],
            'avatar_image_clear' => [
                'rules' => 'permit_empty'
            ]
        ];
    }

    public function fill(?array $data = null)
    {
        if (!empty($data['new_password']))
        {
            helper(['admin_auth_settings']);
            
            $data['password_hash'] = admin_auth_settings_encode_password($data['new_password']);
        }

        unset($data['new_password']);

        parent::fill($data);
    }

    public function getAdminName() : ?string
    {
        return $this->login;
    }

    public function getAdminEmail() : ?string
    {
        return null;
    }

    public function getAdminAvatarImageUrl(?string $default = null) : ?string
    {
        if ($this->avatar_image_path)
        {
            return base_url($this->avatar_image_path);
        }

        return $default ? base_url($default) : null;
    }

    public function getAdminLogoutUrl() : ?string
    {
        return site_url('admin/logout');
    }

    public function getAdminAccountMenu() : array
    {
        return [
            'auth-settings' => [
                'label' => lang('Admin.Settings'),
                'url' => site_url('admin/auth-settings'),
                'icon' => 'fa-user'
            ]
        ];
    }

    public function setAvatarImage(UploadedFile $image)
    {
        if ($image->isValid())
        {
            $this->avatar_image_path = $this->upload($image, 'uploads/avatars');

            $this->avatar_image_original_name = $image->getClientName();
        }
    }

    public function setAvatarImageClear($value)
    {
        if ($value == 1)
        {
            $this->avatar_image_path = null;
            
            $this->avatar_image_original_name = null;
        }
    }

    public function save(&$errors = null) : bool
    {
        $return = parent::save($errors);

        if ($return)
        {
            $this->unlinkChanged(['avatar_image_path']);
        }

        return $return;
    }
}