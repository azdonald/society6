<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sku', 'price', 'product_type_id', 'creative_id'
    ];


    public function creatives(): BelongsTo
    {
        return $this->belongsTo(Creative::class, "creative_id");
    }

    public function types(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, "product_type_id");
    }
}
