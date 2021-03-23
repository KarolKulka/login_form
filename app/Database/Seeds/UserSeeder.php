<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'test_user',
            'password' => password_hash('testpassword', PASSWORD_DEFAULT),
        ];

        $this->db->table('users')->insert($data);
    }
}
