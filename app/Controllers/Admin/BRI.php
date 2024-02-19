<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BriModel;

class BRI extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
        $authentication = service('authentication');
        $user           = $authentication->user();
        $img            = $authentication->user();
        $bri            = new BriModel();
        $bri_           = $bri->get_all_tbl_bri();
        $saldo          = $bri->get_saldo_bri();

        $data = [
            'title'         => 'BRI',
            'title_page'    => 'Transaksi BRI',
            'user'          => $user,
            'img'           => $img,
            'bri'           => $bri_,
            'saldo'         => $saldo,
            'content'       => 'Admin/BRI/index',
        ];

        echo view('Admin/Layout/wrapper', $data);
    }

    public function isi()
    {
        helper(['form', 'url']);
        $bri = new BriModel();

        $sal_in = $this->request->getPost('sal_in');
        if (empty($sal_in)) {
            echo json_encode(array("status" => FALSE, "message" => "Saldo harus diisi"));
            return;
        }

        $data = array(
            'sal_in' => $sal_in,
        );

        $insert = $bri->isi($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $bri = new BriModel();
        $data = $bri->get_by_id($id);

        echo json_encode($data);
    }

    public function rubah()
    {
        helper(['form', 'url']);
        $bri = new BriModel();

        $data = array(
            'sal_end' => $this->request->getPost('sal_end'),
        );

        $bri->update(array('id' => $this->request->getPost('id')), $data);

        echo json_encode(array("status" => TRUE));
    }


    // public function add()
    // {
    //     helper(['form', 'url']);
    //     $kategori = new KategoriModel();

    //     // Memeriksa apakah input nama_kategori kosong
    //     $nama_kategori = $this->request->getPost('nama_kategori');
    //     if (empty($nama_kategori)) {
    //         // Mengembalikan respon JSON dengan status false dan pesan validasi
    //         echo json_encode(array("status" => FALSE, "message" => "Nama kategori harus diisi"));
    //         return;
    //     }

    //     $data = array(
    //         'nama_kategori' => $nama_kategori,
    //     );

    //     // Melakukan penyisipan data ke dalam database
    //     $insert = $kategori->kategori_add($data);

    //     // Mengembalikan respon JSON dengan status true jika penyisipan berhasil
    //     echo json_encode(array("status" => TRUE));
    // }



    // public function update()
    // {
    //     helper(['form', 'url']);
    //     $kategori = new KategoriModel();

    //     $data = array(
    //         'nama_kategori' => $this->request->getPost('nama_kategori'),
    //     );

    //     $kategori->update(array('id' => $this->request->getPost('id')), $data);

    //     echo json_encode(array("status" => TRUE));
    // }



    // public function delete($id)
    // {
    //     helper(['form', 'url']);

    //     $Kategori = new KategoriModel();

    //     $Kategori->delete_by_id($id);

    //     echo json_encode(array("status" => TRUE));
    // }
}
