<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Changejenis extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('transaksi', [
            'jenis' => [
                'name' => 'jenis',
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'Booking Lapangan'
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
