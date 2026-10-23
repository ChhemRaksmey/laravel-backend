<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdlFasModel extends Model
{
    // use HasFactory;

    protected $table = 'vw_fas_model';

    // Views: no auto timestamps, nothing mass-assignable, guard everything
    public $timestamps = false;
    protected $guarded = ['*'];

    public $incrementing  = false;
    protected $primaryKey = 'recid';
    protected $keyType    = 'string';
    protected $casts      = [];
    
}