"use strict";

$(document).ready(function() {
    var _frmRegistrazione = $("#frmRegistrazione");
    var _txtNome = $("#txtNome");
    var _msgErrore = $("#msgErrore");

    $("#btnConferma").on("click", function() {
        _msgErrore.html("");

        if (_txtNome.val() == "") {
            _msgErrore.text("Inserire il nome");
        } else {
            _frmRegistrazione.prop("method", "GET");
            _frmRegistrazione.prop("action", "PHP/registrazione.php");
            _frmRegistrazione.submit();
        }
    });
});