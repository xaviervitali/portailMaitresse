<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'administration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            background: url('assets/img/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            padding: 1rem;

        }

        form div {
            margin-bottom: 1rem;
        }

        .url {
            font-size: .8rem;
        }

        .block {
            padding: 1rem;
            background-color: whitesmoke;
            border-radius: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="h3 text-center text-white mb-3">Bienvenue dans l'interface d'administration des devoirs</div>
    <div class="h4 text-center text-white">Que souhaitez-vous ajouter ?</div>

    <a href="parents.php" class="btn btn-primary btn-sm">Voir la page des parents</a>

    <!-- Partie accordeon -->


    <div id="accordion">

        <?php
        require "private/functions.php";
        session_start();
        // Lecture d'une valeur du tableau de session
        // var_dump($_SESSION['login']);
        $level = intval($_SESSION['login']);
        $level > 1 ? '' : header('Location: index.php');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        function cardGenerator($title, $content, $id, $target, $parent = 'accordion')
        {
            echo
                <<<card
<div class="card">
    <div class="card-header" id="$id">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#$target" aria-expanded="true" aria-controls="$target">
          $title
        </button>
      </h5>
    </div>

    <div id="$target" class="collapse show" aria-labelledby="$id" data-parent="#$parent">
      <div class="card-body ">
$content
      </div>
    </div>
card;
        }
        $categories = [
            'liens' => [
                'title' => 'Lien utile',
                'content' => require_once 'urlNew.php',
                'btnColapsed' => '',


            ],
            'fiches' => [
                'title' => 'Fiche',
                'content' => 'fiche',
                'btnColapsed' => '',

            ],
        ];

        foreach ($categories as $categorie => $values) {

            // cardGenerator($values['title'], $values['content'], 'id_' . $categorie, $categorie, 'accordion');

            echo ($values['content'] . '</div>');
        };

        ?>

    </div> <!-- fin accordeon -->

</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip({
            boundary: 'window'
        })

    })
</script>
<script src="assets/js"></script>

</html>