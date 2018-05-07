<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use SoftDeletes;
    protected $table = 'tipodocumento';
    protected $primaryKey = 'idtipodocumento';
    public $timestamps = false;
    protected $guarded = [];

    public function documentop(){
        return $this->hasMany('App\DocumentoP');
    }

}
