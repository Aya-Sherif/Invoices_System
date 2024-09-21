<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
    use HasFactory;
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    // Each invoice item belongs to a specific product size (keeping the method name `product()`)
    public function product()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }
    protected $fillable=['invoice_id','product_size_id','size','quantity','price','discount','total'];
}
