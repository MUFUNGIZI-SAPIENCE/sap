<?php
require_once('../Class/Class.Classe.php');
require_once('../Class/Class.Agent.php');
require_once('../Class/Class.Article.php');
require_once('../Class/Class.Comptabilite.php');

if(isset($_GET['num_type_compte'])){
    ?>
    <option value="" selected>.........</option>
    <?php
    foreach (Comptabilite::get_sous_type_compte($_GET['num_type_compte']) as $value) {
        ?>
            <option value="<?= $value['Num_sous_type_compte']?>"><?= $value['Libelle_sous_type_compte']?></option>
        <?php
    }
}
// Recherche des articles
if(isset($_GET['article'])){
    // foreach (Article::rechercherArticle($_GET['article']) as $value) {
        ?>
            <tr>
                <td><?= Article::rechercherArticle($_GET['article'])['Designationarticle']?></td>
            </tr>
        <?php
    // }
}
if(isset($_GET['Numfonction'])){
    $fonction = Agent::filtrerFonctionAgent($_GET['Numfonction']);
    if($fonction == false){
        echo false;
    }else{
        if($fonction==9 || $fonction==10 || $fonction==11){
            echo true;
        }
        else
        echo 2;
    }
}
if(isset($_GET['Id_classe']) && !empty($_GET['Id_classe'])){
    // Quand maternelle est selectionnee
    if($_GET['Id_classe']==1){
        ?>
            <option value="">-------</option>
        <?php
        for ($i=1; $i<=3 ; $i++) {
            if($i==1){
            ?>
            <option value="<?=$i?>"><?=$i." ère"?></option>
            <?php
            }else{
                ?>
                <option value="<?=$i?>"><?=$i." ème"?></option>
            <?php
            }        
        }
    }
    // Quand primaire est selectionne
    if($_GET['Id_classe']==2){
        ?>
            <option value="">-------</option>
        <?php
        for ($i=1; $i<=6 ; $i++) {
            if($i==1){
                ?>
                <option value="<?=$i?>"><?=$i." ère"?></option>
                <?php
                }else{
                    ?>
                    <option value="<?=$i?>"><?=$i." ème"?></option>
                <?php
                } 
        }
    }
    // Quand secondaire es selectionne
    if($_GET['Id_classe']==3){
        ?>
            <option value="">-------</option>
        <?php
        for ($i=7; $i<=8 ; $i++) {
            if($i==1){
                ?>
                <option value="<?=$i?>"><?=$i." ère"?></option>
                <?php
            }else{
                ?>
                <option value="<?=$i?>"><?=$i." ème"?></option>
            <?php
            }
        }
    }
    // Quand humanité est selectionnee
    if($_GET['Id_classe']==4){
        ?>
            <option value="">-------</option>
        <?php
        for ($i=1; $i<=4 ; $i++) {
            if($i==1){
                ?>
                <option value="<?=$i?>"><?=$i." ère"?></option>
                <?php
            }else{
                ?>
                <option value="<?=$i?>"><?=$i." ème"?></option>
                <?php
            } 
        }
    }
}