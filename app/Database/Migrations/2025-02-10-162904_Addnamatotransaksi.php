<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addnamatotransaksi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi', [
            'transaksi_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
