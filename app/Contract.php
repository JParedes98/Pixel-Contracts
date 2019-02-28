<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $fillable =[
        'name_rep',
        'social_reason',
        'n_identidad',
        'rtn',
        'contact',
        'adress',
        'tel',
        'email',
        'date'
    ];
}
