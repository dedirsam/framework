<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BriModel;

class Warung extends BaseController
{
    public function index()
    {
        $authentication = service('authentication');
        $user           = $authentication->user();
        $img            = $authentication->user();
        $bri            = new BriModel();
        $saldo          = $bri->get_saldo_bri();

        $data = [
            'title'     => 'Dashboard Warung',
            'user'      => $user,
            'img'       => $img,
            'saldo'     => $saldo,
            'content'   => 'Admin/Warung/index',
        ];

        echo view('Admin/Layout/wrapper', $data);
    }
}
