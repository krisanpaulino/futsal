<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AltertransaksiNama extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('transaksi', [
            'transaksi_nama' => [
                'name' => 'nama_penyewa',
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
                'default' => null
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
