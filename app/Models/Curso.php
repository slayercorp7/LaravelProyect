<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{

    protected $fillable = [
        'nombre',
        'descripcion',
        'contenido',
        'imagen',
        'categoria_id'
    ];

    //Obtrenr la categoria mediante la clave foranea
    public function categoriaCurso(){

        //Relacion de uno a uno 
        return $this->belongsTo(CategoriaCurso::class, 'categoria_id');
    }

    public function autorCurso(){

        //Relacion de uno a uno 
        return $this->belongsTo(User::class, 'user_id');
    }

    //Los like que a recibido la receta
    public function likes(){
        return $this->belongsToMany(User::class, 'like_cursos');
    }

}
