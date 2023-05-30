<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table            = 'imagenes';
    protected $returnType       = 'object';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['imagen','extension','data'];

}
