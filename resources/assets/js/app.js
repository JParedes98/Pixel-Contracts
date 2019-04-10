
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

// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

$('#contract_attachments').change(function(e) {
    var fileName =e.target.files[0].name;
    document.getElementById('file-return').innerText =fileName;
});

$('#file').change(function (e) {
    var fileName = e.target.files[0].name;
    document.getElementById('contract-return').innerText = fileName;
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$('.clearSign').click(function(e){
    signaturePad.clear();
});

function checkAttachments() {
    if (document.getElementById('agree').checked) {
        return true;
    } else {
        return false;
    }
}

$('.submitForm').click(function(e){
    
    if(checkAttachments()==true){
        if (signaturePad.isEmpty()) {
            Snackbar.show({
                text: 'Favor Firmar Contrato en su respectivo Campo',
                pos: 'top-center',
                actionText: 'Ok!',
            });
        } else {
            $('[name="contract_signature"]').val(signaturePad.toDataURL());
            $('form').submit();
        }
    }else{
        $('.wizard .nav-tabs li.active').prev().find('a[data-toggle="tab"]').click();
        Snackbar.show({
            text: 'Favor Revisar Anexos de Contrato',
            pos: 'bottom-right',
            actionText: 'Ok!',
        });
    }
});
