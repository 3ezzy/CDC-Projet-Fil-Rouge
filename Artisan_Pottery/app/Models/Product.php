<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'price',
        'stock',
        'description',
        'image_path',
        'review',
        'comment',
        'discount'
    ];

    protected $appends = [
        'total_price',
        'formatted_price',
        'formatted_total_price',
        'formatted_discount_amount'
    ];

    public function getTotalPriceAttribute()
    {
        if ($this->discount) {
            return round($this->price - ($this->price * $this->discount / 100), 2);
        }
        return $this->price;
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    public function getFormattedTotalPriceAttribute()
    {
        return '$' . number_format($this->total_price, 2);
    }

    public function getFormattedDiscountAmountAttribute()
    {
        if ($this->discount) {
            return '$' . number_format($this->price - $this->total_price, 2);
        }
        return '$0.00';
    }
}