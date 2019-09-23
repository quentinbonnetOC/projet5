document.addEventListener("DOMContentLoaded", function(event) {
    var i = 0;    
    while(document.forms[i]){
    var element = document.forms[i].elements['Date_de_naissance'];
	var birthdate = element.value;
	var date = new Date();
	var yearNow = date.getFullYear();
	birthdate = birthdate.substring(0, 4);
	birthdate = parseInt(birthdate);
    var diff = yearNow - birthdate;
    if (diff < 18) {
        var form = document.forms[i];
        form.style.height = '1099px';
        var body = document.querySelector('body');
        body.style.height = '1358px';
    }else{
        var form = document.forms[i];
        form.style.height = '1800px';
        var body = document.querySelector('body');
        body.style.height = '1940';
        console.log(body);

    }
    ++i;
}
})