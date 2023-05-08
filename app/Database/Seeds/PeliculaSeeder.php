<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('peliculas')->truncate();
        for($i=0; $i < 20; $i++)
        {
            $this->db->table('peliculas')->insert(
                [
                    'titulo' => "Pelicula Seeder $i",
                    'description' => "Pelicula Descripcion Seeder $i",                
                ]
            );        
        }
    }
}
