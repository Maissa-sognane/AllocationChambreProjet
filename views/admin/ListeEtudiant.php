<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Liste Etudiants</h1>
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="col-lg-3 col-sm-12">
            <form method="post" action="<?=BASE_URL?>/admin/seachUserByPrenom" id="formSearch" class="form-inline">
            </form>
        </div>
        <div class="col-lg-3 col-sm-12">
            <div class="input-group">
                <input type="text" class="form-control" id="search" aria-label="Dollar amount (with dot and two decimal places)" placeholder="Par Matricule">
                <div class="input-group-append">
                    <button class="btn btn" type="submit" style="background-color: #FFC312">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12">
            <form method="post" action="<?=BASE_URL?>/admin/searchUserByBourse" id="formSearchBourse" class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchBourse" aria-label="Dollar amount (with dot and two decimal places)" placeholder="Par Boursier">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-sm-12">
            <form method="post" action="<?=BASE_URL?>/admin/searchUserByChambre" id="formSearchChambre" class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchChambre" aria-label="Dollar amount (with dot and two decimal places)" placeholder="Par Chambre">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div id="scrollZone">
        <div class="table-responsive-xl">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Matricule</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Bourse</th>
                    <th scope="col">Tel</th>
                    <th scope="col">Chambre</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="tbody">
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body" >
                <div class="error"></div>
                <form  method="post" action="<?=BASE_URL?>/admin/updateUser" id="modal-body" class="needs-validation">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary updateEtudiant" name="updateEtudiant" id="updateEtudiant">Enrégistrer</button>
            </div>
            </form>
        </div>
    </div>
</div>
