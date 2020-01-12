<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMigrate extends Model
{
    protected $table = 'paymentMigrate';
    // protected $fillable = array('student_id');
    protected $primaryKey = 'pay_id';
    public $timestamps = false;


}
