<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(InvoiceItems::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    protected $fillable=['invoice_identifier','client_id','invoice_date','total_before_discount','total_after_discount','paid','status'];
}
