
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var canvas = document.querySelector("canvas");

if(canvas){
    var signaturePad = new SignaturePad(canvas);
    signaturePad.minWidth = 2;
    signaturePad.maxWidth = 5;
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$('.clearSign').click(function(e){
    signaturePad.clear();
});

$('.submitForm').click(function(e){

    var agree = document.getElementById('agreeAttachments');

    if(agree == false){
        alert('Favor revisar Anexos de Contrato');
    }

    if(signaturePad.isEmpty() && agree != 1){
        alert('Favor Firma en el respectivo campo.');
    }else{
        $('[name="contract_signature"]').val(signaturePad.toDataURL());
        $('form').submit();
    }
});
