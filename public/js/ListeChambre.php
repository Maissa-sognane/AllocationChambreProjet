<div class="liste-joueur">
    <div class="d-inline-flex mt-lg-3 mt-1  titre-creation-compte">
        <h1>Liste des Chambres</h1>
    </div>
    <div class="">
        <div class="">
            <form method="post" action="<?=BASE_URL?>/admin/ListeDesChambres" id="formListeChambre">
            <div class="row">
                <div class="col-12 col">
                    <div id="" class="col">
                        <table class="table table-striped" id="id_table" >
                            <thead>
                            <tr>
                                <th scope="col">Numero Chambre</th>
                                <th scope="col">Numero Batiment</th>
                                <th scope="col">Type Chambre</th>
                                <th scope="col">Modification</th>
                            </tr>
                            </thead>
                            <tbody id="chambreElement" class="LesChambres">
                            <tr>
                                <td>id</td>
                                <td>18H50</td>
                                <td>771544313</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div id="div_pagination">
                    <input type="hidden" id="txt_rowid_joueur" value="0">
                    <input type="hidden" id="txt_allcount_joueur" value="0" name="<?=BASE_URL?>/admin/deleteChambre">
                    <div class="btn btn-primary  mr-2" id="but_prev_joueur" >Precedent</div>
                    <div class="btn btn-primary" id="but_next_joueur">Suivant</div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body" >
                <form  method="post" action="<?=BASE_URL?>/admin/UpdateChambre" id="modal-body-chambre" class="needs-validation">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="close" name="<?=BASE_URL?>/admin/updateDesChambre" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary updateEtudiant" name="updateChambre" id="updateChambre">Enrégistrer</button>
            </div>
            </form>
        </div>
    </div>
</div>