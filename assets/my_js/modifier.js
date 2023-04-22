$(document).ready(function(){
    $("#form_modif_eleve").hide();
    b_nom = false;
    b_postnom = false;
    b_prenom = false;
    b_genre = false;
    b_classe = false;
    b_degre = false;
    b_option = false;
    b_type_compte = false;
    b_sous_type_compte = false;
    //  MODIFICATION DE COMPTE
    // AJOUT DES COMPTES 
    // Quand un element du select compte est choisi
    $("#type_compte").change(function(){
      if($(this).val() !=""){
        b_type_compte = true;
          $("#resultat").text('').hide();
          $("#type_compte").css('border-color','green');
          $.ajax({
              type:'get',
              url:'fonctions/filtrer_donnees.php?num_type_compte='+$(this).val(),
              success:function(server){
                  $("#sous_type_compte").html('').html(server);
              }
          })
      }else{
        b_type_compte = false;
          $("#resultat").text('').text('Veuillez sélectionner le type de compte').css('color','red').show();
          $("#type_compte").css('border-color','red');
      }
  });
  // Quand un element du select de sous compte est choisi
  $("#sous_type_compte").change(function(){
      if($(this).val() !=""){
        b_sous_type_compte = true;
          $("#resultat").text('').hide();
          $("#sous_type_compte").css('border-color','green');
      }else{
          b_sous_type_compte = false;
          $("#resultat").text('').text('Veuillez sélectionner un sous type de compte').css('color','red').show();
          $("#sous_type_compte").css('border-color','red');
      }
  });
    // Soumission du formulaire d'ajour des comptes
    $("#form_modif_compte").submit(function(e){
      e.preventDefault();
      var data = $(this).serialize();
      if(b_type_compte!="" && b_sous_type_compte!="" && $("#num_compte_ajout").val()!="" && $("#libelle_num_compte").val()!=""){
        $.ajax({
          type:'post',
          url:'./fonctions/modifier.php',
          data:data,
          success:function(server){
            if(server == true){
              $("#resultat").text('').text("Modification effectuée avec succès !").css('color','green').show();
              $("#resultat").fadeOut(3000);
              $("#form_modif_compte").trigger('reset');
              b_type_compte = false;
              document.location.href='./liste_compte.php';
            }else if(server == 2){
              $("#resultat").text('').text("Ce numéro de compte a déjà été ajouté !").css('color','red').show();
            }else{
              $("#resultat").text('').text("Une erreur s'est produite !").css('color','red').show();
              console.log(server);
            }
          }
        })
      }else{
        swal("Formulaire non valide","","error");
      }
    })

    $("#close").click(function(e){
        e.preventDefault();
        $("#form_modif_eleve").slideUp(500);
    })
    // SOUMISSION DE LA MODIFICATION DE L'ELEVE
    $("#modif_eleve").submit(function(e){
        e.preventDefault();
        if(modifierEleve()== true){
            var matricule_eleve = $("#matriculeEleve").val();
            $.ajax({
                type:'post',
                url:'./fonctions/modifier.php',
                data: $(this).serialize(),
                success:function(server){
                    console.log(server)
                    if(server == true){
                        swal("Réussi !","","success");
                        b_nom = false;
                        b_postnom = false;
                        $("#modif_eleve").trigger('reset');
                    }else{
                        swal("Erreir !","","error");
                    }
                }
            })
        }else{
            swal('Erreur','','error')
        }
    })

});
// DONNEES DE MODIFICATION DES ELEVES
function get_data_modif(matricule_eleve){
    $.ajax({
        type:'get',
        url:'./fonctions/modifier.php?matricule_eleveModification='+matricule_eleve,
        dataType:'JSON',
        success:function(server){
            var datas = (server);
            $("#form_modif_eleve").css('position','fixed');
            $("#form_modif_eleve").css('top','2%');
            $("#form_modif_eleve").css('left','35%');
            $("#form_modif_eleve").css('right','70%');
            $("#form_modif_eleve").css('z-index',1060);
            $("#form_modif_eleve").css('background','rgb(35, 58, 185)');
            $("#form_modif_eleve").css('width','50%');
            $("#form_modif_eleve").css('border-color','black');
            $("#form_modif_eleve").css('color','white');
            $("#form_modif_eleve").css('opacity','95%');
            $("#form_modif_eleve").slideDown(500);
            $("#matriculeEleve").val(datas.Matriceleve);
            $("#nom").val(datas.Nomeleve);
            $("#postnom").val(datas.Postnomeleve);
            $("#prenom").val(datas.Prenomeleve);
            $("#genre").val(datas.Sexeeleve);
            $("#classe").val(datas.Libelleclasse);
            $("#degre").val(datas.Numclasse);

        }
    })
}
// VERIFICATION DES DONNEES A MODIFIER
function modifierEleve(){  
    // VERIFICATION DES INFORMATION DU FORMULAIRE eleve
    
    // verification du nom
    $("#nom").keyup(function(){
      if ($("#nom").val().match(/^[-éèàâêëùû 'a-z]+$/i)) {
          b_nom = true;
          $("#nom").css("border-color", "green");
          $("#resultat").hide();
      } else {
        b_nom = false;
        $("#nom").css("border-color", "#ff0000");
        $("#resultat").text("Ce nom n'est pas invalide");
        $("#resultat").css("color", "red");
        $("#resultat").show();
      }
    });  
    // verification du postnom
    $("#postnom").keyup(function(){
      if ($("#postnom").val().match(/^[-éèàâêëùû 'a-z]+$/i)) {
          b_postnom = true;
          $("#postnom").css("border-color", "green");
          $("#resultat").hide();
      } else{
        b_postnom = false;
        $("#postnom").css("border-color", "#ff0000");
        $("#resultat").text("Ce postnom n'est pas invalide");
        $("#resultat").css("color", "red");
        $("#resultat").show();
      }
    });
    // verification du prenom
    $("#prenom").keyup(function(){
      if ($("#prenom").val().match(/^[-éèàâêëùû 'a-z]+$/i)) {
          b_prenom = true;
          $("#prenom").css("border-color", "green");
          $("#resultat").hide();
      } else {
        b_prenom = false;
        $("#prenom").css("border-color", "#ff0000");
        $("#resultat").text("Ce prenom n'est pas correct");
        $("#resultat").css("color", "red");
        $("#resultat").show();
      }
    });  
    // verification du genre
    $("#genre").change(function(){
      if ($("#genre").val().length > 0 ) {
        b_genre = true;
        $("#genre").css("border-color", "green");
        $("#resultat").hide();
      } else {
        b_genre = false;
        $("#genre").css("border-color", "#ff0000");
        $("#resultat").show().text("Veuillez sélectionner un genre");
        $("#resultat").css("color", "red");
      }
    });
     // verification de la classe
     $("#classe").change(function(){
      if ($("#classe").val().length > 0 ) {
        b_classe = true;
        $("#classe").css("border-color", "green");
        $("#resultat").hide();
      } else {
        b_classe = false;
        $("#classe").css("border-color", "#ff0000");
        $("#resultat").show().text("Veuillez sélectionner une classe");
        $("#resultat").css("color", "red");
      }
    });
    // verification du degre
    $("#degre").change(function(){
      if ($("#degre").val().length > 0 ) {
        b_degre= true;
        $("#degre").css("border-color", "green");
        $("#resultat").hide();
      } else {
        b_degre = false;
        $("#degre").css("border-color", "#ff0000");
        $("#resultat").show().text("Veuillez sélectionner un degré");
        $("#resultat").css("color", "red");
      }
    });
    // verification de l'option
    $("#classe").change(function(){
      if ($(this).val()==4 ) {
        $("#option").change(function(){
            if($("#option").val()==""){
              b_option = false;   
              $("#resultat").text("Veuillez sélectionner une option");
              $("#resultat").css("color", "red");
              $("#resultat").show();
              $("#option").css('border-color','red');
            }else{
              b_option = true;
              $("#option").css('border-color','green');
              $("#resultat").text("");
              $("#resultat").hide();
            }
        })
      }
    });
    // Soumission de la modification de l'eleve
      if((b_nom==true) && (b_postnom==true) ){   
          if($("#classe").val()==4 && b_option== true){
              return true;
          }
          if($("#classe").val().length > 0 && $("#classe").val()!=4 && b_option == false){
              return true;
          }
      }else{
          return false;
      }
  }