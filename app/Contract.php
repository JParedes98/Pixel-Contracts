<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contract extends Model
{

    use Notifiable;

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

    public function routeNotificationForMail(){
        return $this->email;
    }

}
