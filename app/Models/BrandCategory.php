<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand_id',
        'category_id',
    ];

    /**
     * Get the brand associated with the brand category.
     */
    public function brand() :BelongsTo
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    /**
     * Get the category associated with the brand category.
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }


}
