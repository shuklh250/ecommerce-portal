<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'short_description',
        'description',
        'price',
        'discount_price',
        'stock_quantity',
        'status',
        'image'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function likes()
    {
        return $this->hasMany(ProductLike::class);
    }
    public function isLikedByUser()
    {
        $user = auth('user')->user(); // ya use guard if needed

        if (!$user) {
            return false;
        }

        return $this->likes()
            ->where('user_id', $user->id)
            ->where('status', 1)
            ->exists();
    }
}
