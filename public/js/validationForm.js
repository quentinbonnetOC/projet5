//validation en cours de saisie evenement on blur
document.addEventListener('DOMContentLoaded', function(){
    var form = document.forms['formRenouv'];
    for (let index = 0; index < form.length; index++) {
        form[index].addEventListener('blur', function(e){
            if(form[index].value=="")
            {
                if(document.getElementById("validation"))
                {
                    document.getElementById("validation").remove();
                }
                var tata = document.createElement("span");
                tata.id = "validation";
                tata.textContent = "Veuillez remplir ce champ";
                tata.style.color = "red";
                form[index].insertAdjacentElement("afterend", tata);
                form[index].style.border = "2px solid red";
            }else{
                if(document.getElementById("validation"))
                {
                    document.getElementById("validation").remove();
                }
                var tata = document.createElement("span");
                tata.style.color = "green";
                form[index].insertAdjacentElement("afterend", tata);
                form[index].style.border = "2px solid green";
            }
        });   
    }
    if(!form["Masculin"].checked && !form["Feminin"].checked)
    {
        var tata = document.createElement("span");
        tata.textContent = "Veuillez cocher un champ";
        tata.style.color = "red";
        tata.id = "radio1"
        tata.style.marginLeft = "5px";
        $(tata).insertAfter("label[for='Masculin']");

        var toto = document.createElement("span");
        toto.textContent = "Veuillez cocher un champ";
        toto.style.color = "red";
        toto.id="radio2";
        toto.style.marginLeft = "5px";
        $(toto).insertAfter("label[for='Feminin']");
    }    
    $('input:radio[name="Sexe"]').change(function(){
        document.getElementById("radio1").remove();
        document.getElementById("radio2").remove();
    }) 
    if(!form["quitter_le_gymnase_oui"].checked && !form["quitter_le_gymnase_non"].checked)
    {
        var tata = document.createElement("span");
        tata.textContent = "Veuillez cocher un champ";
        tata.style.color = "red";
        tata.id = "radio3"
        tata.style.marginLeft = "5px";
        $(tata).insertAfter("label[for='quitter_le_gymnase_oui']");

        var toto = document.createElement("span");
        toto.textContent = "Veuillez cocher un champ";
        toto.style.color = "red";
        toto.id="radio4";
        toto.style.marginLeft = "5px";
        $(toto).insertAfter("label[for='quitter_le_gymnase_non']");
    }
    $('input:radio[name="quitter_le_gymnase"]').change(function(){
        document.getElementById("radio3").remove();
        document.getElementById("radio4").remove();
    })
    if(!form["actes_medical_oui"].checked && !form["actes_medical_non"].checked)
    {
        var tata = document.createElement("span");
        tata.textContent = "Veuillez cocher un champ";
        tata.style.color = "red";
        tata.id = "radio5"
        tata.style.marginLeft = "5px";
        $(tata).insertAfter("label[for='actes_medical_oui']");

        var toto = document.createElement("span");
        toto.textContent = "Veuillez cocher un champ";
        toto.style.color = "red";
        toto.id="radio6";
        toto.style.marginLeft = "5px";
        $(toto).insertAfter("label[for='actes_medical_non']");
    }
    $('input:radio[name="actes_medical"]').change(function(){
        document.getElementById("radio5").remove();
        document.getElementById("radio6").remove();
    })  
});
