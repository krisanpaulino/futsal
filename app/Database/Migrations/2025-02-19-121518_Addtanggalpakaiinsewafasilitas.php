<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addtanggalpakaiinsewafasilitas extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sewafasilitas', [
            'tanggal_sewa' => [
                'type' => 'date',
            ],
            'waktu_mulai' => [
                'type' => 'TIME'
            ],
            'waktu_selesai' => [
                'type' => 'TIME'
            ],
        ]);
        $this->forge->dropColumn('sewafasilitas', 'jumlah_sewa');
        $this->forge->dropColumn('sewafasilitas', 'jumlah_jam');
    }

    public function down()
    {
        //
    }
}
