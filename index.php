<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail des devoirs
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/main.css">

<body>

    <div class="mainContainer">
        <p class="h2 text-center ">Bienvenue dans l'espace des devoirs</p>
        <div>
            <?
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            require_once 'private/controller/checkUser.php';
            if (isset($_REQUEST['user']) && isset($_REQUEST['password'])) {
                $level = validUser($_REQUEST['user'], $_REQUEST['password']);



                switch ($level) {
                    default:
                        // Démarrage ou restauration de la session
                        session_start();
                        // Réinitialisation du tableau de session
                        // On le vide intégralement
                        $_SESSION = array();
                        // Destruction de la session
                        session_destroy();
                        // Destruction du tableau de session
                        unset($_SESSION);
                        echo ("<div class='h3 text-center text-danger'>Nom d'utilisateur ou mot de passe erroné !</div>");
                        break;
                    case 1:
                        header('Location: parents.php');
                        break;
                    case 2:
                        header('Location: maitresse.php');
                        break;
                    case 5:
                        header('Location: maitresse.php');
                        break;
                }
            }
            ?>
            <form method='post'>
                <label for="user">Nom d'utilisateur</label>
                <input type="text" name="user" class="form-control" id="user" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>


        <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>