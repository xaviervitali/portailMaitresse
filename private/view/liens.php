<div class="block">
    <div class="h5 text-center">Ajouter un lien</div>
    <div class="d-flex align-items-stretch justify-content-around flex-wrap ">
        <form action="" method="post" class='d-flex flex-column justify-content-around mr-2'>
            <div>
                <input type="text" class="form-control" id="url" name='url' placeholder="lien du site Internet" v-model='url'>
            </div>
            <div>
                <input type="text" class="form-control" id="commentaire" name='commentaire' placeholder="Titre du lien" :value='url'>
            </div>

            <div class="input-group">
                <select class="custom-select" id="inputGroupSelect04" name='matiere'>
                    <option selected>Choisir une matière</option>
                    <?php

                    echo
                        $matieres
                    ?>
                </select>
                <button type="submit" class="btn btn-success" @click="load()">Ajouter le lien</button>
                <input type="hidden" name="idForm" value="urlCreate">
            </div>
        </form>
        <div class='url d-flex flex-column justify-content-between'>
            <div>
                <div class="text-center h6">Les 3 derniers liens ajoutés</div>
                <div>
                    <div v-for='( lien, id) in liens.slice(0,3) ' :key=' id'>
                        <div class="mb-2 d-flex justify-content-between align-items-center flex-wrap" data-toggle="tooltip" data-placement="top" :title='lien.url'>
                            <div class="mr-2">
                                {{getDate(lien.date)}}
                            </div>
                            <div class="mr-2">
                                <a :href='lien.url' target="_blank">
                                    {{lien.commentaire.length>50?lien.commentaire.slice(0,50)+"(...)":lien.commentaire}}
                                </a>
                            </div>
                            <div>
                                <a :href="'?id='+lien.id+'&idForm=urlDelete'" class="btn btn-danger btn-sm">Supprimer</a>
                            </div>
                        </div>
                        <div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUrl">Voir tous les liens</button>
                    </div>
                </div>
            </div>

            <div class="modal fade " id="modalUrl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                    <div class="modal-content" style=' font-size:.8rem;padding:.8rem'>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Liste des liens</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>

                                <div v-for="(lien,id) in liens" :key='id'>
                                    <div class="d-flex justify-content-between mb-1 text-center text-break" data-toggle="tooltip" data-placement="top" :title="id.commentaire">
                                        <div class="mr-1">{{getDate(lien.date)}}</div>
                                        <div class="mr-1">
                                            <a :href="lien.url" target='_blank'>
                                                {{lien.url}}</a></div>

                                        <a :href="'?id='+lien.id+'&idForm=urlDelete'" class="btn btn-danger btn-sm">Supprimer</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>