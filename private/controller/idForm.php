<?php
if (isset($_REQUEST['idForm'])) {
    global $level;
    if ($_REQUEST['idForm'] === 'urlCreate') {

        $matiere = isset($_REQUEST['matiere']) ? filtrerInput('matiere') : 9;
        $url = filtrerInput('url');
        $commentaire = filtrerInput('commentaire') != '' ? filtrerInput('commentaire') : $url;

        insertLine("liens_utiles", [
            "matiere" => $matiere,
            "url" => $url,
            "commentaire" => $commentaire,
            "date" => date("Y-m-d H:i:s"),
            'addedBy' => $level
        ]);
    };
    if ($_REQUEST['idForm'] === 'urlDelete') {
        if (isset($_REQUEST['id'])) {
            $id = filtrerInput('id');
            deleteLine('liens_utiles', $id);
        }
    }
    if (
        $_REQUEST['idForm'] === 'ficheAdd'
    ) {
        $matiere = filtrerInput('matiere');
        $fiche = checkUpload(["name" => 'fiche', "destination" => "assets/files"]);
        $titre = filtrerInput('titre');

        insertLine("fiches", [
            "matiere" => $matiere,
            "titre" => $titre,
            "chemin" => $fiche,
            "date" => date("Y-m-d H:i:s"),
            'addedBy' => $level

        ]);
    }
    if ($_REQUEST['idForm'] === 'ficheDelete') {
        $id = filtrerInput('id');
        deleteLine('fiches', $id);
    }

    if ($_REQUEST['idForm'] === 'noteCreate') {
        $note = $_REQUEST['note'];

        insertLine("notes", [
            "note" => $note,
            "date" => date("Y-m-d H:i:s"),
            'addedBy' => $level
        ]);
    }
};
if (isset($_REQUEST['idForm'])) {
    if ($_REQUEST['idForm'] === 'noteDelete') {
        $id = filtrerInput('id');
        deleteLine('notes', $id);
    };
};
