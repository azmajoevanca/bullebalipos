<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [ 'boking_code','customer_id','denda', 'total_harga','bukti_bayar', 'type', 
    'amount', 'status'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function Product()
    {
        return $this->belongsTo('App\Product');
    }
}
