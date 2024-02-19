<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'tbl_kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kategori'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = true;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function get_all_tbl_kategori()
    {

        //       $query = $this->db->table('tbl_kategori');

        $query = $this->db->query('select * from tbl_kategori');

        //      print_r($query->getResult());

        // $query = $this->db->get();

        return $query->getResult();
    }



    public function get_by_id($id)
    {

        $sql = 'select * from tbl_kategori where id =' . $id;

        $query =  $this->db->query($sql);



        return $query->getRow();
    }



    public function kategori_add($data)
    {



        $query = $this->db->table($this->table)->insert($data);



        return $this->db->insertID();
    }



    public function book_update($where, $data)
    {

        $this->db->table($this->table)->update($data, $where);

        //        print_r($this->db->getLastQuery());

        return $this->db->affectedRows();
    }



    public function delete_by_id($id)
    {

        $this->db->table($this->table)->delete(array('id' => $id));
    }
}
