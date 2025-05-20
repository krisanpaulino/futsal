<?php

namespace App\Models;

use CodeIgniter\Model;

class FasilitasModel extends Model
{
    protected $table            = 'fasilitas';
    protected $primaryKey       = 'fasilitas_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_fasilitas',
        'harga_sewa',
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
        'nama_fasilitas' => 'required',
        'harga_sewa' => 'required',
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

    function getStatus($status)
    {
        $this->where('status', $status);
        return $this->find();
    }

    function notInJadwal($jadwal)
    {
        $this->select('fasilitas.*');
        $this->join('sewafasilitas', 'sewafasilitas.fasilitas_id = fasilitas.fasilitas_id AND sewafasilitas.jadwal_id = ' . $jadwal, 'left');
        $this->where('sewafasilitas_id is null', null, false);
        $this->groupBy('fasilitas.fasilitas_id');
        // return $this->builder->getCompiledSelect();
        return $this->find();
    }
}
