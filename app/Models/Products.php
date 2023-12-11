<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Products extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'product_name',
        'product_code',
        'added_by',
        'cost',
        'description',
        'image',
    ];

    /**
     * Get Stock Of Product
     */
    public function stock()
    {
        return $this->hasMany(Stock::class, 'product_id', 'id');
    }

    /**
     * Get User's Information by UserId
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    /**
     * Add User's ID on creating new stock row
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function($product){
           $product->added_by = Auth::id(); 
        });
    }
}
