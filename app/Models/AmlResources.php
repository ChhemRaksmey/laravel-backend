<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class AmlResources extends Model
{
    protected $table = 'aml_resources';
    protected $primaryKey = 'recid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'recid',
        'json_data',
    ];

    protected $casts = [
        'json_data' => 'array',
    ];
}