<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $authentication = service('authentication');
        $user = $authentication->user();
        $img = $authentication->user();

        $data = [
            'title' => 'Dashboard Aplikasi',
            'user' => $user,
            'img' => $img,
            'content'    => 'Admin/Dashboard/index',
        ];

        echo view('Admin/Layout/wrapper', $data);
    }
}
