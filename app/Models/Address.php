<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'postcode',
        'street_name',
        'street_number', // building number
        'province',
        'city',
        'country',
        'address_type',
    ];

    protected $hidden = [
        'id',
        'addressable_id',
        'addressable_type',
        'created_at',
    ];

    /**
     * Morph to the addressable model.
     * @return BelongsTo
     */
    public function addressable(): BelongsTo
    {
        return $this->morphTo();
    }
}
