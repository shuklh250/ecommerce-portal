<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories';
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',       // subcategory name
        'status',     // optional: active/inactive
    ];

    // Relationship: SubCategory belongs to a Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
