/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var canvas = document.querySelector("canvas");

if (canvas) {
    var signaturePad = new SignaturePad(canvas);
    signaturePad.minWidth = 2;
    signaturePad.maxWidth = 5;
}

// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

//Alert Closing
$(".alert").fadeTo(2500, 500).slideUp(500, function () {
    $("#success-alert").slideUp(500);
});

//Confirm delete contract
$("#confirm-delete").click(function (e) {
    Snackbar.show({
        text: 'Seguro desea eliminar el contrato?',
        width: '475px',
        actionText: 'Eliminar!',
        duration: 10000,
        pos: 'top-center',
        onActionClick: function (element) {
            document.getElementById("form-delete-contract").submit();
        }
    });
});

$(".text-danger").fadeTo(2500, 500).slideUp(500, function () {
    $("#success-alert").slideUp(500);
});

$('#contract_attachments').change(function (e) {
    var fileName = e.target.files[0].name;
    document.getElementById('file-return').innerText = fileName;
});

$('#file').change(function (e) {
    var fileName = e.target.files[0].name;
    document.getElementById('contract-return').innerText = fileName;
});

$('#file_attach').change(function (e) {
    var fileName2 = e.target.files[0].name;
    document.getElementById('contract-attach').innerText = fileName2;
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$('.clearSign').click(function (e) {
    signaturePad.clear();
});

function checkAttachments() {

    if (document.getElementById('agree').checked) {
        return true;
    } else {
        return false;
    }
}

$('.submitForm').click(function (e) {

    let checkbox_Attachments = document.getElementById('agree');

    if (document.body.contains(checkbox_Attachments)) {

        if (checkAttachments() == true) {
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
        } else {
            $('.wizard .nav-tabs li.active').prev().find('a[data-toggle="tab"]').click();
            Snackbar.show({
                text: 'Favor Revisar Anexos de Contrato',
                pos: 'bottom-right',
                actionText: 'Ok!',
            });
        }

    } else {
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
    }
});