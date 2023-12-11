<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stock';

    protected $fillable = [
        'supplier_id', 
        'product_id', 
        'quantity', 
        'added_at'
    ];


    /**
     * Get Supplier based on Supplier_id
     */
    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    /**
     * Get Product Information based on Stock
     */
    public function product()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }

    
}
