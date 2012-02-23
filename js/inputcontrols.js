function validate_email(email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(email) == false) {
        message('Adresse Email Invalide');
        return false;
   } else {
        return true;
   }
}

function validate_url(url)
{
    var reg = /^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/;
    if(reg.test(url) == false) {
        message('Adresse Web Invalide');
        return false;
   } else {
        return true;
   }
}

function validate_numbers(num)
{
    var reg = /^[0-9\-\.]+$/;
    if(reg.test(num) == false) {
        message('Numéro Invalide');
        return false;
   } else {
        return true;
   }
}

function validate_letters(letters)
{
    var reg = /^[A-Za-zéèàôç\-\ ]+$/;
    if(reg.test(letters) == false) {
        message('Entrée Alphabétique Invalide');
        return false;
   } else {
        return true;
   }
}

function validate_annees(value)
{
    var reg = /^[0-9]{4}$/;
        if(reg.test(value) == false) {
        message('Année Invalide');
        return false;
   } else {
        //next check valid years
        var d = new Date();
        year = d.getFullYear();
        year = year*1;
        value = value*1;
        beginyear = 1950;
        
        if((value>year) || (value<beginyear)){message("Veuillez entrer une année entre "+beginyear+" et "+year);return false;}else{return true;};

   }
}