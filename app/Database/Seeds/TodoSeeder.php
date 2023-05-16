<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TodoSeeder extends Seeder
{
    public function run()
    {    
        $this->db->disableForeignKeyChecks();
        $this->call('PeliculaSeeder');
        $this->call('CategoriaSeeder');
        $this->call('EtiquetaSeeder');
        $this->db->enableForeignKeyChecks();        
    }
}
