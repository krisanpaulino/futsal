<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table            = 'notifikasi';
    protected $primaryKey       = 'notifikasi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'transaksi_id',
        'notifikasi_tanggal',
        'notifikasi_isi',
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
        'transaksi_id' => 'required',
        'notifikasi_tanggal' => 'required',
        'notifikasi_isi' => 'required',
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

    function getNotifikasiAdmin($status = 'Butuh Verifikasi')
    {
        $this->join('transaksi', 'transaksi.transaksi_id = notifikasi.transaksi_id');
        $this->where('transaksi.status', $status);
        $this->where('notifikasi.status', 'terkirim');
        return $this->find();
    }
    function getNotifikasiPelanggan($pelanggan_id, $status = 'Sudah Bayar')
    {
        $this->join('transaksi', 'transaksi.transaksi_id = notifikasi.transaksi_id');
        $this->where('transaksi.pelanggan_id', $pelanggan_id);
        $this->where('transaksi.status', $status);
        $this->where('notifikasi.status', 'terkirim');
        return $this->find();
    }
    function read($id)
    {
        $this->where('notifikasi_id', $id);
        $this->set('status', 'terbaca');
        return $this->update();
    }
}
