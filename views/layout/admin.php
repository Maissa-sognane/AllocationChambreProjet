<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="icon" href="<?=BASE_URL?>/public/img/logo2.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=BASE_URL?>/public/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="<?=BASE_URL?>/public/img/log.png" class=" w-25 h-35" alt="..."></a>
<!--
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Deconnection
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div>
-->

        <div class="dropleft">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="<?=BASE_URL?>/security/deconnexion">Deconnexion</a>
            </div>
        </div>

    </div>
</nav>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row" style="height: -webkit-fill-available;s">
        <div class="col-4" style="background-color: #212529;color: white">
            <div class="row">
                <div class="col-12">
                    <p class="text-left p-3" style="font-family: 'Roboto Slab'">Menu</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="list-group"  id="list-tab" role="tablist">
                        <a class="list-group-item p-lg-5 list-group-item-action" id="createEtudiant" href="<?=BASE_URL?>/admin/createEtudiant" >
                            <i class="fas fa-user-plus"><span> Ajouter Etudiant</span></i>
                        </a>
                        <a class="list-group-item p-lg-5 list-group-item-action" id="createChambre"   href="<?=BASE_URL?>/admin/createChambre" >
                            <i class="fas fa-plus-square"><span> Ajouter Chambre</span></i>
                        </a>
                        <a class="list-group-item p-lg-5 list-group-item-action" id="ListeEtudiant"  href="<?=BASE_URL?>/admin/ListeEtudiant" role="tab" aria-controls="messages">
                            <i class="fas fa-users"> <span>Les Etudiants</span></i>
                        </a>
                        <a class="list-group-item p-lg-5 list-group-item-action" id="ListeChambre"  href="<?=BASE_URL?>/admin/ListeChambre" role="tab" aria-controls="settings">
                            <i class="fas fa-house-user"> <span>Les Chambres</span></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8" id="menu" style="background-color: #E5E5E5">
            <?php echo $content_for_layout ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.5.0.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>
<script src="https://kit.fontawesome.com/8435a2a226.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="<?=BASE_URL?>/public/js/script.js"></script>



</body>
</html>



