<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createusertable extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id'          => [
                    'type'           => 'INT',
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'username'    => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                ],
                'password'    => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                ],
                'last_log_in' => [
                    'type'    => 'TIMESTAMP',
                    'comment' => 'Last log in date',
                    'null'    => true,
                ],
            ]
        );

        $this->forge->addPrimaryKey('id');

        $this->forge->addUniqueKey('username');

        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
