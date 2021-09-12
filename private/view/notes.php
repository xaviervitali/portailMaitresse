<div class="block">


    <div class="h5 text-center ">Ajouter une note d'information</div>
    <div class="d-flex align-items-stretch justify-content-around flex-wrap ">

        <form method="post" class='d-flex flex-column justify-content-around mr-2 col-6'>

            <div>
                <textarea name="note" id="mytextarea"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer</button>

            <input type="hidden" name="idForm" value="noteCreate">

        </form>

        <div class='url d-flex flex-column justify-content-between'>
            <div>
                <div class="text-center h6">Les 3 dernieres notes ajoutées</div>
                <div>
                    <div v-for='(note   , id) in notes.slice(0,3) ' :key=' id'>
                        <div class="mb-2 d-flex justify-content-between align-items-center ">
                            <div class="mr-2">
                                {{getDate(note.date)}}
                            </div>
                            <div class="mr-2" v-html="sliceHtml(note.note)">

                            </div>
                            <div>
                                <a :href="'?id='+note.id+'&idForm=noteDelete'" class="btn btn-danger btn-sm">Supprimer</a>
                            </div>
                        </div>
                        <div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNote  ">Voir tous les notes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="modalNote" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <div class="modal-content" style=' font-size:.8rem;padding:.8rem'>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Liste des notes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>

                            <div v-for="(note ,id) in notes" :key='id'>
                                <div class="d-flex justify-content-between mb-1 flex-wrap    ">
                                    <div class="mr-1">{{getDate(note.date)}}</div>
                                    <div class="mr-1 " v-html="note.note">
                                    </div>

                                    <a :href="'?id='+note.id+'&idForm=noteDelete'" class="btn btn-danger btn-sm">Supprimer</a>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>