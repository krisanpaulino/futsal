<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'pelanggan_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pelanggan_nama',
        'pelanggan_telepon',
        'pelanggan_email',
        'user_id',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'pelanggan_nama' => 'required',
        'pelanggan_telepon' => 'required',
        'pelanggan_email' => 'required',
        'user_id' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
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

    function findPelanggan()
    {
        $this->select('pelanggan.*, count(transaksi.transaksi_id) as jumlah_transaksi');
        $this->join('user', 'user.user_id = pelanggan.user_id');
        $this->join('transaksi', 'transaksi.pelanggan_id = pelanggan.pelanggan_id');
        $this->groupBy('pelanggan.pelanggan_id');
        return $this->find();
    }
}
