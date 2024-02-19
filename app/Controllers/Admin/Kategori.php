<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
        $authentication = service('authentication');
        $user           = $authentication->user();
        $img            = $authentication->user();
        $kategori       = new KategoriModel();
        $kategori            = $kategori->get_all_tbl_kategori();

        $data = [
            'validation'    => \Config\Services::validation(),
            'title'         => 'Kategori',
            'title_page'    => 'Kategori Transaksi',
            'user'          => $user,
            'img'           => $img,
            'kategori'      => $kategori,
            'content'       => 'Admin/Kategori/index',
        ];

        echo view('Admin/Layout/wrapper', $data);
    }

    public function add()
    {
        helper(['form', 'url']);
        $kategori = new KategoriModel();

        // Memeriksa apakah input nama_kategori kosong
        $nama_kategori = $this->request->getPost('nama_kategori');
        if (empty($nama_kategori)) {
            // Mengembalikan respon JSON dengan status false dan pesan validasi
            echo json_encode(array("status" => FALSE, "message" => "Nama kategori harus diisi"));
            return;
        }

        $data = array(
            'nama_kategori' => $nama_kategori,
        );

        // Melakukan penyisipan data ke dalam database
        $insert = $kategori->kategori_add($data);

        // Mengembalikan respon JSON dengan status true jika penyisipan berhasil
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $kategori = new KategoriModel();
        $data = $kategori->get_by_id($id);

        echo json_encode($data);
    }

    public function update()
    {
        helper(['form', 'url']);
        $kategori = new KategoriModel();

        $data = array(
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        );

        $kategori->update(array('id' => $this->request->getPost('id')), $data);

        echo json_encode(array("status" => TRUE));
    }



    public function delete($id)
    {
        helper(['form', 'url']);

        $Kategori = new KategoriModel();

        $Kategori->delete_by_id($id);

        echo json_encode(array("status" => TRUE));
    }
}
