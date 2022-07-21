<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_users'    => [
                'type'  => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '50',

            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
            ],
        ]);
        $this->forge->addKey('id_users', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
