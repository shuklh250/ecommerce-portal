<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'order_id',
        'payment_id',
        'signature',
        'amount',
        'status'
    ];
    public $timestamps = true;
}
