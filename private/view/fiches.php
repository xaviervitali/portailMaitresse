<div class="block">
    <div class="h5 text-center">Ajouter une fiche</div>
    <div class="d-flex align-items-stretch justify-content-around flex-wrap ">
        <form method="post" enctype="multipart/form-data" class='d-flex flex-column justify-content-around mr-2'>
            <input type="text" class="form-control mb-3" id="titre" name='titre' placeholder="Titre de la fiche">
            <div class="form-group ">
                <div class="d-flex justify-content-around">
                    <div class="custom-file">

                        <input id="fichier" class="custom-file-input" type="file" name="fiche" v-model="ficheLien">
                        <label class="custom-file-label" for="fichier"> {{ficheLien.slice(12)}}</label>



                    </div>
                    <div class="input-group">
                        <select class="custom-select" id="inputGroupSelect04" name='matiere'>
                            <option selected>Choisir une matière</option>
                            <?php echo
                                $matieres ?>
                        </select>
                        <button type="submit" class="btn btn-success ">Ajouter la fiche</button>
                        <input type="hidden" name="idForm" value="ficheAdd">
                    </div>


                </div>
            </div>
        </form>
        <div class='url d-flex flex-column justify-content-between'>
            <div>
                <div class="text-center h6">Les 3 dernieres fiches ajoutées</div>
                <div>
                    <div v-for='(fiche, id) in fiches.slice(0,3) ' :key=' id'>
                        <div class="mb-2 d-flex justify-content-between align-items-center " data-toggle="tooltip" data-placement="top" :title='fiche.url'>
                            <div class="mr-2">
                                {{getDate(fiche.date)}}
                            </div>
                            <div class="mr-2">
                                <a :href='fiche.chemin' target="_blank">
                                    {{fiche.titre.length>50?fiche.titre.slice(0,50)+"(...)":fiche.titre}}
                                </a>
                            </div>
                            <div>
                                <a :href="'?id='+fiche.id+'&idForm=ficheDelete'" class="btn btn-danger btn-sm">Supprimer</a>
                            </div>
                        </div>
                        <div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFiche">Voir tous les fiches</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="modalFiche" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <div class="modal-content" style=' font-size:.8rem;padding:.8rem'>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Liste des Fiches</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>

                            <div v-for="(fiche,id) in fiches" :key='id'>
                                <div class="d-flex justify-content-between mb-1 text-center text-break">
                                    <div class="mr-1">{{getDate(fiche.date)}}</div>
                                    <div class="mr-1">
                                        <a :href="fiche.chemin" target='_blank'>
                                            {{fiche.titre}}</a></div>

                                    <a :href="'?id='+fiche.id+'&idForm=ficheDelete'" class="btn btn-danger btn-sm">Supprimer</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>