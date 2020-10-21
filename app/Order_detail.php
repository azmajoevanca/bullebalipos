<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $fillable = ['customer_id', 'boking_code', 'type', 'amount','order_id','jumlah','total_harga'];

}
