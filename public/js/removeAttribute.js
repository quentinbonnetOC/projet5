document.addEventListener("DOMContentLoaded", function (event) {
    var element = document.getElementById('Date_de_naissance');
    var birthdate = element.value;
    var date = new Date();
    var yearNow = date.getFullYear();
    birthdate = birthdate.substring(0, 4);
    birthdate = parseInt(birthdate);
    var diff = yearNow - birthdate;
    if (diff < 18) {
        var p = document.querySelector(".parents");
        p.style.display = 'block';
        var a = document.querySelector(".autorisation");
        a.style.display = 'block';

        var body = document.querySelector("body");
        body.style.height = '1795px';
        var form = document.querySelector("form");
        form.style.height = '1732px';

    } else {
        var b = document.getElementById("NOM_pere");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("Prenom_pere");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("mail_pere");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("Profession_pere");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("Entreprise_pere");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("NOM_mere");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("Prenom_mere");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("Profession_mere");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("Entreprise_mere");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("a1");
        b.removeAttribute('required', 'required');
        var b = document.getElementById("b1");
        b.removeAttribute('required', 'required');
    }

});

