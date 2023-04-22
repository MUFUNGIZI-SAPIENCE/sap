$(document).ready(function(){
    b_nom = false;
    b_postnom = false;
    b_prenom = false;
    b_genre = false;
    b_classe = false;
    b_qualite = false;
    b_fonction = false;
    b_phone = false;
    b_degre = false;
    b_option = false;
    b_confirm_password = false;
    b_password = false;
    b_matricule = false;
    b_motif_paiement = false;
    b_devise = false;
    b_montant = false;
    b_codeAgent = false;
    b_libelle = false;
    b_compte = false;
    b_type_compte = false;
    b_sous_type_compte = false;
    $("#div_num_note_avance").hide()
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
    $("#form_ajout_compte").submit(function(e){
      e.preventDefault();
      var data = $(this).serialize();
      if(b_type_compte!="" && b_sous_type_compte!="" && $("#num_compte_ajout").val()!="" && $("#libelle_num_compte").val()!=""){
        $.ajax({
          type:'post',
          url:'./fonctions/insertions.php',
          data:data,
          success:function(server){
            if(server == true){
              $("#resultat").text('').text("L'opération s'est effectuée avec succès !").css('color','green').show();
              $("#resultat").fadeOut(3000);
              $(this).trigger('reset');
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
  // Soumission de l'enregistrement du nouvel eleve
    // Soumission du formulaire eleve
    $("#eleve").submit(function(e){
      e.preventDefault();
      var datas = $(this).serialize();
      if((b_nom==true) && (b_postnom==true) && (b_prenom == true) && (b_genre == true) && (b_classe == true) && (b_degre == true)){   
        if($("#classe").val()==4 && b_option== true){
          $.ajax({
            type:'post',
            data:datas,
            url:'./fonctions/insertions.php',
            success:function(server){
              console.log(server)
              if(server==true){
                $("#eleve").trigger('reset');
                b_nom = false;
                b_classe = false;
                $("#resultat").hide();
                swal("Enregistrement effectué",'','success');
              }else{
                $("#resultat").text("Enregistrement a echoué");
                $("#resultat").css("color", "red");
                $("#resultat").show();
              }
            }
          })
        }
        if($("#classe").val().length > 0 && $("#classe").val()!=4 && b_option == false){
          $.ajax({
            type:'post',
            data:datas,
            url:'./fonctions/insertions.php',
            success:function(server){
              console.log(server)
              if(server==true){
                $("#eleve").trigger('reset');
                b_nom = false;
                b_classe = false;
                $("#resultat").hide();
                swal("Enregistrement effectué",'','success');
              }else{
                $("#resultat").text("Enregistrement a echoué");
                $("#resultat").css("color", "red");
                $("#resultat").show();
              }
            }
          })
        }
    }else{
        return false;
    }
        
  });
 // VERIFICATION DES INFORMATION DU FORMULAIRE Agent
  
  // verification du nom
  $("#nomag").keyup(function(){
    if ($("#nomag").val().match(/^[-éèàâêëùû'a-z]+$/i)) {
        b_nom = true;
        $("#nomag").css("border-color", "green");
        $("#resultat").hide();
    } else {
      b_nom = false;
      $("#nomag").css("border-color", "#ff0000");
      $("#resultat").text("Ce nom n'est pas invalide");
      $("#resultat").css("color", "red");
      $("#resultat").show();
    }
  });  
  // verification du postnom
  $("#postnomag").keyup(function(){
    if ($("#postnomag").val().match(/^[-éèàâêëùû'a-z]+$/i)) {
        b_postnom = true;
        $("#postnomag").css("border-color", "green");
        $("#resultat").hide();
    } else{
      b_postnom = false;
      $("#postnomag").css("border-color", "#ff0000");
      $("#resultat").text("Ce postnom n'est pas invalide");
      $("#resultat").css("color", "red");
      $("#resultat").show();
    }
  });
  // verification du prenom
  $("#prenomag").keyup(function(){
    if ($("#prenomag").val().match(/^[-éèàâêëùû'a-z]+$/i)) {
        b_prenom = true;
        $("#prenomag").css("border-color", "green");
        $("#resultat").hide();
    } else {
      b_prenom = false;
      $("#prenomag").css("border-color", "#ff0000");
      $("#resultat").text("Ce prenom n'est pas correct");
      $("#resultat").css("color", "red");
      $("#resultat").show();
    }
  });  
  // verification du genre
  $("#genreag").change(function(){
    if ($("#genreag").val().length > 0 ) {
      b_genre = true;
      $("#genreag").css("border-color", "green");
      $("#resultat").hide();
    } else {
      b_genre = false;
      $("#genreag").css("border-color", "#ff0000");
      $("#resultat").show().text("Veuillez sélectionner un genre");
      $("#resultat").css("color", "red");
    }
  });
   // verification de la qualite
   $("#qualite").change(function(){
    if ($("#qualite").val().length > 0 ) {
      b_qualite = true;
      $("#qualite").css("border-color", "green");
      $("#resultat").hide();
    } else {
      b_qualite = false;
      $("#qualite").css("border-color", "#ff0000");
      $("#resultat").show().text("Veuillez sélectionner une qualité");
      $("#resultat").css("color", "red");
    }
  });
  // verification de la fonction
  $("#fonction").change(function(){
    if ($("#fonction").val().length > 0 ){
      $.ajax({
        type:'get',
        url:'./fonctions/filtrer_donnees.php?Numfonction='+$(this).val(),
        success:function(server){
          if(server==2){
            $("#fonction").css("border-color", "#ff0000");
            $("#resultat").show().text("Cette fonction est occupée");
            $("#resultat").css("color", "red");
          }else{
            $("#fonction").css("border-color", "green");
            $("#resultat").hide();
          }
        }
      })
      b_fonction = true;
      $("#fonction").css("border-color", "green");
      $("#resultat").hide();
    } else {
      b_fonction = false;
      $("#fonction").css("border-color", "#ff0000");
      $("#resultat").show().text("Veuillez sélectionner une fonction");
      $("#resultat").css("color", "red");
    }
  });
  //  verification du numero de telephone
  $("#telephone").keyup(function () {
    if ($("#telephone").val().match(/^[+][1-9][0-9]{9,11}$/)) {
      $("#telephone").css("border-color", "green");
      $("#resultat").hide();
      b_phone = true;
    } else {
      $("#telephone").css("border-color", "#ff0000");
      $("#resultat").show().text("Numéro de téléphone invalide, doit commencer par + et avoir au plus 13 caractères");
      $("#resultat").css("color", "red");
      b_phone = false;
    }
  });
  // Verification du mot de passe
  $("#password").keyup(function(){
    if ($("#password").val().length > 5 ){
      $("#password").css("border-color", "green");
      if ($("#password").val().length == 6){
        b_password = false;
        $("#password").css("border-color", "#ff0000");
        $("#resultat").show().text("Mot de passe trop faible ");
        $("#resultat").css("color", "red");
      }else if($("#password").val().length >= 7 && $("#password").val().length <= 10){
          b_password = true;  
          $("#password").css("border-color", "green");
          $("#resultat").show().text("Mot de passe moyen ");
          $("#resultat").css("color", "orange");
      }else if($("#password").val().length > 10 && $("#password").val().length <= 14){
        b_password = true;
          $("#password").css("border-color", "green");
          $("#resultat").show().text("Mot de passe de passe bon ");
          $("#resultat").css("color", "blue");
      }else{
          b_password = true;
          $("#password").css("border-color", "green");
          $("#resultat").show().text("Mot de passe de passe fort ");
          $("#resultat").css("color", "green");         
      }
    }else{
        b_password = false;
        $("#resultat").show().text("Le mot de passe doit avoir au moins 7 caractères ");
        $("#resultat").css("color", "red");
        $("#password").css("border-color", "red");        
    }
  });
   // confirmation du mot de passe
   $("#confirm_password").keyup(function () {
    if(b_password == true && $("#confirm_password").val() == $("#password").val()) {
      b_confirm_password = true;
      $("#confirm_password").css("border-color", "green");
      $("#password").css("border-color", "green");
      $("#resultat").hide();
    }else if (b_password == true && $("#confirm_password").val() != $("#password").val()) {
      b_confirm_password = false;
      $("#confirm_password").css("border-color", "#ff0000");
      $("#resultat").show().text("Les mots de passe ne correspondent pas !");
      $("#resultat").css("color", "red");
    }else {
      b_confirm_password = false;
      b_password = false;
      $("#confirm_password").css("border-color", "#ff0000");
      $("#resultat").show().text("Le mot de passe est trop faible !");
      $("#resultat").css("color", "red");
    }
  });
  // Soumission de l'enregistrement du nouvel agent
// Soumission du formulaire agent
$("#agent").submit(function(e){
  e.preventDefault();
  var datas = $(this).serialize();
  if((b_nom==true) && (b_postnom==true) && (b_prenom == true) && (b_genre == true) && (b_fonction == true) && (b_phone == true) && (b_password == true) && (b_confirm_password == true)){   
    $.ajax({
      type:'post',
      data:datas,
      url:'./fonctions/insertions.php',
      success:function(server){
        if(server==true){
          $("#agent").trigger('reset');
          b_nom = false;
          b_classe = false;
          $("#resultat").hide();
          swal("Enregistrement effectué",'','success');
        }
        if(server == false){
          $("#resultat").text("L'enregistrement a echoué");
          $("#resultat").css("color", "red");
          $("#resultat").show();
        }
        if(server == 2){
          $("#resultat").text("Cette fonction est occupée !");
          $("#resultat").css("color", "red");
          $("#resultat").show();
        }
      }
    })
  }else{
      swal("Formulaire non valide","","error");
  }
    
});

    paiementCollation_ou_Frais_Bus();
    // Enregistrement de l'avance sur salaire
    $("#deviseAvance").change(function(){
      if($(this).val()==""){
        b_devise = false;
        $("#deviseAvance").css('border-color','red')
        $("#resultat").text('').text("Veuillez sélectionner une devise SVP !").css('color','red').show();
      }else{
        b_devise = true;
        $("#deviseAvance").css('border-color','green')
        $("#resultat").text('')
      }
    })
// Soumission du formulaire d'enregistrement d'avance sur salaire
$("#formAvance").submit(function(e){
  e.preventDefault();
  // verification du code agent
  if($("#codeAgent").val()==""){
        b_codeAgent = false;
        $("#codeAgent").css('border-color','red')
        $("#resultat").text('').text("Veuillez entrez un code agent !").css('color','red').show();
  }else{
    b_codeAgent = true;
    $("#codeAgent").css('border-color','green')
    $("#resultat").text('')
  }
  // verification du montant saisi
  if($("#montantDemande").val()==""){
    b_montant = false;
    $("#montantDemande").css('border-color','red')
    $("#resultat").text('').text("Veuillez entrez un montant !").css('color','red').show();
  }else{    
      if($("#montantDemande").val()>=5 && $("#deviseAvance").val()=="USD"){
        b_montant = true;
        $("#montantDemande").css('border-color','green')
        $("#resultat").text('')
      }
      else if($("#montantDemande").val()>=10000 && $("#deviseAvance").val()=="CDF"){
        b_montant = true;
        $("#montantDemande").css('border-color','green')
        $("#resultat").text('')
      }
      else{
        b_montant = false;
        $("#montantDemande").css('border-color','red')
        $("#resultat").text('').text("Montant trop petit !").css('color','red').show();
      }  
  }
  // verification du motif
  if($("#libelleAvance").val()==""){
    b_libelle = false;
    $("#libelleAvance").css('border-color','red')
    $("#resultat").text('').text("Le motif de la demande manque !").css('color','red').show();
  }else{
    b_libelle = true;
  $("#libelleAvance").css('border-color','green')
  $("#resultat").text('')
  }
    if(b_devise==true && b_codeAgent==true && b_montant==true && b_libelle==true){
      $.ajax({
        type:'post',
        url:'./fonctions/insertions.php',
        data:$("#formAvance").serialize(),
        success:function(server){
          if(server==true){
            $("#formAvance").trigger('reset');
            b_libelle = false;
            b_codeAgent = false;
            swal('Enregistrement effectué !','','success');
          }else{
            console.log(server);
            swal('Une erreur s\'est produite','','error');
          }
        }
      })
      
    }else{
      swal('Formulaire non valide','','error');
    }
})


// Crediter ou debiter le compte des clients ou du personnel
$("#num_compte").change(function(){
  if($(this).val()==41){
    b_compte = true;
    $("#resultat").text('').text("Cette opération sera appliquée à tous les clients !").css('color','blue').show();
  }else if($(this).val()==42){
    b_compte = true;
    $("#resultat").text('').text("Cette opération sera appliquée à chaque personnel !").css('color','blue').show();
  }else{
    b_compte = false;
    $("#resultat").text('').text("Veuillez sélectionner un compte !").css('color','red').show();
  }
})
// Soumission du formulaire qui credite ou debite le compte des clients ou du personnel
$("#crediter_debiter_client_personnel").submit(function(e){
  e.preventDefault();
  if(b_compte == true){
    var datas = $('#num_compte').val();
    $.ajax({
      type:'get',
      // data:datas,
      url:'./fonctions/automatique.php?crediterDebiter='+datas,
      success:function(server){
      //  if(server==true)
          $("#resultat").text('').text("L'opération s'est effectuée avec succès !").css('color','green').fadeOut(2000);
      //  if(server == false){
      //     $("#resultat").text('').text("Une erreur s'est produite !").css('color','red').show();
      //     console.log(server);
      //   }
      }
    })
  }else{
    $("#resultat").text('').text("Veuillez sélectionner un compte !").css('color','red').show();
  }
  
})

$("#article").keyup(function(){
  $.ajax({
    type:'get',
    url:'./fonctions/filtrer_donnees.php?article',
    success:function(server){
      $("#resultat_recherche_article").html('');
      $("#resultat_recherche_article").html(server)
    }
  })
})

    // Soumission de paiement de la collation
    $("#operation").submit(function(e){
      e.preventDefault();
      if(paiementCollation_ou_Frais_Bus()){
        if($("#montantPaiement").val()<5000 && $("#devise").val()=="CDF"){
          $("#resultat").css('color','red').text('Le montant minimum en CDF est de 5000 !').show();
        }
        else if($("#montantPaiement").val()<2.5 && $("#devise").val()=="USD"){
          $("#resultat").css('color','red').text('Le montant minimum en USD est de 2.5 !').show();
        }
        else if($("#montantPaiement").val()>250 && $("#devise").val()=="USD"){
          $("#resultat").css('color','red').text('Le montant maximum en USD est de 250 !').show();
        }
        else if($("#montantPaiement").val()>500000 && $("#devise").val()=="CDF"){
          $("#resultat").css('color','red').text('Le montant maximum en CDF est de 500000 !').show();
        }
        else{
          $.ajax({
            type:'post',
            data:$("#operation").serialize(),
            url:'./fonctions/insertions.php',
            success:function(server){
              if(server==true){
                $("#resultat").text('');
                $("#resultat").css('color','green').text('Enregistrement effectué !').show();
                $("#resultat").fadeOut(3000);
                $("#operation").trigger('reset');
                b_matricule = false;
                b_montant = false;
              }else if(server==3){
                $("#resultat").text('');
                $("#resultat").css('color','red').text("Cette opération n'est peut être liée à un élève !").show();
              }else if (server == 2){
                $("#resultat").text('');
                $("#resultat").css('color','red').text("Cette opération n'est peut être liée à un agent !").show();
              }else{
                $("#resultat").text('');
                $("#resultat").css('color','red').text('Une erreur est survenue !').show();
              }
            }
          });
        }
      }else
        swal('Formulaire non valide','','error');
    })

    

});

// Fonciton de paiement de collation ou frais de bus
function paiementCollation_ou_Frais_Bus(){
        $("#matricule").keyup(function(){
          if($("#matricule").val()!=''){
            b_matricule = true;
          }
          if($(this).val()==""){
            b_matricule = false;
            $("#matricule").css('border-color','red')
            $("#resultat").css('color','red').text('Entrez un identifiant valide !').show();
          }else{
            b_matricule = true;
            $("#resultat").hide();
            $("#matricule").css('border-color','green')
          }
        })
        // verifier type operation
        $("#type_operation").change(function(){
          if($("#matricule").val()!=''){
            b_matricule = true;
          }
          if($(this).val()==""){
            b_motif_paiement = false;
            $("#type_operation").css('border-color','red');
            $("#resultat").css('color','red').text('Sélectionner un motif de paiement').show();
          }else{
            b_motif_paiement = true;
            $("#resultat").hide();
            $("#type_operation").css('border-color','green')
            // On verifie si l'operation est une avance sur salire
            if($(this).val()==5){
              $("#div_num_note_avance").show()
              $("#btn_enregis_paiement").hide()
            }
          }
        })
        // Verifier la devise
        $("#devise").change(function(){
          if($("#matricule").val()!=''){
            b_matricule = true;
          }
          if($(this).val()==""){
            b_devise = false;
            $("#devise").css('border-color','red')
            $("#resultat").css('color','red').text('Sélectionner une dévise !').show();
          }else{
            b_devise = true;
            $("#resultat").hide();
            $("#devise").css('border-color','green')
          }
        })
        // Quand on ecrit dans la zone de montant
        $("#montantPaiement").keyup(function(){
          if($("#matricule").val()!=''){
            b_matricule = true;
          }
          if($(this).val()=="" || isNaN( $(this).val())){
            b_montant = false;
            $("#montantPaiement").css('border-color','red')
            $("#resultat").css('color','red').text('Entrez un montant valide !').show();
          }else{
            b_montant = true;
            $("#resultat").hide();
            $("#montantPaiement").css('border-color','green')
          }
        })
        if(b_matricule==true&&b_motif_paiement==true&&b_devise==true&&b_montant==true){
          return true;
        }else{
          return false;
        }
        // Partie ajax   
}
// Fonction d'insertion des eleves
function insertEleve(){  

}

// Fonction d'insertion des agents
function insertAgent(){  
 
}