<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['name','image'];
    public function productSizes()
{
    return $this->hasMany(ProductSize::class, 'product_id'); // Assuming product_id is the foreign key in ProductSize table
}


}
