function imprimer(objet){
    
    // $("#close").text('');
    // $("#print_recu").hide();
    $("#print_recu").text('');
    var contenu = document.getElementById(objet).innerHTML;
    var contenu_form = document.body.innerHTML;
    document.body.innerHTML = contenu;
    window.print();
    document.body.innerHTML = contenu_form;
    // $("#logo").show();
    // return true;
}
