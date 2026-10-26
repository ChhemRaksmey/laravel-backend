<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vwAmlCustomerType extends Model
{
    protected $table = 'vw_aml_customer_type';
    protected $primaryKey = 'recid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // Read-only: block all writes
    protected $guarded = ['*'];

    protected $casts = [
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