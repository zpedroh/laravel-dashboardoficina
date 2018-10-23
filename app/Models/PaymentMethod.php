<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'tb_payment_methods';
    protected $fillable = ['type', 'parcel', 'period', 'duedate'];
    protected $primaryKey = 'id';
}