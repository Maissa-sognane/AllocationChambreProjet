<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="p-lg-3" style="font-family: 'Roboto Slab'">ENREGISTRER ETUDIANT</h1>
        </div>
    </div>
    <div class="errors"></div>
    <form method="post" id="formCreateEtudiant" action="<?=BASE_URL?>/admin/Etudiant">
        <input type="hidden" value="<?php echo date("Y"); ?>" name="dateJour">
        <div class="form-group row">
            <label for="prenom" class="col-sm-2 col-form-label">Prenom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control p-1" id="prenom" name="prenom" placeholder="Prenom">
                <span class="text-danger"><?= @$error ;?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control p-1" id="nom" name="nom" placeholder="Nom">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control p-1" id="email" name="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <label for="tel" class="col-sm-2 col-form-label">Telephone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control p-1" name="tel"  id="tel" placeholder="telephone">
            </div>
        </div>
        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control p-1" id="date" name="date" placeholder="Date Naissance">
            </div>
        </div>
        <div class="form-group row">
            <label for="bourse" class="col-sm-2 col-form-label">Bourse</label>
            <div class="col-sm-10">
                <select class="form-control" id="bourse" name="bourse">
                    <option value="null">Choisir</option>
                    <?php
                    for ($i=0; $i<count($type); $i++){
                        ?> <option value="<?= $type[$i]->getLibele(); ?>"><?= $type[$i]->getLibele().' ('.$type[$i]->getMontant().'f)';?></option><?php
                    }
                    ?>
                    <option value="non">Pas Bourse</option>
                </select>
            </div>

        </div>
        <div class="form-group row" id="type-etudiant">

        </div>
        <div class="form-group row" id="chambre">
            <?php
            $tab = [];
            if(isset($chambre)){
                for ($i = 0; $i < count($chambre); $i++) {
                    $tab[] = array(
                        'id' => $chambre[$i]->getId(),
                        'numeroChambre' => $chambre[$i]->getNumeroChambre(),
                        'numeroBatiment' => $chambre[$i]->getNumeroBatiment(),
                        'id_type_chambre' => $chambre[$i]->getIdTypeChambre(),
                    );
                }
                }
            ?>
        </div>
        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn" name="btn-create-etudiant" style="background-color: #FFC312">Sauvegarder</button>
            </div>
        </div>
    </form>



    <script>
      var tab = <?php echo json_encode($tab); ?>;
    </script>

</div>


