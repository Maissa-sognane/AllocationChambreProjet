<div class="container ">
    <div class="d-flex flex-column form-login align-items-center justify-content-center">
        <h1 class="d-block text-white">LOGIN</h1>
        <form method="post" action="<?=BASE_URL?>/security/connexion" id="formLogin">
            <div class="form-row">
                <div class="col">
                    <input type="text" name="login" class="form-control p-lg-5 input-login" placeholder="Login">
                    <span class="text-danger"><?=@$error['login']?></span>
                </div>
                <div class="col">
                    <input type="password" name="password" class="form-control p-lg-5 input-login" placeholder="Password">
                    <span class="text-danger"><?=@$error['password']?></span>
                </div>
            </div>
            <button class="btn btn-dark btn-lg w-100 btn-connexion p-lg-3" name="btn_connexion" type="submit" value="connexion">Connexion</button>
            <a href="#" class="text-white">
                Forgot password?
            </a>
        </form>

    </div>

</div>



