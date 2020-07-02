<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="p-lg-3" style="font-family: 'Roboto Slab'">ENREGISTRER CHAMBRE</h1>
        </div>
    </div>
    <div class="errors"></div>
    <form method="post" class="createChambre" action="<?=BASE_URL?>/admin/Chambre">
        <div class="form-group row">
            <label for="numero_batiment" class="col-sm-2 col-form-label">Numéro Batiment</label>
            <div class="col-sm-10">
                <input type="text" class="form-control p-1" name="numero_batiment" id="numero_batiment" placeholder="Numéro Batiment">
            </div>
        </div>
        <div class="form-group row">
            <label for="type" class="col-sm-2 col-form-label">Type Chambre</label>
            <div class="col-sm-10">
                <select class="form-control" id="typeChambre" name="type_chambre">
                    <option value="null">Choisir</option>
                    <?php
                    for ($i=0; $i<count($type); $i++){
                        ?> <option value="<?= $type[$i]->getCategorie(); ?>"><?= $type[$i]->getCategorie();?></option><?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn" name="btn-create-chambre" style="background-color: #FFC312">Sauvegarder</button>
            </div>
        </div>
    </form>
</div>

