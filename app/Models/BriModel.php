<?php

namespace App\Models;

use CodeIgniter\Model;

class BriModel extends Model
{
    protected $table            = 'tbl_bri';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [''];

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

    public function get_all_tbl_bri()
    {
        $query = $this->db->query('select * from tbl_bri');
        return $query->getResult();
    }

    public function get_saldo_bri()
    {
        $query = $this->db->query('SELECT sal_end FROM tbl_bri ORDER BY id DESC LIMIT 1');
        $row = $query->getRow();
        if ($row) {
            return $row->sal_end;
        } else {
            return 0; // Jika tidak ada data, kembalikan nilai default
        }
    }

    public function get_by_id($id)
    {
        $sql = 'select * from tbl_bri where id =' . $id;
        $query =  $this->db->query($sql);
        return $query->getRow();
    }

    public function isi($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    // public function kategori_add($data)
    // {
    //     $query = $this->db->table($this->table)->insert($data);
    //     return $this->db->insertID();
    // }

    public function rubah($where, $data)
    {
        $this->db->table($this->table)->update($data, $where);
        return $this->db->affectedRows();
    }

    // public function delete_by_id($id)
    // {
    //     $this->db->table($this->table)->delete(array('id' => $id));
    // }
}
