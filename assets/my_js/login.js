$(document).ready(function(){
    $("#loginAgent").submit(function(e){
        e.preventDefault();
        if($("#codeAgent").val()=='' || $("#password").val()==''){
            $("#resultat").css('color','red').text('Aucune zone de texte doit être vide !').show();
        }else{
            connexionAgent();
            $("#resultat").text('');
            $("#resultat").hide();
        }
        
    })
})
// Fonction de connexion d'un agent
function connexionAgent(){
    $.ajax({
        type:'post',
        data:$("#loginAgent").serialize(),
        url:'./fonctions/login.php',
        success:function(server){
            console.log(server)
            if(server == false){
                $("#resultat").css('color','red').text('Code ou mot de passe incorrect')
                $("#resultat").show();
            }else{
                if(server == 1){
                    document.location.href='./gestionnaire.php';
                }
                if(server == 2){
                    document.location.href='./comptabilite.php';
                }
                if(server == 3){
                    document.location.href='./prefecture.php';
                }
                if(server == 4){
                    document.location.href='./caisse.php';
                }
                if(server == 5){
                    document.location.href='./secretariat.php';
                }
                if(server == 6){
                    document.location.href='./coordonateur.php';
                }
                if(server == 9){
                    document.location.href='./enseignant.php';
                }
            }
            
        }
    })
}