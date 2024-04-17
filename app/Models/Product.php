<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'product_desc',
        'product_price',
        'product_stock',
        'product_img',
        'category_id',
        'discount'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
