<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Changepelanggantoacceptnull extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('transaksi', [
            'pelanggan_id' => [
                'name' => 'pelanggan_id',
                'type' => 'INT',
                'constraint' => 11,
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
