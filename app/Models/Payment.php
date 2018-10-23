<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'tb_payments';
    protected $fillable = ['status', 'date', 'payment_method_id'];
    protected $primaryKey = 'id';

    public function getMethod()
    {
        return $this->hasOne('App\Models\PaymentMethod', 'id', 'payment_method_id');
    }
}


