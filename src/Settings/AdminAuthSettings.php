<?php
declare(strict_types=1);
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\AdminAuthSettings\Settings;

use BasicApp\Settings\SettingsEntity;
use CodeIgniter\HTTP\Files\UploadedFile;
use BasicApp\Core\Traits\Upload;
use BasicApp\Core\Traits\UnlinkChanged;

class AdminAuthSettings extends SettingsEntity
{
    use Upload, UnlinkChanged;

    protected $attributes = [
        'login' => null,
        'email' => null,
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
            'email' => [
                'label' => 'Admin.E-mail',
                'rules' => ['max_length[255]', 'valid_email', 'required']
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