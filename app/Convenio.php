<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use SoftDeletes;
    protected $table = 'convenio';
    protected $primaryKey = 'idconvenio';
    public $timestamps = false;
    protected $guarded = [];
}
