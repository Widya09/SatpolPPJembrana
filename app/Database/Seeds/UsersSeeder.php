<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // satu data
        // $data = [
        //     'nama' => 'Yucan',
        //     'username' => 'yuk123',
        //     'password' => password_hash('12345', PASSWORD_BCRYPT),
        //     'role' => 'Admin',
        // ];
        // $this->db->table('users')->insert($data);

        // multi data
        $data = [
            [
                'nama' => 'Yucan',
                'username' => 'yuk123',
                'password' => password_hash('12345', PASSWORD_BCRYPT),
                'role' => 'Admin',
            ],
            [
                'nama' => 'Agus',
                'username' => 'gus123',
                'password' => password_hash('123', PASSWORD_BCRYPT),
                'role' => 'Petugas',
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
