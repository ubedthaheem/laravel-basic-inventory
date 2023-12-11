<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'description'
    ];

    public function children()
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }
}
