<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /***
     * One invoice belongs to one customer, make the relationship
     */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
