<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LHBS extends Model
{
    //
    protected $table = 'doctor_appointment';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['api_key', 'time',  'doctor', 'place','reason'];
}
