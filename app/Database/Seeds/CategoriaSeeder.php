<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('categorias')->truncate();
        for($i=0; $i < 20; $i++)
        {
            $this->db->table('categorias')->insert(
                [
                    'titulo' => "Categoria Seeder $i",                
                ]
            );        
        }
       
    }
}
