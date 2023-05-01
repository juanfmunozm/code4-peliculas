<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaModel extends Model
{
    protected $table = 'peliculas';

    protected $allowedFields = ['titulo','description'];
}
