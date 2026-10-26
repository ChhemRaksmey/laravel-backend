<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class AmlRiskCountries extends Model
{
    protected $table = 'aml_risk_countries';
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