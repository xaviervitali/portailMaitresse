    <form action="" method="post">
        <div class=" p-3 mt-5" style="border:1px solid white">
            <div>
                <div class="form-group d-flex flex-column justify-content-between ">
                    <input type="text" class="form-control" id="url" name='url' placeholder="lien du site Internet">
                </div>
                <div class="form-group d-flex flex-column justify-content-between ">
                    <input type="text" class="form-control" id="commentaire" name='commentaire' placeholder="Descriptif du lien">
                </div>
            </div>
            <div class="form-group form-check">
                <select id="custom-select" id="matiere" name="matiere">
                    <option selected>Choisir une matière</option>

                    <?php

                    $matieres = readTable('matieres', 'nom', 'ASC');
                    foreach ($matieres as $matiere => $nom) {

                        echo ('<option value=' . $nom['id'] . '>' . $nom['nom'] . '</option>');
                    };

                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter le lien</button>
            <input type="hidden" name="idForm" value="urlCreate">
    </form>




    <div class="mt-5 p-3 ">
        <p class="text-center h5">
            Liste des liens déjà présents
        </p>
        <div class="table-responsive-lg">
            <table class="  table-dark table-hover table  table-striped mx-auto  ">
                <thead>
                    <tr>
                        <th scope="col">Ajouté le</th>
                        <th scope="col">Aperçu</th>
                        <th scope="col">URL</th>
                        <th scope="col">Descriptif</th>
                        <th scope="col">Matière</th>
                    </tr>
                    <?php


                    $listeLiens = readTable('liens_utiles');
                    foreach ($listeLiens as $key => $value) {
                        $temp = readLine_('matieres', $value['matiere']);
                        foreach ($temp as $k => $v) {
                            $mat = $v['nom'];
                        };
                        echo
                            <<<Ligne

                                            <tr>

                                            <td>$value[date]</td>

                                            <td> <img src="https://www.easy-thumb.net/thumb?url=$value[url]" style="border-radius:10%"></img></td>
                                            <td> <a href="$value[url]" target='_blank'>$value[url]</a></td>
                                            <td>$value[commentaire]</td>
                                            <td> $mat <td>
                                            <td>
                                            <a  href="?id=$value[id]&idForm=urlDelete" class="btn btn-danger" >Supprimer</a>
                                            </td>
                                            </tr>
        Ligne;
                    };
                    ?>
                </thead>
                <tbody>



                </tbody>
            </table>
        </div>