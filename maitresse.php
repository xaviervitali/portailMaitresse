<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'administration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            background: url('assets/img/board.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            padding: 1rem;
            height: 100vh;
            overflow: scroll;

        }

        form div {
            margin-bottom: 1rem;
        }

        .block {
            padding: 1rem;
            background-color: whitesmoke;
            border-radius: 1rem;
            margin: 1rem 0;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="h3 text-center text-white mb-3">Bienvenue dans l'interface d'administration des devoirs</div>
    <div class="h4 text-center text-white">Que souhaitez-vous ajouter ?</div>

    <a href="parents.php" class="btn btn-primary ">Voir la page des parents</a>

    <div id="liens">




        <?php
        require "private/functions.php";
        session_start();
        // Lecture d'une valeur du tableau de session
        // var_dump($_SESSION['login']);
        $level = intval($_SESSION['login']);
        $level > 1 ? '' : header('Location: index.php');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $tabMatieres = readTable('matieres', 'nom', 'ASC');
        $matieres = '';
        $listeMatieres = [];
        foreach ($tabMatieres as $matiere => $nom) {
            $listeMatieres[$nom['id']] = $nom['nom'];
            $matieres .= '<option value=' . $nom['id'] . '>' . $nom['nom'] . '</option>';
        };


        require 'private/controller/idForm.php';
        require 'private/view/liens.php';
        require 'private/view/notes.php';
        require 'private/view/fiches.php';

        ?>




        <!-- Fin de block -->




</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.tiny.cloud/1/jwifx6cyqjsshd8l1nxakb6hbbvlisgj6ngqgvw0aiyc15lr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#mytextarea',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
    });
    // Partie Vue

    var app = new Vue({
        el: '#liens',
        data: {
            devoirs: {},
            liens: [],
            url: '',
            fiches: [],
            ficheLien: "",
            matieres: <?php echo json_encode($listeMatieres) ?>,
            notes: []
        }

        ,
        async created() {
            await this.load()
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        },

        methods: {
            async load() {
                const devoirs = await fetch(
                    "api.php"
                ).then(function(reponse) {
                    return reponse.json();
                })
                this.devoirs = devoirs
                this.liens = devoirs.liens_utiles
                this.fiches = devoirs.fiches
                this.notes = devoirs.notes

            },


            getDate(date) {
                return new Date(date).toLocaleDateString('fr-FR')
            },
            sliceHtml(html) {
                return html.slice(0, 250).trim()
            }
        },
        computed: {}



    });
</script>

</html>