<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $table = 'tb_categories';
    protected $fillable = ['name'];
    protected $primaryKey = 'id';


};
