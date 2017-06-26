<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['qty', 'amount', 'transaction_id', 'product_id', 'data', 'status'];

    public function transactions() {
    	return $this->belongsTo('\App\Order');
    }

    public function products() {
    	return $this->belongsTo('\App\Product', 'product_id');
    }
}
