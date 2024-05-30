<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Childcategory extends Model
{
    use HasFactory;

    protected $fillable = ['childcategory_name', 'subcategory_id'];

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'childcat_id');
    }
}
