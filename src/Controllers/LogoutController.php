<?php
declare(strict_types=1);
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\AdminAuthSettings\Controllers;

use App\Controllers\Admin\BaseController;

class LogoutController extends BaseController
{
    protected $helpers = ['auth'];
    
    public function index()
    {
        auth_logout('admin');

        return redirect()->to(site_url('admin'))->withCookies();
    }
}
