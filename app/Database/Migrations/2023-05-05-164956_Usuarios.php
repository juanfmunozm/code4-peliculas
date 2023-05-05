<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'usuario' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'unique' => true,                
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,                
            ],
            'contrasena' => [
                'type' => 'VARCHAR',
                'constraint' => 200,             
            ],
            'tipo' => [
                'type' => 'ENUM',
                'constraint' => ['admin','regular'], 
                'default' => 'regular'            
            ],

        ]);

        $this->forge->addKey('id',TRUE);
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
