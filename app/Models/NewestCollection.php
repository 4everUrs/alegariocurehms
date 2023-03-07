<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewestCollection extends Model
{
    use HasFactory;
    protected $fillable = [
        'encoder', 'category', 'account', 'invoice_id', 'terms', 'downpayment', 'interest',
        'original', 'hash', 'description', 'amount', 'status', 'total_amount', 'monthly_payment', 'balance'
    ];
}
