<?php
if (isset($_POST['submit']))
{
    if ((!empty($_POST['parent'])) || (!empty($_POST['idUtil'])))
    {
        $parent = $_POST['parent'];
        $idUtil = $_POST['idUtil'];

        require 'connexion.php';

        echo $parent . ' ' . $idUtil;

        $requete = $pdo->prepare("SELECT id_projet, nom_projet, descr, date_deb, date_fin, avancement, parent, id_util FROM projet WHERE parent = :parent AND id_util = :idUtil");

        $requete->bindValue(':parent', $parent);
        $requete->bindValue(':idUtil', $idUtil);

        $requete->execute();

        $nb_ligne = $requete->rowCount();

        if ($nb_ligne != 0)
        {
        ?>

            <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Projets</title>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                </head>

                <body>
                    <div class="container-fluid">
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
                                    while($ligne_tab = $requete->fetch())               
                                    {              
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $ligne_tab['id_projet'] ?></th>       
                                        <td><?php echo $ligne_tab['nom_projet'] ?></td>
                                        <td><?php echo $ligne_tab['descr'] ?></td>
                                        <td><?php echo $ligne_tab['date_deb'] ?></td>
                                        <td><?php echo $ligne_tab['date_fin'] ?></td>
                                        <td><?php echo $ligne_tab['avancement'] ?></td>
                                        <td><a href="#"><?php echo $ligne_tab['parent'] ?></a></td>
                                        <td><a href="#"><?php echo $ligne_tab['id_util'] ?></a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
                </body>
            </html>


        <?php
        }

    }
    

}