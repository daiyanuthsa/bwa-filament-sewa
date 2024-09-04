<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price',
        'brand_id',
        'category_id',
    ];
    protected $casts = [
        'price' => MoneyCast::class,
    ];

    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get the brand associated with the product.
     */
    public function brand() : BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the category associated with the product.
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the photos associated with the product.
     */
    public function photos() : HasMany
    {
        return $this->hasMany(ProductPhoto::class);
    }
}
