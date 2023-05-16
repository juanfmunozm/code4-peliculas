<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use CodeIgniter\Database\Seeder;

class EtiquetaSeeder extends Seeder
{
    public function run()
    {
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel = new CategoriaModel();

        $this->db->table('etiquetas')->truncate();
        

        $categorias = $categoriaModel->find();

        for($i=0; $i < 20; $i++)
        {
            $categoriaRandomIndex = array_rand($categorias);

            $this->db->table('etiquetas')->insert(
                [
                    'titulo' => "TAG Pelicula Seeder $i",
                    'categoria_id' => $categorias[$categoriaRandomIndex]->id,
                    
                ]
            );        
        }
    }
}
