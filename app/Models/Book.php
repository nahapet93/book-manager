<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(BookImage::class);
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(BookImage::class)->where('is_main_image', 1);
    }
}
