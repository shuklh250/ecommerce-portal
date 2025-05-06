<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLike extends Model
{
    protected $table = 'product_likes'; // explicitly batayein agar table ka naam default nahi hai

    protected $fillable = [
        'user_id',
        'product_id',
        'status', // 1 = like, 0 = dislike
    ];

    // Relationships (if needed)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
