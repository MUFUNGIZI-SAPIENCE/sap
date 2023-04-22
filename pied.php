    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Billingue le Messager 2021</span></div>
        </div>
    </footer>
    <!-- </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div> -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/my_js/sweetalert.min.js"></script>
    <script src="assets/my_js/insert.js"></script>
    <script src="assets/my_js/delete.js"></script>
    <script src="assets/my_js/update.js"></script>
    <script src="assets/my_js/recherche.js"></script>
    <script src="assets/my_js/login.js"></script>
    <script src="assets/my_js/print.js"></script>
    <script src="assets/my_js/automatique.js"></script>
    <script src="assets/my_js/modifier.js"></script>
        <!-- NOS PROPRES SCRIPTS -->
<script>
$(document).ready(function(){
    $("#div_type_releve").hide();
    $("#div_releve").hide();
    $("#div_code_agent").hide();
    $("#div_code_eleve").hide();
    $("#div_charger_compte_agent").hide();
    // AFFICHAGE DU RELEVE DES 
$("#btn_afficher_releve").click(function(){
    if($("#code_agent").val()!=""){
        var code = $("#code_agent").val();
        $("#div_releve").show();
        $("#resultat").text('');
        $.ajax({
            type:'get',
            url:'./fonctions/recherche.php?codeAgent_releve='+code,
            success:function(server){
                $("#div_releve").html('');
                $("#div_releve").html(server);
                console.log(server)
            }
        })
    }else if($("#code_eleve").val()!=""){
        var code = $("#code_eleve").val();
        $("#div_releve").show();
        $("#resultat").text('');
        $.ajax({
            type:'get',
            url:'./fonctions/recherche.php?codeEleve_releve='+code,
            success:function(server){
                $("#div_releve").html('');
                $("#div_releve").html(server);
                console.log(server)
            }
        })
    }
    else{
        $("#div_releve").hide();
        $("#resultat").text('').text("Veuillez écrire le code ou matricule").css('color','red').show(3000);
    }
    

})

    $("#link_releve").click(function(e){
        e.preventDefault();
        $("#div_type_releve").show();
    })
    $("#categorie_releve").change(function(){
        if($(this).val()==1){
            $("#code_eleve").val('');
            $("#div_code_agent").show();
            $("#div_code_eleve").hide();
            $("#div_releve").hide();
            $("#div_type_releve").css('border-color','green');
        }else if($(this).val()==2){
            $("#code_agent").val('');
            $("#div_code_eleve").show();
            $("#div_releve").hide();
            $("#div_code_agent").hide();
            $("#div_type_releve").css('border-color','green');
        }else{
            $("#resultat").text('').text("Veuillez sélectionner une catégorie").css('color','red').show();
            $("#div_type_releve").css('border-color','red');
            $("#div_code_eleve").hide();
            $("#div_code_agent").hide();
        }
    })
    // Quand on clique sur le lien qui charger le compte des agents
    $("#link_charger_compte_agent").click(function(e){
        e.preventDefault();
        conception();
        $("#div_charger_compte_agent").show();
    })
    
    $("#close").click(function(e){
        e.preventDefault();
        $("#note_avance").slideUp();
        $("#resultat_avance").text('')
    })
    $("#div_option").hide();
    $("#note_avance").hide();
    $("#classe").change(function(){
        var classe_value = $(this).val();
        selectClasse(classe_value);
    })
    
});
// Fonction qui permet de soutirer le montant d'avance sur salaire
function soutirer(Numavance){
    $.ajax({
        type:'get',
        url:'./fonctions/insertions.php?Numavance='+Numavance,
        success:function(server){
            if(server==true){
                $("#note_avance").hide();
                $("#note_").html('');
                $("#resultat_avance").text('').css('color','green').text("Opération effectuée avec succès").fadeOut(5000);
            }else if(server == 2){
                $("#resultat_avance").text('').css('color','red').text("Cette note d'avance sur salaire a déjà été servie !").show();
            }else{
                $("#resultat_avance").text('').css('color','red').text("Une erreur s'est produite").show();
                console.log(server);
            }
        }
    })
}
// Fonction de selection d'une note d'avance sur salaire
function note_avance(id_avance){
    $("#note_avance").slideUp(200);
    $.ajax({
        type:'get',
        url:'fonctions/recherche.php?id_avance='+id_avance,
        success:function(server){
            $("#note_avance").css('position','fixed');
            $("#note_avance").css('top','2%');
            $("#note_avance").css('left','35%');
            $("#note_avance").css('right','70%');
            $("#note_avance").css('z-index',1060);
            $("#note_avance").css('background','rgb(35, 58, 185)');
            $("#note_avance").css('width','50%');
            $("#note_avance").css('border-color','black');
            $("#note_avance").css('opacity','95%');
            $("#note_avance").slideDown(100);
            $("#note_").html('');
            $("#note_").html(server);
            
        }
    })
}
// Fonction de selection d'une classe
function selectClasse(classe_value){
// PARTIE DE RELEVE DE COMPTEE
    if(classe_value!=""){
        if(classe_value==4){
            $("#div_option").show();
        }else
            $("#div_option").hide();
            $("#option").val('');
        $("#classe").css('border-color','green');
        $("#resultat").hide();
        $.ajax({
            type:'get',
            url:'./fonctions/filtrer_donnees.php?Id_classe='+classe_value,
            dataType:'html',
            success:function(server){
                $("#degre").html('')
                $("#degre").html(server)
            }
        });
    }else{
            $("#degre").html('')
            $("#classe").css('border-color','red');
            $("#resultat").css('color','red').text('Veullez sélectionner une classe.');
            $("#resultat").show();
        }
}
function conception(){
    swal("Cette section est en cours de conception","","warning");
}
    </script>
</body>
</html>