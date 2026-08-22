<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
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
                            <div class="container overflow-auto">

                                <div class="row justify-content-center">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="login-wrap py-5">
                                            <div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/bg.jpg);"></div>
                                            <!-- <h3 class="text-center mb-0">Welcome</h3> -->
                                            <div class="login-form">
                                                
                                                <div class="form-group">
                                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-envelope"></span></div>
                                                    <input type="text" class="form-control" placeholder="Email" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
                                                    <input type="password" class="form-control" placeholder="Password" id="pw" required>
                                                </div>
                                                <div class="form-group">
                                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-phone"></span></div>
                                                    <input type="text" class="form-control" placeholder="Mobile" id="mobile" required>
                                                </div>

                                                <div class="form-group">
                                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-share-alt"></span></div>
                                                    <input type="text" class="form-control" placeholder="Referral Code" id="r_code">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <button type="" class="btn form-control btn-primary rounded submit px-3" onclick="signup();">Register</button>
                                                </div>
                                            </div>
                                            <div class="w-100 text-center mt-4 text">
                                                <p class="mb-0">Already have an account?</p>
                                                <a href="signin.php">Sign In</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>

                    </div>
                </div>

            </div>
        </div>
        
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>
<!-- 
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script> -->

    </body>

</html>
