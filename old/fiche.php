<div class="bordered mb-5" id='fiche'>
<div class="h5 text-center">Ajouter une fiche</div>
<div   class=" mt-5">
    <div style="border:1px solid white" class=" p-3">
        <div class="form-group " >
            <form method="post" enctype="multipart/form-data">
                <input type="text" class="form-control mb-3" id="titre" name='titre' placeholder="Titre de la fiche">
                <div class="form-group ">
                    <div class="d-flex justify-content-around">
                        <div>
                            <!-- <label class="labelUpload" for="fiche">Choisir un fichier</label> -->

                            <input id="fichier"  type="file" name="fiche" >



                        </div>
                        <select class="mb-3" id="custom-select" id="matiere" name="matiere" require>
                            <option selected>Choisir une matière</option>
                    </div>
                    <?php

$matieres = readTable('matieres', 'nom', 'ASC');
foreach ($matieres as $matiere => $nom) {

    echo ('<option value=' . $nom['id'] . '>' . $nom['nom'] . '</option>');
}
;

?>

                        </select>

               </div>
            </div>
            <button type="submit" class="btn btn-primary ">Ajouter la fiche</button>
            <input type="hidden" name="idForm" value="ficheAdd">
        </div>
    </form>
</div>


<!-- ############################################################################################################################################# -->




    <div class="mt-5 p-3 ">
        <p class="text-center h5">
        Liste des fiches déjà présentes

        </p>
        <div class="table-responsive-lg">
            <table class="table-dark table-hover table  table-striped mx-auto  ">
            <thead>
    <tr>
      <th scope="col">Ajouté le</th>
      <th scope="col">Titre</th>
      <th scope="col">Matière</th>
    </tr>



    <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
setlocale(LC_TIME, 'fra_fra');

if (
    isset($_REQUEST['matiere']) &&
    isset($_REQUEST['titre']) &&
    isset($_REQUEST['idForm'])

) {
    if
    ($_REQUEST['matiere'] != '' &&
        filtrerInput('titre') != '' &&
        $_REQUEST['idForm'] === 'ficheAdd') {
        $matiere = filtrerInput('matiere');
        $titre = filtrerInput('titre');
        $fiche = checkUpload(["name" => 'fiche', "destination" => "assets/files"]);

        insertLine("fiches", [
            "matiere" => $matiere,
            "titre" => $titre,
            "chemin" => $fiche,
            "date" => date("Y-m-d H:i:s"),
            'niveau' => 'CE1',
        ]);

    }
}
;
if (isset($_REQUEST['idForm'])) {
    if ($_REQUEST['idForm'] === 'fileDelete') {
        $id = filtrerInput('id');
        deleteLine('fiches', $id);
    }}
;
$listeFiches = readTable('fiches');
foreach ($listeFiches as $key => $value) {
    $temp = readLine_('matieres', $value['matiere']);
    foreach ($temp as $k => $v) {
        $mat = $v['nom'];
    }
    ;
    echo
        <<<Ligne

                <tr>

                <td>$value[date]</td>

                <td> <a href="$value[chemin]" target='_blank'>$value[titre]</a></td>
                <td>$mat<td>
                <td>
                <a  href="?id=$value[id]&idForm=fileDelete" class="btn btn-danger" >Supprimer</a>
                </td>
                </tr>
Ligne;
}
// ;
?>
  </thead>



                </tbody>
            </table>
        </div>
        </div>
        </div>
        </div>