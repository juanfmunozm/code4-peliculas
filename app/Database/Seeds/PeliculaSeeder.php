<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('peliculas')->truncate();
        $categoriaModel = new CategoriaModel();

        $categorias = $categoriaModel->find();

        for($i=0; $i < 20; $i++)
        {
            $categoriaRandomIndex = array_rand($categorias);

            $this->db->table('peliculas')->insert(
                [
                    'titulo' => "Pelicula Seeder $i",
                    'categoria_id' => $categorias[$categoriaRandomIndex]->id,
                    'description' => "Pelicula Descripcion Seeder $i",                
                ]
            );        
        }
    }
}
