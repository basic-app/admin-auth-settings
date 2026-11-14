<?php
declare(strict_types=1);
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\AdminAuthSettings\Controllers;

use CodeIgniter\Files\File;
use BasicApp\AdminAuthSettings\Settings\AdminAuthSettings;
use App\Controllers\Admin\BaseController;

class AuthSettingsController extends BaseController
{
    protected function initialize()
    {
        helper(['form']);
    }

    public function index()
    {
        $data = new AdminAuthSettings;

        if ($this->request->is('post'))
        {
            if ($this->validateData($this->request->getPost(), $data->rules()))
            {
                $data->fill(array_merge(
                    $this->validator->getValidated(), [
                        'avatar_image' => $this->request->getFile('avatar_image')
                    ]
                ));

                $data->save();

                $this->session->setFlashdata('success', lang('Admin.Data saved successfully.'));
                    
                return redirect()->to('admin/auth-settings');
            }
            else
            {
                $errors = $this->validator->getErrors();
            }
        }

        return view('BasicApp\AdminAuthSettings\auth-settings/index', [
            'data' => $data,
            'labels' => $data->labels(),
            'errors' => $errors ?? []
        ]);
    }
}