<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['subcategory_name', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function childcategories(): HasMany
    {
        return $this->hasMany(Childcategory::class, 'subcategory_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'subcat_id');
    }
}
