<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SignIn</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body style="background-color: #000232;">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 d-block vh-100 overflow-hidden" style="margin-top: -50px;">
                    <div class="row">

                        <section class="ftco-section">
                            <div class="container">

                                <div class="row justify-content-center">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="login-wrap py-5">
                                            <div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/bg.jpg);"></div>
                                            <h3 class="text-center mb-0">Welcome</h3>
                                            <p class="text-center">Sign in by entering the information below</p>
                                            <div class="login-form">
                                                <div class="form-group">
                                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-envelope"></span></div>
                                                    <input type="text" class="form-control" placeholder="Email" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
                                                    <input type="password" class="form-control" placeholder="Password" id="pw" required>
                                                </div>
                                                
                                                <div class="form-group d-md-flex">
                                                    <div class="w-100 text-md-right">
                                                        <a href="#" onclick="forgotPw();">Forgot Password</a>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button type="" class="btn btn-primary rounded  px-3 offset-2" onclick="signin();" style="width: 200px;">Get Started</button>
                                                </div>
                                            </div>
                                            <div class="w-100 text-center mt-4 text">
                                                <p class="mb-0">Don't have an account?</p>
                                                <a href="signup.php" >REGISTER</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>

                        <!-- modal -->
            
                            <div class="modal" tabindex="-1" id="adminSigninModel" >
                                <div class="modal-dialog modal-dialog-centered" >
                                    <div class="modal-content" style="background-color: #000232;">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">Admin Signin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">    
                                            <div class="row g-3">
                                                
                                                <span class="text-success">Verification Code has sent to your Email. Please check your inbox.</span>

                                                <div class="col-12">
                                                    <label class="form-label">Verification Code</label>
                                                    <div class="input-group mb-3 text-dark">
                                                        <input type="text" class="form-control text-dark" id="vc"/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            
                                            <button type="button" class="btn btn-primary" onclick="verifyAdmin();">Signin</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        
                        <!-- modal -->

                        <!-- modal -->
            
                            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="background-color: #000232;">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reset Password</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">    
                                            <div class="row g-3">
                                                
                                                <span class="text-success">Verification Code has sent to your Email. Please check your inbox.</span>
                                                <div class="col-6">
                                                    <label class="form-label">New Password</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" id="npi"/>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <label class="form-label">Re-type Password</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" id="rnp"/>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Verification Code</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id="vc"/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            
                                            <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        
                        <!-- modal -->

                    </div>
                </div>

            </div>
        </div>
        
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

    </body>

</html>
