<?php
$tabMatieres = readTable('matieres', 'nom', 'ASC');
$options = '';
$liens3 = '';

foreach ($tabMatieres as $matiere => $nom) {
    $options .= '<option value=' . $nom['id'] . '>' . $nom['nom'] . '</option>';
};
$strSQL = "SELECT * FROM liens_utiles LIMIT 3";
$tabLiens3 = sendSQL($strSQL, []);
foreach ($tabLiens3 as $rowLien => $value) {
    $dt = new DateTime($value['date']);
    $date = $dt->format("d/m/Y à h:m");
    $liens3 .=
        <<<lien
<div class="mb-2 d-flex justify-content-between align-items-center "  >
<div>
$date
</div>
       <div class="mr-2">
        <a  href=$value[url] target="_blank">
        $value[commentaire]
        </a>
        </div>
        <div>
        <a href="?id=$value[id]&idForm=urlDelete" class="btn btn-danger btn-sm" >Supprimer</a>
        </div>
    </div>

lien;
}

$tabLiens = readTable('liens_utiles');
$liens = "";
foreach ($tabLiens as $row => $value) {
    $matiere  = readLine_('matieres', $value['matiere']);

    $dt = new DateTime($value['date']);
    $date = $dt->format("d/m/Y ");
    $url = $value['url'];
    $commentaire = $value['commentaire'];

    $liens .=
        <<<allLinks
<div class="d-flex justify-content-between mb-1" data-toggle="tooltip" data-placement="top" title="$commentaire"  >
    <div class="mr-1">$date</div>
    <div class="mr-1"   >$url</div>

    <a href="?id=$value[id]&idForm=urlDelete" class="btn btn-danger btn-sm" >Supprimer</a>


</div>
allLinks;
}

$blockUrl =
    <<<url
        <div class="block">
        <div class="h5 text-center">Ajouter un lien</div>
    <div class="d-flex align-items-stretch justify-content-around flex-wrap ">
        <form action="" method="post" class='d-flex flex-column justify-content-around'>
            <div>
                <input type="text" class="form-control" id="url" name='url' placeholder="lien du site Internet">
            </div>
            <div >
                <input type="text" class="form-control" id="commentaire" name='commentaire' placeholder="Titre du lien">
            </div>
                
            <div class="input-group">
                <select class="custom-select" id="inputGroupSelect04">
                    <option selected>Choisir une matière</option>
                    $options
                </select>
                <button type="submit" class="btn btn-success">Ajouter le lien</button>
                <input type="hidden" name="idForm" value="urlCreate">
            </div>
        </form>
        <div class='url'>
            <div >
                <h6  class="text-center">Les 3 derniers liens ajoutés</h6> 
                $liens3
                <div class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUrl" >Voirs tous les liens</button><div>
            </div>
        </div>
    </div>
    </div>
    </div>  

    <div class="modal fade " id="modalUrl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <div class="modal-content" style='font-size:.8rem;padding:.8rem'>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Liste des liens</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        $liens
        </div>
        </div>
    </div>
    </div>
    </div>

url;


return
    $blockUrl .
    <<<fiche
    <div class="block">
    <div class="h5 text-center">Ajouter une fiche</div>
<div class="d-flex align-items-stretch justify-content-around flex-wrap ">
                <form method="post" enctype="multipart/form-data">
                    <input type="text" class="form-control mb-3" id="titre" name='titre' placeholder="Titre de la fiche">
                    <div class="form-group ">
                        <div class="d-flex justify-content-around ">
                            <div  class="custom-file">

                                <input id="fichier" class="custom-file-input" type="file" name="fiche" >
                                <label class="custom-file-label" for="fichier">Choisi un fichier</label>
    
    
    
                            </div>
                            <div class="input-group">
                            <select class="custom-select" id="inputGroupSelect04">
                                <option selected>Choisir une matière</option>
                                $options
                            </select>
                            <button type="submit" class="btn btn-success ">Ajouter la fiche</button>
                            <input type="hidden" name="idForm" value="ficheAdd">    
                        </div>

                  
                    </div>
                        </div>
                     </div>
             </form>
         </div></div>   

fiche;
