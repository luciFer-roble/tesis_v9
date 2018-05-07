<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoP extends Model
{
    use SoftDeletes;
    protected $table = 'documentop';
    protected $primaryKey = 'iddocumentop';
    public $timestamps = false;
    protected $guarded = [];

    public function practica(){
        return $this->belongsTo('App\Practica', 'idpractica', 'idpractica');
    }

    public function tipodocumento(){
        return $this->belongsTo('App\TipoDocumento', 'idtipodocumento', 'idtipodocumento');
    }
}
