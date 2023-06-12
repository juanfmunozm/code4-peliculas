<?php

namespace App\Controllers\Blog;
use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController{

    public function index()
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        
        $peliculas = $peliculaModel
        ->when($this->request->getGet('buscar'), static function($query, $buscar)
        {
            $query->groupStart()->orLike('peliculas.titulo',$buscar,'both');
            $query->orLike('peliculas.description',$buscar,'both')->groupEnd();
        })
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo) as etiquetas, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_id','left')
        ->join('etiquetas','etiquetas.categoria_id = categorias.id','left')
        ->join('pelicula_imagen','pelicula_imagen.pelicula_id = peliculas.id','left')
        ->join('imagenes', 'pelicula_imagen.imagen_id = imagenes.id','left');
        
        // if($buscar = $this->request->getGet('buscar')){
        //     $peliculas = $peliculas->groupStart()->orLike('peliculas.titulo',$buscar,'both');
        //     $peliculas = $peliculas->orLike('peliculas.description',$buscar,'both')->groupEnd();
        // }
        if($categoria_id = $this->request->getGet('categoria_id')){
            $peliculas = $peliculas->where('peliculas.categoria_id',$categoria_id);     
        }
        if($etiqueta_id = $this->request->getGet('etiqueta_id')){
            $peliculas = $peliculas->where('etiquetas.id',$etiqueta_id);
        }
        
        $peliculas = $peliculas->groupBy('peliculas.id');
        $peliculas = $peliculas->paginate(10);
        //var_dump($peliculaModel->getLastQuery()->getQuery());
        $data = [
            'peliculas' => $peliculas,
            'pager' => $peliculaModel->pager,
            'categorias' => $categoriaModel->findAll(),
            'buscar' => $this->request->getGet('buscar'),
            'categoria_id' => $categoria_id,
            'etiqueta_id'  => $etiqueta_id,
            'etiquetas' => $etiquetaModel->where('categoria_id',$categoria_id)->findAll()
        ];
        echo view('blog/pelicula/index',$data);
    }

    public function show($idPelicula)
    {
        $peliculaModel = new PeliculaModel();
        $data = [
            'pelicula' => $peliculaModel->select('peliculas.*, categorias.titulo as categoria')->join('categorias','categorias.id = peliculas.categoria_id')->find($idPelicula),
            'imagenes' => $peliculaModel->getImagenById($idPelicula),
            'etiquetas' => $peliculaModel->getEtiquetasById($idPelicula)  
        ];
        echo view('blog/pelicula/show',$data);
    }

    public function etiquetas_por_categoria($categoriaId)
    {
        $etiquetaModel = new EtiquetaModel();
        $etiquetas = $etiquetaModel->where('categoria_id',$categoriaId)->findAll();
        return json_encode($etiquetas);
    }

    public function peliculas_por_categoria($categoriaId)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        
        $peliculas = $peliculaModel
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo) as etiquetas, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_id','left')
        ->join('etiquetas','etiquetas.categoria_id = categorias.id','left')
        ->join('pelicula_imagen','pelicula_imagen.pelicula_id = peliculas.id','left')
        ->join('imagenes', 'pelicula_imagen.imagen_id = imagenes.id','left');
    

        $peliculas = $peliculas->where('peliculas.categoria_id',$categoriaId);     
        
        $peliculas = $peliculas->groupBy('peliculas.id');
        $peliculas = $peliculas->paginate(10);

        $data = [
            'peliculas' => $peliculas,
            'pager' => $peliculaModel->pager,
            'categorias' => $categoriaModel->findAll(),
        ];
        echo view('blog/pelicula/peliculas_por_categoria',$data);
    }

    public function peliculas_por_etiqueta($etiquetaId)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        
        $peliculas = $peliculaModel
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo) as etiquetas, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_id','left')
        ->join('etiquetas','etiquetas.categoria_id = categorias.id','left')
        ->join('pelicula_imagen','pelicula_imagen.pelicula_id = peliculas.id','left')
        ->join('imagenes', 'pelicula_imagen.imagen_id = imagenes.id','left');
    

        $peliculas = $peliculas->where('etiquetas.id',$etiquetaId); 
        
        $peliculas = $peliculas->groupBy('peliculas.id');
        $peliculas = $peliculas->paginate(10);

        $data = [
            'peliculas' => $peliculas,
            'pager' => $peliculaModel->pager,
            'categorias' => $categoriaModel->findAll(),
        ];
        echo view('blog/pelicula/peliculas_por_etiqueta',$data);
    }
}