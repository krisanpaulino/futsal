<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'transaksi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pelanggan_id',
        'tanggal_pesan',
        'tanggal_bayar',
        'bukti_bayar',
        'status',
        'total_bayar',
        'jenis',
        'nama_penyewa'
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
        // 'pelanggan_id' => 'required',
        'status' => 'required',
        'total_bayar' => 'required'
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

    function byPelanggan($pelanggan_id)
    {
        $this->select('transaksi.*, count(a.jadwal_id) as jumlah_jadwal, pelanggan.*, count(b.jadwal_id) as jumlah_selesai, feedback.feedback_id');
        $this->join('jadwal a', 'a.transaksi_id = transaksi.transaksi_id');
        $this->join('jadwal b', 'b.transaksi_id = transaksi.transaksi_id AND b.status="Selesai"', 'left');
        $this->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id');
        $this->join('feedback', 'feedback.transaksi_id = transaksi.transaksi_id', 'left');
        $this->where('transaksi.pelanggan_id', $pelanggan_id);
        $this->groupBy('transaksi.transaksi_id');
        $this->orderBy('transaksi.tanggal_pesan', 'desc');
        return $this->find();
    }
    function getSingle($transaksi_id)
    {
        $this->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id', 'left');
        $this->where('transaksi_id', $transaksi_id);
        return $this->first();
    }
    function getAll($jenis = null)
    {
        if ($jenis == 'Booking Lapangan') {
            $this->select('transaksi.*, pelanggan.pelanggan_nama, count(jadwal.jadwal_id) as jumlah');
            $this->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id', 'left');
            $this->join('jadwal', 'jadwal.transaksi_id = transaksi.transaksi_id', 'left');
        }
        if ($jenis == 'Sewa Fasilitas') {
            $this->select('transaksi.*, count(sewafasilitas.sewafasilitas_id) as jumlah');
            $this->join('sewafasilitas', 'sewafasilitas.transaksi_id = transaksi.transaksi_id');
            $this->join('fasilitas', 'fasilitas.fasilitas_id = sewafasilitas.fasilitas_id');
        }
        $this->select('transaksi.*, pelanggan.pelanggan_nama, count(jadwal.jadwal_id) as jumlah');
        $this->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id', 'left');
        $this->join('jadwal', 'jadwal.transaksi_id = transaksi.transaksi_id', 'left');
        $this->orderBy('tanggal_pesan', 'desc');
        $this->groupBy('transaksi.transaksi_id');
        if ($jenis != null)
            $this->where('transaksi.jenis', $jenis);
        return $this->find();
    }
    function getLaporan($dari = null, $sampai = null)
    {
        $this->select('transaksi.*, pelanggan.pelanggan_nama, count(jadwal.jadwal_id) as jumlah');
        $this->orderBy('tanggal_pesan', 'desc');
        $this->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id', 'left');
        $this->join('jadwal', 'jadwal.transaksi_id = transaksi.transaksi_id', 'left');
        $this->groupBy('transaksi.transaksi_id');
        $this->where('transaksi.status', 'Sudah Bayar');
        if ($dari != null)
            $this->where('CAST(tanggal_pesan AS DATE) >=', $dari, true);
        if ($sampai != null)
            $this->where('CAST(tanggal_pesan AS DATE) <=', $sampai, true);
        return $this->find();
    }
}
