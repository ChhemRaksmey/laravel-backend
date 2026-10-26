<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vwAmlRiskCountries extends Model
{
    protected $table = 'vw_aml_risk_countries';
    protected $primaryKey = 'recid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // Read-only: block all writes
    protected $guarded = ['*'];

    protected $casts = [
        'code2'     => 'string',
        'code3'     => 'string',
        'full_name' => 'string',
    ];

    public function save(array $options = []): bool
    {
        throw new \LogicException('AmlCountryView is read-only.');
    }

    public function delete(): ?bool
    {
        throw new \LogicException('AmlCountryView is read-only.');
    }
}