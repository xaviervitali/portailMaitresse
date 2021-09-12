<?php

function filtrerInput($tabInput)
{
    // $name   = $tabInput["name"] ;

    if ($_REQUEST[$tabInput]) {
        return trim(strip_tags($_REQUEST[$tabInput]));
    }
}
function insertLine($nomTable, $tabAssoColonneValeur)
{

    $listeCle = "";
    $listeToken = "";
    $estPremier = true;
    foreach ($tabAssoColonneValeur as $cle => $valeur) {
        $listeCle = $listeCle . ($estPremier ? "" : ", ") . $cle;
        $listeToken = $listeToken . ($estPremier ? "" : ", ") . ":$cle";

        $estPremier = false;
    }

    $requeteSQL =
        <<<CODESQL

INSERT INTO $nomTable
( $listeCle )
VALUES
( $listeToken )

CODESQL;

    $objPDOStatement = sendSQL($requeteSQL, $tabAssoColonneValeur);

    return $objPDOStatement;
}

function sendSQL($requeteSQL, $tabAssoColonneValeur)
{

    $portSQL = 3306;
    $charsetSQL = "utf8";

    //Mamp
    //   $loginSQL     = "root";
    //     $passwordSQL  = "root";
    //       $databaseSQL  = "devoirs";
    //       $hostSQL      = "127.0.0.1";
    //       $portSQL      = 8889;

    //Synology
    $loginSQL = "root";
    $passwordSQL = "Soleil13";
    $databaseSQL = "devoirs";
    $hostSQL = "127.0.0.1";

    //Wamp
    /*$loginSQL     = "root";
    $passwordSQL  = "";
    $databaseSQL  = "perso";
    $hostSQL      = "127.0.0.1";
     */

    //OVH
    // $hostSQL      = "xaviervimjpers0.mysql.db";
    // $loginSQL     = "xaviervimjpers0";
    // $passwordSQL  = "Soleil13";
    // $databaseSQL  = "xaviervimjpers0";

    $dsnSQL = "mysql:host=$hostSQL;port=$portSQL;charset=$charsetSQL;dbname=$databaseSQL";

    $objPDO = new PDO($dsnSQL, $loginSQL, $passwordSQL, []);

    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $objPDOStatement = $objPDO->prepare($requeteSQL);

    $objPDOStatement->execute($tabAssoColonneValeur);

    $objPDOStatement->setFetchMode(PDO::FETCH_ASSOC);

    return $objPDOStatement;
}

// FONCTION QUI FILTRE LES INFOS DES FORMULAIRES
// <input name="toto" type="email">
// secureInput([ "name" => "toto", "type" => "email" ])
function secureInput($tabAssoAttribut)
{
    // VARIABLE GLOBALE
    global $tabErreur;

    // ON EXTRAIT LES VALEURS DU TABLEAU ASSOCIATIF
    $name = $tabAssoAttribut["name"];
    $type = $tabAssoAttribut["type"];
    $table = $tabAssoAttribut["table"];
    $column = $tabAssoAttribut["column"];

    // ON RECUPERE LA VALEUR ENVOYEE DU FORMULAIRE,
    // SI L'INFO N'EST PAS PRESENTE, ON MET UN TEXTE VIDE
    $valeur = trim(strip_tags($_REQUEST["$name"]));

    // VALEUR EST OBLIGATOIRE
    if (mb_strlen($valeur) == 0) {
        // ERREUR: LA VALEUR EST VIDE
        $tabErreur[] = "$name EST VIDE";
    } elseif ($type == "email") {
        // VERIFIER QUE LE FORMAT RESSEMBLE A UN EMAIL
        // http://php.net/manual/fr/function.filter-var.php
        $valeurCheck = filter_var($valeur, FILTER_VALIDATE_EMAIL);

        if ($valeurCheck == false) {
            // ERREUR SUR LE FORMAT DE L'EMAIL
            $tabErreur[] = "$name EST UN EMAIL INVALIDE";
        }
    }

    if (($table != "") && ($column != "")) {
        // VERIFIER L'UNICITE DE LA VALEUR DANS LA TABLE
        $tabLigne = readLineColumn($table, [$column => $valeur]);
        // SI LA LIGNE N'EST PAS VIDE
        // http://php.net/manual/fr/function.empty.php
        if (!empty($tabLigne)) {
            $tabErreur[] = "$column: $valeur EXISTE DEJA";
        }
    }

    return $valeur;
}

