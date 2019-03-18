
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

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$('.clearSign').click(function(e){
    signaturePad.clear();
});

$('.submitForm').click(function(e){
    if(signaturePad.isEmpty()){
        alert('Favor Firma en el respectivo campo.');
    }else{
        $('[name="signature"]').val(signaturePad.toDataURL());
        $('form').submit();
    }
});