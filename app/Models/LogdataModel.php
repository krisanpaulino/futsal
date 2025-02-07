<?php

namespace App\Models;

use CodeIgniter\Model;

class LogdataModel extends Model
{
    protected $table            = 'logdata';
    protected $primaryKey       = 'logdata_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'operation',
        'log_tablename',
        'changed_at',
        'changed_data',
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
        'user_id' => 'required',
        'operation' => 'required',
        'log_tablename' => 'required',
        'changed_at' => 'required',
        'changed_data' => 'required',
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

    function getLog()
    {
        $this->orderBy('changed_at', 'desc');
        $this->join('user', 'user.user_id = logdata.user_id');
        return $this->find();
    }
}
