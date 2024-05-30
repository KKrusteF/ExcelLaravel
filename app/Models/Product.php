<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_product_id', 'ean', 'model', 'warranty', 'handling_time',
        'name', 'brand', 'cat_id', 'subcat_id', 'childcat_id',
        'sale_price', 'original_sale_price', 'vat_rate', 'stock', 'status'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcat_id');
    }

    public function childcategory(): BelongsTo
    {
        return $this->belongsTo(Childcategory::class, 'childcat_id');
    }
}
