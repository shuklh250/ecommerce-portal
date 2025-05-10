<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    protected $fillable = [
        'category_name',
        'description',
        'status',
    ];
    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

    // app/Models/Category.php

    public function subcategories()
    {
        return  $this->hasMany(Subcategory::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, foreignKey: 'category_id');
    }
    }
