<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnTokenAdmin extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('admin', ['token varchar(255)']);
    }

    public function down()
    {
        //
    }
}
