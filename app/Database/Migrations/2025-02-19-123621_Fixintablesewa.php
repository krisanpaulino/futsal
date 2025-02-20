<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fixintablesewa extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('sewafasilitas', [
            'waktu_mulai',
            'waktu_selesai',
            'tanggal_sewa',
            'transaksi_id',
        ]);

        $this->forge->addColumn('sewafasilitas', [
            'jadwal_id' => [
                'type' => 'INT',
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