function readTable($nomTable, $order = "id", $way = "DESC")
{

    // ETAPE1: CONSTRUIRE LA REQUETE SQL
    $requeteSQL =
        <<<CODESQL

SELECT * FROM $nomTable
ORDER BY $order $way;

CODESQL;

    // JE PEUX MAINTENANT ENVOYER LA REQUETE SQL PREPAREE
    // ET JE COMPLETE AVEC LE TABLEAU DES VALEURS (VIDE ICI)
    $objPDOStatement = sendSQL($requeteSQL, []);

    return $objPDOStatement;
}

function readLine_($nomTable, $id, $nomID = "id")
{
    // $id = intval($id);

    // ETAPE1: CONSTRUIRE LA REQUETE SQL
    $requeteSQL =
        <<<CODESQL

SELECT * FROM $nomTable
WHERE $nomID = "$id"

CODESQL;

    // echo($requeteSQL);
    // JE PEUX MAINTENANT ENVOYER LA REQUETE SQL PREPAREE
    // ET JE COMPLETE AVEC LE TABLEAU DES VALEURS (VIDE ICI)
    $objPDOStatement = sendSQL($requeteSQL, ["$nomID" => "$id"]);

    return $objPDOStatement;
}

function deleteLine($nomTable, $id)
{
    // $id = intval($id);

    $requeteSQL =
        <<<CODESQL

DELETE FROM $nomTable
WHERE id = :id

CODESQL;

    // JE PEUX MAINTENANT ENVOYER LA REQUETE SQL PREPAREE
    // ET JE COMPLETE AVEC LE TABLEAU DES VALEURS
    $objPDOStatement = sendSQL($requeteSQL, ["id" => $id]);

    return $objPDOStatement;
}

$tabErreur = [];

// https://stackoverflow.com/questions/1017599/how-do-i-remove-accents-from-characters-in-a-php-string
function str_without_accents($str, $charset = 'utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str; // or add this : mb_strtoupper($str); for uppercase :)
}

// LA FONCTION VA VERIFIER QUE LE FICHIER UPLOADE RESPECTE NOS CONDITIONS DE SECURITE
// ET SI OK LA FONCTION VA STOCKER LE FICHIER DANS UN DOSSIER
// checkUpload([ "name" => "image", "destination" => "assets/upload" ])
// LA FONCTION RENVOIE LE CHEMIN FINAL DU FICHIER
function checkUpload($tabAsso)
{
    global $tabErreur;

    $nameInput = $tabAsso["name"] ?? "";
    $destination = $tabAsso["destination"] ?? "";

    // EST-CE QUE UN FICHIER A ETE UPLOADE POUR $name?
    if (!empty($_FILES[$nameInput])) {
        // http://php.net/manual/fr/function.extract.php
        extract($_FILES[$nameInput]);
        // VA CREER LES VARIABLES $name, $type, $tmp_name, $error, $size
        // ERROR=0 ?
        if ($error == 0) {
            // OK LE TRANSFERT S'EST BIEN DEROULE
            $tabWhiteList = [
                "jpg", "jpeg", "png", "gif", "svg",
                "txt",
                "pdf"
            ];
            // http://php.net/manual/fr/function.pathinfo.php
            $extensionFichier = pathinfo($name, PATHINFO_EXTENSION);
            // http://php.net/manual/fr/function.strtolower.php
            $extensionFichier = strtolower($extensionFichier);
            // http://php.net/manual/fr/function.in-array.php
            if (in_array($extensionFichier, $tabWhiteList)) {
                // OK L'EXTENSION EST AUTORISEE
                // VERIFIER QUE LE POIDS DU FICHIER NE DEPASSE LA LIMITE MAX
                if ($size < 10 * 1024 * 1024) // 10 Mo (1Ko = 1024 octets)
                {
                    // LE NOM DU FICHIER SANS EXTENSION
                    // http://php.net/manual/fr/function.pathinfo.php
                    $filename = pathinfo($name, PATHINFO_FILENAME);
                    // ENLEVER LES ACCENTS
                    $filename = str_without_accents($filename);
                    // strtolower POUR PASSER EN MINUSCULES
                    $filename = strtolower($filename);

                    // http://php.net/manual/fr/function.preg-replace.php
                    $filename = preg_replace("/[^a-z0-9]/i", "-", $filename);

                    $filename = md5($filename . date('U'));
                    move_uploaded_file($tmp_name, "$destination/$filename.$extensionFichier");

                    return "$destination/$filename.$extensionFichier";
                } else {
                    // ERREUR: TAILLE MAXIMUM DEPASSEE
                    $tabErreur[] = "TAILLE MAXIMUM DEPASSEE (10Mo)";
                }
            } else {
                // ERREUR: EXTENSION NON AUTORISEE
                $tabErreur[] = "EXTENSION NON AUTORISEE";
            }
        } else {
            // ERREUR: TRANSFERT INCORRECT
            $tabErreur[] = "TRANSFERT INCORRECT";
        }
    } else {
        // AUCUN FICHIER UPLOADE
        // MAIS UPLOAD PEUT ETRE OPTIONNEL...
    }

    // ERREUR
    return "";
}

