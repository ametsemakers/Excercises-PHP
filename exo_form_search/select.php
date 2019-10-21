<?php
require 'connexion.php';

$requete = 'SELECT parent FROM projet';
$requete2 = 'SELECT id_util FROM projet';
$resultat = $pdo->query($requete);
$resultat2 = $pdo->query($requete2);

?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Select</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">
                    <form action="select.php" method="post">

                        <div class="form-group">
                            <label for="parent">Parent</label>
                            <select name="parent" id="parent" class="custom-select">

                                <?php

                                    while($ligne_tab = $resultat->fetch())               
                                    {              
                                ?>

                                    <option value="<?php echo $ligne_tab['parent'] ?>"><?php echo $ligne_tab['parent']  ?></option>
                                
                                <?php
                                    }                          
                                ?>

                            </select>
                        </div>
                        
                        <div class="form-group"> 
                            <label for="idUtil">Id Utilisateur</label>
                            <select name="idUtil" id="idUtil" class="custom-select">

                                <?php

                                    while($ligne_tab2 = $resultat2->fetch())               
                                    {              
                                ?>

                                    <option value="<?php echo $ligne_tab2['id_util'] ?>"><?php echo $ligne_tab2['id_util']  ?></option>
                                
                                <?php
                                    }
                                ?>

                            </select>
                        </div> 
                        <button type="submit" name="submit" class="btn btn-dark my-1">Rechercher</button>                
                    </form>
                </div>
            </div>

            <?php
                if (isset($_POST['submit']))
                {
                    if ((!empty($_POST['parent'])) || (!empty($_POST['idUtil'])))
                    {
                        $parent = $_POST['parent'];
                        $idUtil = $_POST['idUtil'];

                        $requete3 = $pdo->prepare("SELECT id_projet, nom_projet, descr, date_deb, date_fin, avancement, parent, id_util FROM projet WHERE parent = :parent AND id_util = :idUtil");

                        $requete3->bindValue(':parent', $parent);
                        $requete3->bindValue(':idUtil', $idUtil);

                        $requete3->execute();

                        $nb_ligne = $requete3->rowCount();

                        if ($nb_ligne != 0)
                        {
                        ?>

                        <table class="table table-hover mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Descr</th>
                                    <th scope="col">Date déb</th>
                                    <th scope="col">Date fin</th>
                                    <th scope="col">Avancement</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">Id util</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($ligne_tab = $requete3->fetch())               
                                    {              
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $ligne_tab['id_projet'] ?></th>       
                                        <td><?php echo $ligne_tab['nom_projet'] ?></td>
                                        <td><?php echo $ligne_tab['descr'] ?></td>
                                        <td><?php echo $ligne_tab['date_deb'] ?></td>
                                        <td><?php echo $ligne_tab['date_fin'] ?></td>
                                        <td><?php echo $ligne_tab['avancement'] ?></td>
                                        <td><?php echo $ligne_tab['parent'] ?></td>
                                        <td><?php echo $ligne_tab['id_util'] ?></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    }

                }
            }
            else
            {
            ?>

            <div class="row mt-5">
                <div class="col-md-12">
                    Veuillez choisir des paramètres...
                </div>
            </div>

            <?php
            }
            ?>
        </div>



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>
