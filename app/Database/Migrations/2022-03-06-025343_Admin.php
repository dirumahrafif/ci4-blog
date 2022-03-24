<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'unique' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'unique' => true
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 25
            ],
            'last_login timestamp default now()'
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('admin', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('admin');
    }
}
