<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vwAmlResources extends Model
{
    protected $table = 'vw_aml_resources';
    protected $primaryKey = 'recid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // Read-only: block all writes
    protected $guarded = ['*'];

    protected $casts = [
        'full_name' => 'string',
        'status'    => 'string',
        'end_point' => 'string',
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