<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dropstatussewafasilitas extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('sewafasilitas', 'status');
        //
    }

    public function down()
    {
        //
    }
}
