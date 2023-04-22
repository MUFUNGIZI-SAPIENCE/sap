<?php 
if(session_start()===null)session_start();
if(isset($_SESSION['agent'])){
    unset($_SESSION['agent']);
    session_destroy();
}
require_once('tete.php');?>
    <title>Connexion</title>
    <div class="container" style="background-image: url(bg1.jpg);">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <!-- <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;bg1.jpg&quot;);"></div> -->
                            </div>
                            <div class="col-lg-6" >
                                <div class="p-5" >
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Connexion</h4>
                                            
                                    </div>
                                    <form class="user" id="loginAgent" >
                                        <div class="form-group"><input class="form-control form-control-user" type="text" id="codeAgent" aria-describedby="emailHelp" placeholder="Entrez votre code..." name="codeAgent" autofocus></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="" placeholder="Mot de passe" name="password"></div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <!-- <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div> -->
                                                    <span id="resultat"></span>
                                            </div>
                                        </div><button class="btn btn-primary btn-block text-white btn-user" type="submit">Connexion</button>
                                        <!-- <hr><a class="btn btn-primary btn-block text-white btn-google btn-user" role="button"><i class="fab fa-google"> -->
                                            
                                        <!-- </i>&nbsp; Login with Google</a><a class="btn btn-primary btn-block text-white btn-facebook btn-user" role="button"><i class="fab fa-facebook-f"></i>&nbsp; Login with Facebook</a> -->
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="forgot-password.php">Mot de passe oublié?</a></div>
                                    <!-- <div class="text-center"><a class="small" href="register.php">Create an Account!</a></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('pied.php');?>