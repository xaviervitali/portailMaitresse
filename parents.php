<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des parents</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            background: url('assets/img/kids.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            padding: 1rem;
            height: 100vh;
            background-attachment: fixed;
            /* overflow: scroll; */


        }

        #matieres {
            font-size: .8rem;
        }


        #matiere {
            text-shadow: 0 0 1px black;


        }

        .card-body {
            max-height: 70vh;
            overflow: scroll;
        }

        #matieresAcc,
        #accordion {
            margin-bottom: 2rem;
        }
    </style>
</head>

<body class="d-flex flex-wrap justify-content-around align-items-center">



    <!-- partie accordeon
##################
##################
##################
##################
-->

    <div id="accordion" class="col-lg-8 col-md-6 col-sm-12">




        <?php
        // Démarrage ou restauration de la session
        session_start();
        // Lecture d'une valeur du tableau de session
        // var_dump($_SESSION['login']);
        $level = intval($_SESSION['login']);
        $texte =     '<a href="parents.php" class="btn btn-primary btn-sm">Voir la page des parents</a>';
        $level > 0 ? '' : header('Location: index.php');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require_once 'private/functions.php';
        $notes = readTable('notes');
        $compteur = 0;
        foreach ($notes as $note => $content) {
            $compteur++;

            $dt = new DateTime($content['date']);
            $date = $dt->format("d/m/Y à h:m");
            $texte = $content['note'];
            $id = $content['id'];
            // $display = '';
            $collapsed = '';

            if ($compteur < 2) {
                $display = 'show';
                $aria = true;
            } else {
                $display = '';

                $collapsed = 'collapsed';
                $aria = false;
            }
            echo
                <<<accord
        <div class="card">
            <div class="card-header" id="heading$id">
                <h5 class="mb-0">
                    <button class="btn btn-link $collapsed" data-toggle="collapse" data-target="#collapse$id" aria-expanded="$aria" aria-controls="collapse$id">
                       Note d'information aux parents du  $date
                    </button>
                </h5>
            </div>

            <div id="collapse$id" class="collapse $display" aria-labelledby="heading$id" data-parent="#accordion">
                <div class="card-body">
                $texte
          </div>
        </div>

        </div>
accord;
        }
        ?>



    </div>

    <!--fin de partie accordeon
##################
##################
##################
##################
-->

    <!-- partie matieres
##################
##################
##################
##################
-->

    <div class=" col-lg-4 col-md-6 col-sm-12">
        <h5 class="text-center text-light">Liste des matières</h5>

        <div id="matieresAcc">

            <?php


            $matieres = readTable('matieres', 'nom', 'ASC');

            $compteur = 0;

            foreach ($matieres as $matiere => $nom) {
                $compteur++;
                $show = '';
                if ($compteur < 2) {
                    $show = 'show';
                }
                $aria = false;
                $liens = readLine_('liens_utiles', $nom['id'], 'matiere');
                $listeLiens = "";
                $nbLien = 0;
                foreach ($liens as $lien => $infoLien) {
                    $url = $infoLien['url'];
                    $commentaire = $infoLien['commentaire'] = '' ? $url : $infoLien['commentaire'];
                    $listeLiens .=

                        <<<listeLien
                    <div><a href=" $url" target="_blank">$commentaire</a></div>
listeLien;
                    $nbLien++;
                }

                $fiches = readLine_('fiches', $nom['id'], 'matiere');
                $listeFiches = "";
                $nbFiche = 0;
                foreach ($fiches as $Fiche => $infoFiche) {
                    $chemin = $infoFiche['chemin'];
                    $titre = $infoFiche['titre'];
                    $dt = new DateTime($infoFiche['date']);
                    $date = $dt->format("d/m/Y");

                    $listeFiches .=
                        <<<listeFiches
                    <div><a href=" $chemin" target="_blank"> $date $titre</a></div>
listeFiches;

                    $nbFiche++;
                }
                if ($nbFiche > 0 || $nbLien > 0) {
                    $id = $nom['id'];


                    $nomMat = mb_strtoupper($nom['nom']);
                    echo
                        <<<matiere

            <div class="card"  >
            <div class="card-header" id="heading$id" >
                <h5 class="mb-0">
                    <button class="btn btn-link $collapsed" data-toggle="collapse" data-target="#collapse$id" aria-expanded="$aria" aria-controls="collapse$id">
                    $nomMat
                    </button>
                </h5>
                </div>
                <div id="collapse$id" class="collapse $show" aria-labelledby="heading$id" data-parent="#matieresAcc">
                <div class="card-body">


matiere;

                    if ($nbFiche > 0) {
                        echo
                            <<<fiche
            <div>   
            <h5>Fiches</h5>

                $listeFiches
                </div>
               
fiche;
                    }

                    if ($nbLien > 0) {
                        echo
                            <<<lien
                            <div>  
            <h5>Liens</h5>
                $listeLiens
                </div>
lien;
                    }

                    // echo ('<option value=' . $nom['id'] . '>' . $nom['nom'] . '</option>');
                    echo ("</div></div></div>");
                }
            };


            ?>



        </div>
    </div>
    <?php
    if ($level > 1) {
        echo ('
            <a href="maitresse.php" class="btn btn-primary  text-center">Retourber sur la page d administration</a>');
    }
    ?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    // $(function() {
    //     $('[data-toggle="tooltip"]').tooltip()
    // })
</script>

</html>