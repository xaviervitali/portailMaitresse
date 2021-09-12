<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <style>
    table {
      font-size: .8rem;
    }

    #addContent {
      /* background: url('assets/img/board.jpg'); */
      background-size: cover;
      background-repeat: no-repeat;
      color: white;
      padding: 3rem;
      height: 100vh;
      background-attachment: fixed;
      overflow: scroll;

    }

    th,
    td {
      text-align: center;
    }


    .modal-content {
      color: black;
    }

    .bordered {
      border: 1px solid white;
      padding: 1rem;
    }
  </style>
</head>

<body>
  <div id="addContent">
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand" href="#">Page de gestion</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#url">Ajouter un Lien<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#fiche">Ajouter une fiche</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#note">Ajouter une note d'information</a>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link" href="private/view/p.php">Revenir à l'écran d'accueil</a>
          </li> -->
          </ul>

        </div>
      </nav>
    </div>
    <div style='top:10rem;'>



      <?php
      setlocale(LC_TIME, 'fra_fra');
      date_default_timezone_set('Europe/Paris');
      require_once 'private/functions.php';
      // require_once 'private/View/url.php';
      require_once 'private/View/fiche.php';
      require_once 'private/View/instructions.php';

      ?>
    </div>
  </div>

</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.tiny.cloud/1/jwifx6cyqjsshd8l1nxakb6hbbvlisgj6ngqgvw0aiyc15lr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  //      document.getElementById('categorie').addEventListener('change', s=>{
  //       switch(s.target.value){
  //         //   case 'lien':
  //           default:

  //             document.querySelectorAll("#lien").forEach(lien=>lien.classList.remove('hidden'));
  //               document.querySelectorAll("#note").forEach(note=>note.classList.add('hidden'));
  //               document.querySelectorAll("#fiche").forEach(fiche=>fiche.classList.add('hidden'));

  //             break;
  //             case 'fiche':

  //                 document.querySelectorAll("#lien").forEach(lien=>lien.classList.add('hidden'));
  //               document.querySelectorAll("#note").forEach(note=>note.classList.add('hidden'));
  //               document.querySelectorAll("#fiche").forEach(fiche=>fiche.classList.remove('hidden'));
  //               break;
  //               case 'note':

  // document.querySelectorAll("#lien").forEach(lien=>lien.classList.add('hidden'));
  // document.querySelectorAll("#note").forEach(note=>note.classList.remove('hidden'));
  // document.querySelectorAll("#fiche").forEach(fiche=>fiche.classList.add('hidden'));
  // break;
  // // default:
  // // document.querySelectorAll("#lien").forEach(lien=>lien.classList.add('hidden'));
  // // document.querySelectorAll("#note").forEach(note=>note.classList.add('hidden'));
  // // document.querySelectorAll("#fiche").forEach(fiche=>fiche.classList.add('hidden'));
  // // break;
  //       }
  //      }

  //      )

  tinymce.init({
    selector: '#mytextarea',
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
  });
</script>

</html>