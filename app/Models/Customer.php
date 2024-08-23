<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // fillable are the valid parameters to the query
    // You can then use $fillable (whitelist) and $guarded(blacklist) to have a finer control over the fields that can be mass-assigned
    protected $fillable = [
        'name',
        'type',
        'email',
        'address',
        'city',
        'state',
        'postal_code'
    ];

    /***
     * One customer can have many invoices, make the relationship
     */

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
