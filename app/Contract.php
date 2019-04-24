<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contract extends Model
{

    use Notifiable;

    protected $table = 'contracts';
    protected $fillable =[
        'legal_representative_name',
        'company_social_reason',
        'legal_representative_id_number',
        'legal_representative_home',
        'legal_representative_marital_status',
        'legal_representative_rtn',
        'contact_name',
        'company_adress',
        'company_tel',
        'company_email',
        'contract_status',
        'contract_file_pdf',
        'contract_date',
    ];

    protected $dates = ['contract_date'];

    public function routeNotificationForMail(){
        return $this->company_email;
    }

    public function hashID(){
        return base64_encode($this->id);
    }

    public function getContractMonthLocalized(){
        if(!$this->contract_date)
            return;

        setlocale(LC_ALL, 'es_ES');
        $month = $this->contract_date->formatLocalized('%B');
        return ucfirst($month);
    }
}
