<?php
if(session_start()===null)session_start();
?>
<!DOCTYPE html>
<html>
<body id="page-top">
    <div id="wrapper">
        <!-- debut de nav -->
        <?php require_once('nav_gestionnaire.php') ?>
        <?php
if(isset($_SESSION['gestionnaire']))
{
    require_once('Class/Class.Agent.php');
        ?>
        <!-- Fin de nav -->
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- en-tete -->                              
        <?php require_once('tete_gestionnaire.php') ?>
                <!-- fin en-tete -->
            <div class="container">
                <div class="card shadow">
                    <div class="card-header py-3 bg-primary">
                        <p class="text-white m-0 font-weight-bold ">LISTE DES AGENTS</p>
                    </div>
                    <div class="card-body no-print">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-md-left dataTables_filter form-inline" id="dataTable_filter">
                                    <span class="btn-group form-control-md">
                                        <input type="search" class="form-control" aria-controls="dataTable" placeholder="Recherche...">
                                        <button class="form-control  fa fa-search btn btn-primary" type="button"></button>
                                    </span>
                                    &nbsp;                                   
                                    <button onclick="imprimer('liste_eleve')" class="form-control form-control-sm fa fa-print btn btn-primary" type="button"></button>
                                </div>
                            </div>
                        </div>
                        <div id="liste_eleve" class="table-responsive  mt-2 col-lg" id="dataTable" role="grid" aria-describedby="dataTable_info">
                          
                        <table class="table-bordered table-hover table-responsive dataTable my-0 table-responsive" id="dataTable">
                                <thead class="bg-primary text-center text-white">
                                    <tr>
                                        <th colspan="7">LISTE DES AGENTS</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>NOM</th>
                                        <th>POSTNOM</th>
                                        <th>PRENOM</th>
                                        <th>GENRE</th>
                                        <th>FONCTION</th>
                                        <th>CODE</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-dark text-white text-justify">
                                    <?php
                                    foreach (Agent::listeAgent() as $key => $value) {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-align-justify text-white"></i> 
                                                    <i class="caret text-white"></i>
                                                </button>
                                                    <ul class="dropdown-menu"> 
                                                        <li><a id="modif_eleve_link" href="modifier_agent.php?Numagent=<?=$value['Numagent']?>"><i class="fa fa-edit"></i>&nbsp;Modifier</a></li>
                                                    </ul>
                                            </div>
                                        </td>
                                        <td><?= strtoupper($value['Nomagent'])?></td>
                                        <td><?= strtoupper($value['Postnom'])?></td>
                                        <td><?= $value['Prenom']?></td>
                                        <td><?= $value['Genreagent']?></td>
                                        <td><?= $value['Libellefonction']?></td>
                                        <td><?= $value['Codeagent']?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>                                
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
require_once('pied.php');
}else{
    header('location:index.php');
}