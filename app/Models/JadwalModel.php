<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'jadwal_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'transaksi_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'status',
        'harga'
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
        'tanggal' => 'required',
        'waktu_mulai' => 'required',
        'waktu_selesai' => 'required',
        'status' => 'required',
        'harga' => 'required'
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

    function byTransaksi($id)
    {
        $this->where('transaksi_id', $id);
        return $this->find();
    }
    function tampilDepan($pelanggan_id = null)
    {
        $this->select('jadwal.*, pelanggan.*');
        $this->join('transaksi', 'jadwal.transaksi_id = transaksi.transaksi_id');
        $this->join('pelanggan', 'transaksi.pelanggan_id = pelanggan.pelanggan_id');
        $this->where('transaksi.status', 'Sudah Bayar');
        $this->where('jadwal.status !=', 'Selesai', true);
        $this->where('jadwal.tanggal >=', date('Y-m-d'), true);
        if ($pelanggan_id != null)
            $this->where('transaksi.pelanggan_id', $pelanggan_id);
        $this->orderBy('jadwal.tanggal', 'desc');
        return $this->find();
    }
    function tampilRiwayat($pelanggan_id = null)
    {
        $this->select('jadwal.*, pelanggan.*');
        $this->join('transaksi', 'jadwal.transaksi_id = transaksi.transaksi_id');
        $this->join('pelanggan', 'transaksi.pelanggan_id = pelanggan.pelanggan_id');
        $this->where('transaksi.status', 'Sudah Bayar');
        $this->where('jadwal.status', 'Selesai', true);
        if ($pelanggan_id != null)
            $this->where('transaksi.pelanggan_id', $pelanggan_id);
        $this->orderBy('jadwal.tanggal', 'desc');
        return $this->find();
    }
    function getAll()
    {
        $this->select('jadwal.*, pelanggan.*');
        $this->join('transaksi', 'jadwal.transaksi_id = transaksi.transaksi_id');
        $this->join('pelanggan', 'transaksi.pelanggan_id = pelanggan.pelanggan_id');
        $this->where('transaksi.status', 'Sudah Bayar');
        // $this->where('jadwal.status !=', 'Selesai', true);
        $this->where('jadwal.tanggal >=', date('Y-m-d'), true);
        $this->orderBy('jadwal.tanggal', 'desc');
        return $this->find();
    }
    function getToday($count = false)
    {
        $this->select('jadwal.*, pelanggan.*');
        $this->join('transaksi', 'jadwal.transaksi_id = transaksi.transaksi_id');
        $this->join('pelanggan', 'transaksi.pelanggan_id = pelanggan.pelanggan_id');
        $this->where('transaksi.status', 'Sudah Bayar');
        $this->where('jadwal.status !=', 'Selesai', true);
        $this->where('jadwal.tanggal', date('Y-m-d'), true);
        $this->orderBy('jadwal.waktu_mulai', 'asc');
        if ($count == true)
            return $this->countAllResults();
        return $this->find();
    }
    function getSelesai()
    {
        $this->select('jadwal.*, pelanggan.*');
        $this->join('transaksi', 'jadwal.transaksi_id = transaksi.transaksi_id');
        $this->join('pelanggan', 'transaksi.pelanggan_id = pelanggan.pelanggan_id');
        $this->where('transaksi.status', 'Sudah Bayar');
        $this->where('jadwal.status', 'Selesai', true);
        $this->orderBy('jadwal.waktu_mulai', 'asc');
        return $this->find();
    }

    function isKosong($tanggal, $waktu_mulai, $waktu_selesai)
    {
        $this->where('tanggal', $tanggal);
        $this->groupStart();
        $this->groupStart();
        $this->where('waktu_mulai <=', $waktu_mulai, true)
            ->Where('waktu_selesai >', $waktu_mulai, true)
            ->groupEnd();
        $this->orGroupStart();
        $this->where('waktu_mulai <', $waktu_selesai, true)
            ->where('waktu_selesai >=', $waktu_selesai, true)
            ->groupEnd()
            ->groupEnd();
        $result = $this->first();
        // $result = $this->builder()->getCompiledSelect();
        if ($result == null)
            return true;
        return false;
        // return $result;
    }
}
