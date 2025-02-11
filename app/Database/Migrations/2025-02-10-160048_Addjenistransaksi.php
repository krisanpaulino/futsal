<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addjenistransaksi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi', [
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => 'Booking Lapangan'
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
