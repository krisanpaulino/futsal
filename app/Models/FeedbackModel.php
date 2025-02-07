<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table            = 'feedback';
    protected $primaryKey       = 'feedback_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'transaksi_id',
        'komentar',
        'rating',
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
        'komentar' => 'required',
        'rating' => 'required',
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

    function getFeedback($transaksi_id = null, $limit = null)
    {
        $this->join('transaksi', 'transaksi.transaksi_id = feedback.transaksi_id');
        $this->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id');
        if ($transaksi_id != null) {
            $this->where('feedback.transaksi_id', $transaksi_id);
            return $this->first();
        }
        if ($transaksi_id != null) {
            $this->limit(3);
        }
        $this->orderBy('feedback.transaksi_id', 'desc');
        return $this->findAll();
    }
}
