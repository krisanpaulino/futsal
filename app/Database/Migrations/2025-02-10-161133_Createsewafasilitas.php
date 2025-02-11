<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createsewafasilitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sewafasilitas_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'fasilitas_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'transaksi_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'jumlah_sewa' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'jumlah_jam' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'sub_total' => [
                'type' => 'FLOAT'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Sewa', 'Selesai']
            ]
        ]);
        $this->forge->addPrimaryKey('sewafasilitas_id');
        $this->forge->createTable('sewafasilitas');
    }

    public function down()
    {
        $this->forge->dropTable('sewafasilitas');
    }
}