function createThumbnail($cheminSource, $cheminThumbnail, $side = 800)
{
    // http://php.net/manual/fr/function.exif-imagetype.php
    $imgType = exif_imagetype($cheminSource);
    switch ($imgType) {
        case IMAGETYPE_JPEG:
            $imgSrc = imagecreatefromjpeg($cheminSource);
            break;
        case IMAGETYPE_PNG:
            $imgSrc = imagecreatefrompng($cheminSource);
            // IL FAUDRA COPIER LA TRANSPARENCE EN PLUS
            break;
        case IMAGETYPE_GIF:
            $imgSrc = imagecreatefromgif($cheminSource);
            // IL FAUDRA COPIER LA TRANSPARENCE EN PLUS
            break;
    }
    // http://php.net/manual/fr/function.imagecreatefromjpeg.php

    // http://php.net/manual/fr/function.imagesx.php
    $largeurSrc = imagesx($imgSrc);
    // http://php.net/manual/fr/function.imagesy.php
    $hauteurSrc = imagesy($imgSrc);

    // SI L'IMAGE EST PLUS PETITE
    // ALORS ON NE CREE PAS DE MINIATURE
    // ...

    // PAYSAGE OU PORTRAIT
    if ($largeurSrc > $hauteurSrc) {
        // PAYSAGE
        // Lmini = 800;
        // Hmini = HAUTEUR * Lmini / LARGEUR
        $largeurThumbnail = $side;
        $hauteurThumbnail = $hauteurSrc * $largeurThumbnail / $largeurSrc;
    } else {
        // PORTRAIT
        $hauteurThumbnail = $side;
        $largeurThumbnail = $largeurSrc * $hauteurThumbnail / $hauteurSrc;
    }
    // CREER L'IMAGE THUMBNAIL VIDE
    // http://php.net/manual/fr/function.imagecreatetruecolor.php
    $imgThumbnail = imagecreatetruecolor($largeurThumbnail, $hauteurThumbnail);
    // POUR PNG TRANSPARENT OK
    imagealphablending($imgThumbnail, false);
    imagesavealpha($imgThumbnail, true);
    // $transparent = imagecolorallocatealpha($imgThumbnail, 0, 0, 0, 127);
    // imagefill($imgThumbnail, 0, 0, $transparent);

    // COPIE AVEC RE-ECHANTILLONAGE (meilleure qualité...)
    // http://php.net/manual/fr/function.imagecopyresampled.php
    imagecopyresampled(
        $imgThumbnail,
        $imgSrc,
        0,
        0,
        0,
        0,
        $largeurThumbnail,
        $hauteurThumbnail,
        $largeurSrc,
        $hauteurSrc
    );

    // SAUVEGARDER DANS UN FICHIER
    switch ($imgType) {
        case IMAGETYPE_JPEG:
            imagejpeg($imgThumbnail, $cheminThumbnail);
            break;

        case IMAGETYPE_PNG:
            imagepng($imgThumbnail, $cheminThumbnail);
            break;

        case IMAGETYPE_GIF:
            imagegif($imgThumbnail, $cheminThumbnail);
            break;
    }

    // http://php.net/manual/fr/function.imagejpeg.php

}
