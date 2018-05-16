
function display_hidden_fields()
{
   var login= document.getElementsByName("changeVisibility")[0];
   if (login.style.display =="none")
        login.style.display = "block";
    else
        if (login.style.display =="block")
            login.style.display = "none";
        else
            // nel caso di possibili modifiche della variabile da terzi
            //todo: forse meglio settare a none e riprendere il corretto funzionamento
            throw "style.dysplay error";
}
