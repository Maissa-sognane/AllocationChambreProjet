<?php
session_start();
class AdminController extends Controller{

    private $chambre;

    public  function __construct(){
        $this->folder="admin";
        $this->layout="admin";
        $this->validator=new Validator();
    }

    public function Etudiant(){
            if(empty($_POST['prenom']) || empty($_POST['nom']) ||
                empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['date'])
                || $_POST['bourse'] == 'null'){
                echo '<div class="alert alert-danger">Champs Obligatoire</div>';
            }
            else{
                    $prenom = $_POST['prenom'];
                    $nom = $_POST['nom'];
                    $email = $_POST['email'];
                    $tel = $_POST['tel'];
                    $date = $_POST['date'];
                    if(preg_match("#[^a-zA-Z\s]#",$prenom)){
                        echo '<div class="alert alert-danger">Prenom Invalid</div>';
                    }
                    else{
                        if(preg_match("#[^a-zA-Z\s]#",$nom)){
                            echo '<div class="alert alert-danger">Nom Invalid</div>';
                        }
                        else{
                            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                echo '<div class="alert alert-danger">Email Invalid</div>';
                            }
                            else{
                                if(!preg_match("#^7[0-9]{8}#", $tel)){
                                    echo '<div class="alert alert-danger">Numero Telephone Invalid</div>';
                                }
                                else{
                                        if(isset($_POST['logement']) && $_POST['logement'] == 'null'){
                                            echo '<div class="alert alert-danger">Logement vide</div>';
                                        }
                                        else{
                                            if(isset($_POST['chambre']) && $_POST['chambre'] == 'null'){
                                                echo '<div class="alert alert-danger">Chambre vide</div>';
                                            }
                                            else{
                                                if(isset($_POST['adresse']) && empty($_POST['adresse'])){
                                                    echo '<div class="alert alert-danger">Adresse Vide</div>';
                                                }
                                                else{
                                                    $this->dao = new UserDao();
                                                        $dateJour = $_POST['dateJour'];
                                                        $cc = strtoupper(var_export(substr($nom, 0, 2), true).PHP_EOL);
                                                        $ll = strtoupper(var_export(substr($prenom, 0, 2), true).PHP_EOL);
                                                        function random_1($car){
                                                            $string = "";
                                                            $chaine = "0123456789";
                                                            srand((double)microtime()*1000000);
                                                            for($i=0; $i<$car; $i++) {
                                                                $string .= $chaine[rand()%strlen($chaine)];
                                                            }
                                                            return $string;
                                                        }
                                                        $serieNombre =  random_1(4);
                                                        $matri = "$dateJour";
                                                        $matri .= "$cc";
                                                        $matri .= "$ll";
                                                        $matri .= "$serieNombre";
                                                        $matri = str_replace('\'', '',$matri);
                                                        $matricule = str_replace(' ', '', $matri);

                                                        $verifcationEmail = $this->dao->isExistUser($email);
                                                        if($verifcationEmail != 0){
                                                            echo '<div class="alert alert-danger">Email existe deja</div>';
                                                        }
                                                        else{
                                                            $users = new UserDao();
                                                            if(isset($_POST['bourse']) && $_POST['bourse'] != 'null'){
                                                                if($_POST['bourse'] == 'demi-bourse' || $_POST['bourse'] == 'pension'){
                                                                    $bourse = $_POST['bourse'];
                                                                    $this->dao = new BoursiersDao();
                                                                    $typebourse = new TypeBourseDao();
                                                                    $type = $typebourse->findTypeBourse();
                                                                    for ($i=0; $i<count($type); $i++){
                                                                        if($type[$i]->getLibele() == $bourse){
                                                                            $id_type = $type[$i]->getId();
                                                                        }
                                                                    }
                                                                    if(isset($_POST['logement']) && $_POST['logement'] != 'null'){
                                                                        if($_POST['logement'] == 'oui'){
                                                                            if(isset($_POST['chambre']) && $_POST['chambre'] != 'null'){
                                                                                $chambre = new ChambreDao();
                                                                                $elementChambre = $chambre->findAll();
                                                                                for ($i=0; $i<count($elementChambre);$i++){
                                                                                    if($elementChambre[$i]->getNumeroChambre() == $_POST['chambre']){
                                                                                        $id_chambre = $elementChambre[$i]->getId();
                                                                                    }
                                                                                }
                                                                                $id_present = $this->dao->findByelement($id_chambre, 'id_chambre');
                                                                                if(count($id_present)>=2){
                                                                                    echo '<div class="alert alert-danger">La chambre est pleine pour l\'instant</div>';
                                                                                }
                                                                                else{
                                                                                    $data = $users->addUser($nom,$prenom,$email,$tel,$matricule,$date);
                                                                                    $id = $data[0];
                                                                                    $bourseEtudiant = $this->dao->addBoursier('oui',$id, $id_type, $id_chambre);
                                                                                    $tring =  '<div class="alert alert-success">Matricule : '.$matricule.'<br/>Prenom : '.$prenom.'<br/>Nom : '.$nom.'</div>';
                                                                                    echo nl2br($tring);
                                                                                }
                                                                            }
                                                                        }
                                                                        else{
                                                                            $data = $users->addUser($nom,$prenom,$email,$tel,$matricule,$date);
                                                                            $id = $data[0];
                                                                            $bourseEtudiant = $this->dao->addBoursier('non',$id, $id_type, null);
                                                                            $tring =  '<div class="alert alert-success">Matricule : '.$matricule.'<br/>Prenom : '.$prenom.'<br/>Nom : '.$nom.'</div>';
                                                                            echo nl2br($tring);
                                                                        }
                                                                    }
                                                                }
                                                                if($_POST['bourse'] == 'non'){
                                                                    if(isset($_POST['adresse'])){
                                                                        $data = $users->addUser($nom,$prenom,$email,$tel,$matricule,$date);
                                                                        $id = $data[0];
                                                                        $adresse = $_POST['adresse'];
                                                                        $nonBoursier = new NonBoursierDao();
                                                                        $etudiantNonBoursier = $nonBoursier->addEtudiantNonBoursier($adresse, $id);
                                                                        $tring =  '<div class="alert alert-success">Matricule : '.$matricule.'<br/>Prenom : '.$prenom.'<br/>Nom : '.$nom.'</div>';
                                                                        echo nl2br($tring);
                                                                    }

                                                                }

                                                            }

                                                        }

                                                }
                                            }
                                        }
                                }
                            }
                        }
                    }
            }
    }

    public function createEtudiant(){
        if (isset($_SESSION['statut'])) {
            $this->dao = new TypeBourseDao();
            $type = $this->dao->findTypeBourse();
            $this->data_view['type'] = $type;

            $this->chambre = new ChambreDao();
            $chambre = $this->chambre->findAll();
            $this->data_view['chambre'] = $chambre;

            $this->view = "CreateEtudiant";
            $this->render();
        }
        else{
            echo '404';

        }
    }

    public function Chambre(){
        if (isset($_SESSION['statut'])) {
            if (empty($_POST['numero_batiment']) || empty($_POST['type_chambre']) || $_POST['type_chambre'] == 'null') {
                echo '<div class="alert alert-danger">Champ obligatoire</div>';
            } else {
                if (preg_match("#[^0-9]#", $_POST['numero_batiment'])) {
                    echo '<div class="alert alert-danger">Numero Batiment invalid</div>';
                } else {
                    $len = strlen($_POST['numero_batiment']);
                    if ($len > 3) {
                        echo '<div class="alert alert-danger">Le numéro de batiment ne doit pas depasser 3 chiffres</div>';
                    } else {
                        if ($len == 1) {
                            $numerochambre = '00';
                            $numerochambre .= $_POST['numero_batiment'];
                        } elseif ($len == 2) {
                            $numerochambre = '0';
                            $numerochambre .= $_POST['numero_batiment'];
                        } elseif ($len == 3) {
                            $numerochambre = $_POST['numero_batiment'];
                        }
                        $type_chambre = new TypeChambreDao();
                        $chambre = new ChambreDao();
                        $type_chambre_element = $type_chambre->findTypeChambre();
                        for ($i = 0; $i < count($type_chambre_element); $i++) {
                            if ($type_chambre_element[$i]->getCategorie() == $_POST['type_chambre']) {
                                $id_type_chambre = $type_chambre_element[$i]->getId();
                            }
                        }
                        function random_1($car)
                        {
                            $string = "";
                            $chaine = "0123456789";
                            srand((double)microtime() * 1000000);
                            for ($i = 0; $i < $car; $i++) {
                                $string .= $chaine[rand() % strlen($chaine)];
                            }
                            return $string;
                        }

                        $nn = random_1(4);
                        $numerochambre .= $nn;
                        $addchambre = $chambre->addChambre($numerochambre, $_POST['numero_batiment'], $id_type_chambre);
                        echo '<div class="alert alert-success">Chambre numéro ' . $numerochambre . ' est ajoutée avec sucess</div>';
                    }
                }
            }
        }else{
            echo '404';
        }

    }

    public function createChambre(){
        if (isset($_SESSION['statut'])){
            $this->dao = new TypeChambreDao();
            $type = $this->dao->findTypeChambre();
            $this->data_view['type'] = $type;
            $this->view="CreateChambre";
            $this->render();
        }else{
            echo '404';
        }

    }

    public function listeEtudiant(){
        $this->view="ListeEtudiant";
        $this->render();
        $user = new UserDao();
        $etudiants = $user->findAll();
        $total = count($etudiants);
        $this->data_view['total'] = $total;
    }

    public function ListesDesEtudiants(){
        $user = new UserDao();
        $etudiants = $user->findAll();
        $tab = [];
        for($i=0;$i<count($etudiants); $i++){
            $tab[] = array(
                'id'=>$etudiants[$i]->getId(),
                'matricule'=>$etudiants[$i]->getMatricule(),
                'prenom'=>$etudiants[$i]->getPrenom(),
                'nom'=>$etudiants[$i]->getNom(),
                'tel'=>$etudiants[$i]->getTel(),
                'dateNaissance'=>$etudiants[$i]->getDateNaissance(),
                'email'=>$etudiants[$i]->getEmail(),
            );
        }
        $boursiers = new BoursiersDao();
        $boursiersEtudiants = $boursiers->findAll();
        $tabBoursiers = [];
        for ($i=0; $i<count($boursiersEtudiants); $i++){
            $tabBoursiers[] = array(
                'id'=>$boursiersEtudiants[$i]->getId(),
                'ishoused'=>$boursiersEtudiants[$i]->getIshoused(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
                'id_type_bourse'=>$boursiersEtudiants[$i]->getIdTypeBourse(),
                'id_chambre'=>$boursiersEtudiants[$i]->getIdChambre(),
            );
        }

        $Nonboursiers = new NonBoursierDao();
        $NonBoursiersEtudiants = $Nonboursiers->findAll();
        $tabNonBoursiers = [];
        for ($i=0; $i<count($NonBoursiersEtudiants); $i++){
            $tabNonBoursiers[] = array(
                'id'=>$NonBoursiersEtudiants[$i]->getId(),
                'adresse'=>$NonBoursiersEtudiants[$i]->getAdresse(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
            );
        }

        $type = new TypeBourseDao();
        $typeBourse = $type->findAll();
        $tabTypeBourse= [];
        for ($i=0; $i<count($typeBourse); $i++){
            $tabTypeBourse[] = array(
                'id'=>$typeBourse[$i]->getId(),
                'libele'=>$typeBourse[$i]->getLibele(),
                'montant'=>$typeBourse[$i]->getMontant(),
            );
        }

        $chambres = new ChambreDao();
        $nomChambres = $chambres->findAll();
        $tabChambres= [];
        for ($i=0; $i<count($nomChambres); $i++){
            $tabChambres[] = array(
                'id'=>$nomChambres[$i]->getId(),
                'numerochambre'=>$nomChambres[$i]->getNumerochambre(),
            );
        }

        $tabEtudiants = [];

        for ($i=0; $i<count($tab);$i++){
            $id_chambre = null;
            $bourse = 'Pas de bourse';
            $numerChambre = 'Non logé';
            $adresse = null;

            $id = $tab[$i]['id'];
            $nom = $tab[$i]['nom'];
            $prenom = $tab[$i]['prenom'];
            $email = $tab[$i]['email'];
            $matricule = $tab[$i]['matricule'];
            $dateNaissance = $tab[$i]['dateNaissance'];
            $tel = $tab[$i]['tel'];
            for ($j=0; $j<count($tabBoursiers); $j++){
                if($tab[$i]['id'] == $tabBoursiers[$j]['id_etudiant']){
                    $id_chambre = $tabBoursiers[$j]['id_chambre'];
                    $typebourse = $tabBoursiers[$j]['id_type_bourse'];
                    $ishousing = $tabBoursiers[$j]['ishoused'];
                }
                for($k=0;$k<count($tabNonBoursiers);$k++){
                        if($id === $tabNonBoursiers[$k]['id_etudiant']){
                            $adresse = $tabNonBoursiers[$k]['adresse'];
                        }
                    for($n=0; $n<count($tabTypeBourse); $n++){
                        if($typebourse == $tabTypeBourse[$n]['id']){
                            $libeleBourse =  $tabTypeBourse[$n]['libele'];
                        }
                        for($m=0; $m<count($tabChambres);$m++){
                                if ($id_chambre == $tabChambres[$m]['id']) {
                                    $numerChambre = $tabChambres[$m]['numerochambre'];
                                }
                        }
                    }
                }
            }
            $tabEtudiants[] = array(
                'id' => $id,
                'prenom' => $prenom,
                'nom' => $nom,
                'email' => $email,
                'matricule' => $matricule,
                'dateNaissance' => $dateNaissance,
                'tel' => $tel,
                'bourse'=>$libeleBourse,
                'chambre'=>$numerChambre,
                'adresse'=>$adresse
            );
        }
       echo  json_encode($tabEtudiants);
    }

    public function updateUser(){

        $id = $_POST['id'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['nom'];
        $tel = $_POST['tel'];
        $dateNaissance = $_POST['dateNaissance'];

        if(empty($prenom) || empty($nom) || empty($email)
            || empty($tel) || empty($dateNaissance)){
            echo '<div class="alert alert-danger">Tous les champs sont obligatoire</div>';
        }
        else{
                if(preg_match("#[^a-zA-Z\s]#", $prenom)){
                    echo '<div class="alert alert-danger">Prenom Invalid</div>';
                }else{
                    if(preg_match("#[^a-zA-Z\s]#", $nom)){
                        echo '<div class="alert alert-danger">Nom Invalid</div>';
                    }
                    else{
                        if(empty($email)){
                            echo '<div class="alert alert-danger">Email Invalid</div>';
                        }
                        else{
                            if(!preg_match("#^7[0-9]{8}#", $tel)){
                                echo '<div class="alert alert-danger">Numero Telephone Invalid</div>';
                            }
                            else{
                                $this->dao = new UserDao();
                                $dateJour = $_POST['matricule'][0];
                                $dateJour .= $_POST['matricule'][1];
                                $dateJour .= $_POST['matricule'][2];
                                $dateJour .= $_POST['matricule'][3];
                                $cc = strtoupper(var_export(substr($nom, 0, 2), true).PHP_EOL);
                                $ll = strtoupper(var_export(substr($prenom, 0, 2), true).PHP_EOL);
                                function random_1($car){
                                    $string = "";
                                    $chaine = "0123456789";
                                    srand((double)microtime()*1000000);
                                    for($i=0; $i<$car; $i++) {
                                        $string .= $chaine[rand()%strlen($chaine)];
                                    }
                                    return $string;
                                }
                                $serieNombre =  random_1(4);
                                $matri = "$dateJour";
                                $matri .= "$cc";
                                $matri .= "$ll";
                                $matri .= "$serieNombre";
                                $matri = str_replace('\'', '',$matri);
                                $matricule = str_replace(' ', '', $matri);
                                $verifcationEmail = $this->dao->isExistUser($email);
                                $verifcationEmail = $this->dao->isExistUser($email);
                                        $data = $this->dao->updateUser($nom,$prenom,$email,$tel,$matricule,$dateNaissance,$id);
                                        echo json_encode($data);

                            }
                        }

                    }
                }
        }


    }

    public function deleteUser(){
        $id = $_POST['id'];
        $user = new UserDao();
        $users = $user->deleteUser($id);
    }

    public function deleteChambre(){
        $chambres = new ChambreDao();
        $id = $_POST['id'];
        $chambres->delete($id);
        echo json_encode($_POST['id']);
    }

    public function UsersList(){
        $search = $_POST['search'];
        $user = new UserDao();
        $etudiants = $user->findAll();
        $tab = [];
        for($i=0;$i<count($etudiants); $i++){
            $tab[] = array(
                'id'=>$etudiants[$i]->getId(),
                'matricule'=>$etudiants[$i]->getMatricule(),
                'prenom'=>$etudiants[$i]->getPrenom(),
                'nom'=>$etudiants[$i]->getNom(),
                'tel'=>$etudiants[$i]->getTel(),
                'dateNaissance'=>$etudiants[$i]->getDateNaissance(),
                'email'=>$etudiants[$i]->getEmail(),
            );
        }
        $boursiers = new BoursiersDao();
        $boursiersEtudiants = $boursiers->findAll();
        $tabBoursiers = [];
        for ($i=0; $i<count($boursiersEtudiants); $i++){
            $tabBoursiers[] = array(
                'id'=>$boursiersEtudiants[$i]->getId(),
                'ishoused'=>$boursiersEtudiants[$i]->getIshoused(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
                'id_type_bourse'=>$boursiersEtudiants[$i]->getIdTypeBourse(),
                'id_chambre'=>$boursiersEtudiants[$i]->getIdChambre(),
            );
        }

        $Nonboursiers = new NonBoursierDao();
        $NonBoursiersEtudiants = $Nonboursiers->findAll();
        $tabNonBoursiers = [];
        for ($i=0; $i<count($NonBoursiersEtudiants); $i++){
            $tabNonBoursiers[] = array(
                'id'=>$NonBoursiersEtudiants[$i]->getId(),
                'adresse'=>$NonBoursiersEtudiants[$i]->getAdresse(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
            );
        }

        $type = new TypeBourseDao();
        $typeBourse = $type->findAll();
        $tabTypeBourse= [];
        for ($i=0; $i<count($typeBourse); $i++){
            $tabTypeBourse[] = array(
                'id'=>$typeBourse[$i]->getId(),
                'libele'=>$typeBourse[$i]->getLibele(),
                'montant'=>$typeBourse[$i]->getMontant(),
            );
        }

        $chambres = new ChambreDao();
        $nomChambres = $chambres->findAll();
        $tabChambres= [];
        for ($i=0; $i<count($nomChambres); $i++){
            $tabChambres[] = array(
                'id'=>$nomChambres[$i]->getId(),
                'numerochambre'=>$nomChambres[$i]->getNumerochambre(),
            );
        }

        $tabEtudiants = [];

        for ($i=0; $i<count($tab);$i++){
            $id_chambre = null;
            $bourse = 'Pas de bourse';
            $numerChambre = 'Non logé';
            $adresse = null;
            $libeleBourse = null;

            $id = $tab[$i]['id'];
            $nom = $tab[$i]['nom'];
            $prenom = $tab[$i]['prenom'];
            $email = $tab[$i]['email'];
            $matricule = $tab[$i]['matricule'];
            $dateNaissance = $tab[$i]['dateNaissance'];
            $tel = $tab[$i]['tel'];
            for ($j=0; $j<count($tabBoursiers); $j++){
                if($tab[$i]['id'] == $tabBoursiers[$j]['id_etudiant']){
                    $id_chambre = $tabBoursiers[$j]['id_chambre'];
                    $typebourse = $tabBoursiers[$j]['id_type_bourse'];
                    $ishousing = $tabBoursiers[$j]['ishoused'];
                }
                for($k=0;$k<count($tabNonBoursiers);$k++){
                    if($id === $tabNonBoursiers[$k]['id_etudiant']){
                        $adresse = $tabNonBoursiers[$k]['adresse'];
                    }
                    for($n=0; $n<count($tabTypeBourse); $n++){
                        if(isset($typebourse)) {
                            if ($typebourse == $tabTypeBourse[$n]['id']) {
                                $libeleBourse = $tabTypeBourse[$n]['libele'];
                            }
                        }
                        for($m=0; $m<count($tabChambres);$m++){
                            if ($id_chambre == $tabChambres[$m]['id']) {
                                $numerChambre = $tabChambres[$m]['numerochambre'];
                            }
                        }
                    }
                }
            }
            $tabEtudiants[] = array(
                'id' => $id,
                'prenom' => $prenom,
                'nom' => $nom,
                'email' => $email,
                'matricule' => $matricule,
                'dateNaissance' => $dateNaissance,
                'tel' => $tel,
                'bourse'=>$libeleBourse,
                'chambre'=>$numerChambre,
                'adresse'=>$adresse
            );
        }
        echo  json_encode($tabEtudiants);
    }

    public function seachUserByPrenom(){
        $search = $_POST['search'];
        $user = new UserDao();
        $etudiants = $user->searchUserByPrenom($search);
        $tab = [];
        for($i=0;$i<count($etudiants); $i++){
            $tab[] = array(
                'id'=>$etudiants[$i]->getId(),
                'matricule'=>$etudiants[$i]->getMatricule(),
                'prenom'=>$etudiants[$i]->getPrenom(),
                'nom'=>$etudiants[$i]->getNom(),
                'tel'=>$etudiants[$i]->getTel(),
                'dateNaissance'=>$etudiants[$i]->getDateNaissance(),
                'email'=>$etudiants[$i]->getEmail(),
            );
        }
        $boursiers = new BoursiersDao();
        $boursiersEtudiants = $boursiers->findAll();
        $tabBoursiers = [];
        for ($i=0; $i<count($boursiersEtudiants); $i++){
            $tabBoursiers[] = array(
                'id'=>$boursiersEtudiants[$i]->getId(),
                'ishoused'=>$boursiersEtudiants[$i]->getIshoused(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
                'id_type_bourse'=>$boursiersEtudiants[$i]->getIdTypeBourse(),
                'id_chambre'=>$boursiersEtudiants[$i]->getIdChambre(),
            );
        }

        $Nonboursiers = new NonBoursierDao();
        $NonBoursiersEtudiants = $Nonboursiers->findAll();
        $tabNonBoursiers = [];
        for ($i=0; $i<count($NonBoursiersEtudiants); $i++){
            $tabNonBoursiers[] = array(
                'id'=>$NonBoursiersEtudiants[$i]->getId(),
                'adresse'=>$NonBoursiersEtudiants[$i]->getAdresse(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
            );
        }

        $type = new TypeBourseDao();
        $typeBourse = $type->findAll();
        $tabTypeBourse= [];
        for ($i=0; $i<count($typeBourse); $i++){
            $tabTypeBourse[] = array(
                'id'=>$typeBourse[$i]->getId(),
                'libele'=>$typeBourse[$i]->getLibele(),
                'montant'=>$typeBourse[$i]->getMontant(),
            );
        }

        $chambres = new ChambreDao();
        $nomChambres = $chambres->findAll();
        $tabChambres= [];
        for ($i=0; $i<count($nomChambres); $i++){
            $tabChambres[] = array(
                'id'=>$nomChambres[$i]->getId(),
                'numerochambre'=>$nomChambres[$i]->getNumerochambre(),
            );
        }

        $tabEtudiants = [];

        for ($i=0; $i<count($tab);$i++){
            $id_chambre = null;
            $bourse = 'Pas de bourse';
            $numerChambre = 'Non logé';
            $adresse = null;
            $libeleBourse = null;

            $id = $tab[$i]['id'];
            $nom = $tab[$i]['nom'];
            $prenom = $tab[$i]['prenom'];
            $email = $tab[$i]['email'];
            $matricule = $tab[$i]['matricule'];
            $dateNaissance = $tab[$i]['dateNaissance'];
            $tel = $tab[$i]['tel'];
            for ($j=0; $j<count($tabBoursiers); $j++){
                if($tab[$i]['id'] == $tabBoursiers[$j]['id_etudiant']){
                    $id_chambre = $tabBoursiers[$j]['id_chambre'];
                    $typebourse = $tabBoursiers[$j]['id_type_bourse'];
                    $ishousing = $tabBoursiers[$j]['ishoused'];
                }
                for($k=0;$k<count($tabNonBoursiers);$k++){
                    if($id === $tabNonBoursiers[$k]['id_etudiant']){
                        $adresse = $tabNonBoursiers[$k]['adresse'];
                    }
                    for($n=0; $n<count($tabTypeBourse); $n++){
                        if(isset($typebourse)) {
                            if ($typebourse == $tabTypeBourse[$n]['id']) {
                                $libeleBourse = $tabTypeBourse[$n]['libele'];
                            }
                        }
                        for($m=0; $m<count($tabChambres);$m++){
                            if ($id_chambre == $tabChambres[$m]['id']) {
                                $numerChambre = $tabChambres[$m]['numerochambre'];
                            }
                        }
                    }
                }
            }
            $tabEtudiants[] = array(
                'id' => $id,
                'prenom' => $prenom,
                'nom' => $nom,
                'email' => $email,
                'matricule' => $matricule,
                'dateNaissance' => $dateNaissance,
                'tel' => $tel,
                'bourse'=>$libeleBourse,
                'chambre'=>$numerChambre,
                'adresse'=>$adresse
            );
        }
        echo  json_encode($tabEtudiants);
    }

    public function searchUserByBourse(){
        $search = $_POST['search'];
        $user = new UserDao();
        $etudiants = $user->findAll();
        $tab = [];
        for($i=0;$i<count($etudiants); $i++){
            $tab[] = array(
                'id'=>$etudiants[$i]->getId(),
                'matricule'=>$etudiants[$i]->getMatricule(),
                'prenom'=>$etudiants[$i]->getPrenom(),
                'nom'=>$etudiants[$i]->getNom(),
                'tel'=>$etudiants[$i]->getTel(),
                'dateNaissance'=>$etudiants[$i]->getDateNaissance(),
                'email'=>$etudiants[$i]->getEmail(),
            );
        }
        $boursiers = new BoursiersDao();
        $boursiersEtudiants = $boursiers->findAll();
        $tabBoursiers = [];
        for ($i=0; $i<count($boursiersEtudiants); $i++){
            $tabBoursiers[] = array(
                'id'=>$boursiersEtudiants[$i]->getId(),
                'ishoused'=>$boursiersEtudiants[$i]->getIshoused(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
                'id_type_bourse'=>$boursiersEtudiants[$i]->getIdTypeBourse(),
                'id_chambre'=>$boursiersEtudiants[$i]->getIdChambre(),
            );
        }

        $Nonboursiers = new NonBoursierDao();
        $NonBoursiersEtudiants = $Nonboursiers->findAll();
        $tabNonBoursiers = [];
        for ($i=0; $i<count($NonBoursiersEtudiants); $i++){
            $tabNonBoursiers[] = array(
                'id'=>$NonBoursiersEtudiants[$i]->getId(),
                'adresse'=>$NonBoursiersEtudiants[$i]->getAdresse(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
            );
        }

        $type = new TypeBourseDao();
        $typeBourse = $type->searchBourse($search);

        $tabTypeBourse= [];
        for ($i=0; $i<count($typeBourse); $i++){
            $tabTypeBourse[] = array(
                'id'=>$typeBourse[$i]->getId(),
                'libele'=>$typeBourse[$i]->getLibele(),
                'montant'=>$typeBourse[$i]->getMontant(),
            );
        }

        $chambres = new ChambreDao();
        $nomChambres = $chambres->findAll();
        $tabChambres= [];
        for ($i=0; $i<count($nomChambres); $i++){
            $tabChambres[] = array(
                'id'=>$nomChambres[$i]->getId(),
                'numerochambre'=>$nomChambres[$i]->getNumerochambre(),
            );
        }

        $tabEtudiants = [];

        for ($i=0; $i<count($tab);$i++){
            $id_chambre = null;
            $bourse = 'Pas de bourse';
            $numerChambre = 'Non logé';
            $adresse = null;
           // $libeleBourse = null;

            $id = $tab[$i]['id'];
            $nom = $tab[$i]['nom'];
            $prenom = $tab[$i]['prenom'];
            $email = $tab[$i]['email'];
            $matricule = $tab[$i]['matricule'];
            $dateNaissance = $tab[$i]['dateNaissance'];
            $tel = $tab[$i]['tel'];
            for ($j=0; $j<count($tabBoursiers); $j++){
                if($tab[$i]['id'] == $tabBoursiers[$j]['id_etudiant']){
                    $id_chambre = $tabBoursiers[$j]['id_chambre'];
                    $typebourse = $tabBoursiers[$j]['id_type_bourse'];
                    $ishousing = $tabBoursiers[$j]['ishoused'];
                }
                for($k=0;$k<count($tabNonBoursiers);$k++){
                    if($id === $tabNonBoursiers[$k]['id_etudiant']){
                        $adresse = $tabNonBoursiers[$k]['adresse'];
                    }
                    for($n=0; $n<count($tabTypeBourse); $n++){

                            if ($typebourse == $tabTypeBourse[$n]['id']) {
                                $libeleBourse = $tabTypeBourse[$n]['libele'];
                            }

                        for($m=0; $m<count($tabChambres);$m++){
                            if ($id_chambre == $tabChambres[$m]['id']) {
                                $numerChambre = $tabChambres[$m]['numerochambre'];
                            }
                        }
                    }
                }
            }
            if(isset($libeleBourse)){
                $tabEtudiants[] = array(
                    'id' => $id,
                    'prenom' => $prenom,
                    'nom' => $nom,
                    'email' => $email,
                    'matricule' => $matricule,
                    'dateNaissance' => $dateNaissance,
                    'tel' => $tel,
                    'bourse'=>$libeleBourse,
                    'chambre'=>$numerChambre,
                    'adresse'=>$adresse
                );
            }
        }
        echo  json_encode($tabEtudiants);
    }

    public function searchUserByChambre(){
        $search = $_POST['search'];
        $user = new UserDao();
        $etudiants = $user->findAll();
        $tab = [];
        for($i=0;$i<count($etudiants); $i++){
            $tab[] = array(
                'id'=>$etudiants[$i]->getId(),
                'matricule'=>$etudiants[$i]->getMatricule(),
                'prenom'=>$etudiants[$i]->getPrenom(),
                'nom'=>$etudiants[$i]->getNom(),
                'tel'=>$etudiants[$i]->getTel(),
                'dateNaissance'=>$etudiants[$i]->getDateNaissance(),
                'email'=>$etudiants[$i]->getEmail(),
            );
        }
        $boursiers = new BoursiersDao();
        $boursiersEtudiants = $boursiers->findAll();
        $tabBoursiers = [];
        for ($i=0; $i<count($boursiersEtudiants); $i++){
            $tabBoursiers[] = array(
                'id'=>$boursiersEtudiants[$i]->getId(),
                'ishoused'=>$boursiersEtudiants[$i]->getIshoused(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
                'id_type_bourse'=>$boursiersEtudiants[$i]->getIdTypeBourse(),
                'id_chambre'=>$boursiersEtudiants[$i]->getIdChambre(),
            );
        }

        $Nonboursiers = new NonBoursierDao();
        $NonBoursiersEtudiants = $Nonboursiers->findAll();
        $tabNonBoursiers = [];
        for ($i=0; $i<count($NonBoursiersEtudiants); $i++){
            $tabNonBoursiers[] = array(
                'id'=>$NonBoursiersEtudiants[$i]->getId(),
                'adresse'=>$NonBoursiersEtudiants[$i]->getAdresse(),
                'id_etudiant'=>$boursiersEtudiants[$i]->getIdEtudiant(),
            );
        }

        $type = new TypeBourseDao();
        $typeBourse = $type->findAll();
        $tabTypeBourse= [];
        for ($i=0; $i<count($typeBourse); $i++){
            $tabTypeBourse[] = array(
                'id'=>$typeBourse[$i]->getId(),
                'libele'=>$typeBourse[$i]->getLibele(),
                'montant'=>$typeBourse[$i]->getMontant(),
            );
        }

        $chambres = new ChambreDao();
        $nomChambres = $chambres->searchByChambre($search);
        $tabChambres= [];
        for ($i=0; $i<count($nomChambres); $i++){
            $tabChambres[] = array(
                'id'=>$nomChambres[$i]->getId(),
                'numerochambre'=>$nomChambres[$i]->getNumerochambre(),
            );
        }

        $tabEtudiants = [];

        for ($i=0; $i<count($tab);$i++){
            $id_chambre = null;
            $bourse = 'Pas de bourse';
            $numerChambre = 'Non logé';
            $adresse = null;
            $libeleBourse = null;

            $id = $tab[$i]['id'];
            $nom = $tab[$i]['nom'];
            $prenom = $tab[$i]['prenom'];
            $email = $tab[$i]['email'];
            $matricule = $tab[$i]['matricule'];
            $dateNaissance = $tab[$i]['dateNaissance'];
            $tel = $tab[$i]['tel'];
            for ($j=0; $j<count($tabBoursiers); $j++){
                if($tab[$i]['id'] == $tabBoursiers[$j]['id_etudiant']){
                    $id_chambre = $tabBoursiers[$j]['id_chambre'];
                    $typebourse = $tabBoursiers[$j]['id_type_bourse'];
                    $ishousing = $tabBoursiers[$j]['ishoused'];
                }
                for($k=0;$k<count($tabNonBoursiers);$k++){
                    if($id === $tabNonBoursiers[$k]['id_etudiant']){
                        $adresse = $tabNonBoursiers[$k]['adresse'];
                    }
                    for($n=0; $n<count($tabTypeBourse); $n++){
                        if(isset($typebourse)) {
                            if ($typebourse == $tabTypeBourse[$n]['id']) {
                                $libeleBourse = $tabTypeBourse[$n]['libele'];
                            }
                        }
                        for($m=0; $m<count($tabChambres);$m++){
                            if ($id_chambre == $tabChambres[$m]['id']) {
                                $numerChambre = $tabChambres[$m]['numerochambre'];
                            }
                        }
                    }
                }
            }
            if (isset($numerChambre) && $numerChambre != 'Non logé'){
                $tabEtudiants[] = array(
                    'id' => $id,
                    'prenom' => $prenom,
                    'nom' => $nom,
                    'email' => $email,
                    'matricule' => $matricule,
                    'dateNaissance' => $dateNaissance,
                    'tel' => $tel,
                    'bourse'=>$libeleBourse,
                    'chambre'=>$numerChambre,
                    'adresse'=>$adresse
                );
            }
        }
        echo  json_encode($tabEtudiants);
    }

    public function ListeDesChambres(){
        $rowid = $_POST['rowid'];
        $rowperpage = $_POST['rowperpage'];
        $chambre = new ChambreDao();
        $cham = $chambre->findChambre($rowid,$rowperpage);
        $fetchresult = $chambre->conmpterChambre();
        $allcount = $fetchresult['allcount'];
        $tab[] = array("allcount" => $allcount);;
        $typeChambre = new TypeChambreDao();
        $type = $typeChambre->findTypeChambre();
        $tabChambre =  [];
        for ($i=0; $i<count($cham); $i++){
            for($j=0;$j<count($type); $j++){
                if($cham[$i]->getIdTypeChambre() == $type[$j]->getId()){
                    $typeDuChambre = $type[$j]->getCategorie();
                }
            }
            $tab[]    = array(
                'id'=>$cham[$i]->getId(),
                'numeroChambre'=>$cham[$i]->getNumeroChambre(),
                'numeroBatiment'=>$cham[$i]->getNumeroBatiment(),
                'type_chambre'=>$typeDuChambre,
            );
        }
        echo json_encode($tab);
    }

    public function UpdateChambre(){
        $chambre = new ChambreDao();
        $cham = $chambre->findAll();
        $fetchresult = $chambre->conmpterChambre();
        $allcount = $fetchresult['allcount'];
        $tab[] = array("allcount" => $allcount);;
        $typeChambre = new TypeChambreDao();
        $type = $typeChambre->findTypeChambre();
        $tabChambre =  [];
        for ($i=0; $i<count($cham); $i++){
            for($j=0;$j<count($type); $j++){
                if($cham[$i]->getIdTypeChambre() == $type[$j]->getId()){
                    $typeDuChambre = $type[$j]->getCategorie();
                }
            }
            $tab[]    = array(
                'id'=>$cham[$i]->getId(),
                'numeroChambre'=>$cham[$i]->getNumeroChambre(),
                'numeroBatiment'=>$cham[$i]->getNumeroBatiment(),
                'type_chambre'=>$typeDuChambre,
            );
        }
        echo json_encode($tab);
    }

    public function updateDesChambre(){
        $chambre = new ChambreDao();
        $id = $_POST['id'];
        $numerochambre = $_POST['numeroChambre'];
        $numerBatiment = $_POST['numeroBatiment'];



        $len = strlen($_POST['numeroBatiment']);
        if($len==1){
            $numerochambre = '00';
            $numerochambre .= $_POST['numeroBatiment'];
        }
        elseif ($len==2){
            $numerochambre = '0';
            $numerochambre .= $_POST['numeroBatiment'];
        }
        elseif ($len==3){
            $numerochambre = $_POST['numeroBatiment'];
        }
        function random_1($car){
            $string = "";
            $chaine = "0123456789";
            srand((double)microtime()*1000000);
            for($i=0; $i<$car; $i++) {
                $string .= $chaine[rand()%strlen($chaine)];
            }
            return $string;
        }
        $nn =  random_1(4);
        $numerochambre .= $nn;
        $updatechambre = $chambre->updateChambre($id,$numerochambre,$numerBatiment);
        echo json_encode($updatechambre);
    }



    public function listeChambre(){
        if (isset($_SESSION['statut'])) {
            $this->view = "ListeChambre";
            $this->render();
        }
        else{
            echo '404';
        }
    }



    /**
     * @return mixed
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * @param mixed $chambre
     */
    public function setChambre($chambre)
    {
        $this->chambre = $chambre;
    }


}
