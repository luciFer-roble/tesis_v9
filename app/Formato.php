<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formato extends Model
{
    use SoftDeletes;
    protected $table = 'formato';
    protected $primaryKey = 'idformato';
    public $timestamps = false;
    protected $guarded = [];
}
