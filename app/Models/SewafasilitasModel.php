<?php

namespace App\Models;

use CodeIgniter\Model;

class SewafasilitasModel extends Model
{
    protected $table            = 'sewafasilitas';
    protected $primaryKey       = 'sewafasilitas_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'fasilitas_id',
        'transaksi_id',
        'jumlah_sewa',
        'jumlah_jam',
        'sub_total',
        'status',
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
        'fasilitas_id' => 'required',
        'transaksi_id' => 'required',
        'jumlah_sewa' => 'required',
        'jumlah_jam' => 'required',
        'sub_total' => 'required',
        'status' => 'required',
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

    function getDetail($transaksi_id)
    {
        $this->join('fasilitas', 'fasilitas.fasilitas_id = sewafasilitas.fasilitas_id');
        $this->join('transaksi', 'transaksi.transaksi_id = sewafasilitas.transaksi_id');
        $this->where('sewafasilitas.transaksi_id', $transaksi_id);
        $this->orderBy('transaksi.tanggal_pesan', 'desc');
        return $this->find();
    }
}
