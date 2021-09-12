<div class="bordered mb-5" id='note'>
<div class="h5 text-center ">Ajouter une note d'information</div>

<form method="post">

        <div class=" p-3 mt-5 " style="border:1px solid white">
        <div>
   <textarea name="note" id="mytextarea"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>

        <input type="hidden" name="idForm" value="noteCreate">

</form>
</div>
    <div class="mt-5 p-3 " >
        <p class="text-center h5">
            Liste des notes d'information déjà présentes
        </p>
        <div class="table-responsive-lg">
            <table class="  table-dark table-hover table  table-striped mx-auto  ">
            <thead>
    <tr>
      <th scope="col">Ajouté le</th>
      <th scope="col">Aperçu</th>
    </tr>
    </thead>
    <tbody>
    <?php

setlocale(LC_TIME, 'fra_fra');
if (isset($_REQUEST['note']) && isset($_REQUEST['idForm'])) {
    if (filtrerInput('note') != '' && $_REQUEST['idForm'] === 'noteCreate') {
        $note = $_REQUEST['note'];

        insertLine("notes", [
            "note" => $note,
            "date" => date("Y-m-d H:i:s"),
        ]);

    }
}
;
if (isset($_REQUEST['idForm'])) {
    if ($_REQUEST['idForm'] === 'noteDelete') {
        $id = filtrerInput('id');
        deleteLine('notes', $id);
    }}
;
$listeLiens = readTable('notes');
foreach ($listeLiens as $key => $value) {
    $note = strip_tags($value['note']);
    $extrait = strlen($note) > 200 ? (substr($note, 0, 200) . '...') : $note;
    echo
        <<<Ligne

                                    <tr >

                                    <td>$value[date]</td>

                                    <td >    $extrait</td>
                                    <td class='d-flex '>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal$value[id]">Visualiser</button>
                              <a  href="?id=$value[id]&idForm=noteDelete" class="btn btn-danger" >Supprimer</a>

                                    </td>
                                    </tr>

Ligne;

    echo
        <<<modales
     <div class="modal fade" id="modal$value[id]" tabindex="-1" role="dialog" aria-labelledby="modal$value[id]Title" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLongTitle">$value[date]</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           $value[note]
         </div>
         <div class="modal-footer">
         <a  href="?id=$value[id]&idForm=noteDelete" class="btn btn-danger" >Supprimer</a>

           <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
         </div>
       </div>
     </div>
   </div>

modales;
}
?>



                </tbody>

            </table>

        </div>
        </div>
        </div>
        </div>
