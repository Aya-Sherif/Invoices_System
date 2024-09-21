<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    // A product size may have many invoice items
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItems::class, 'product_size_id');
    }

    // Each product size belongs to a specific product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Fillable fields for mass assignment
    protected $fillable = ['size', 'price', 'discount_percentage', 'quantity', 'product_id'];
}
