<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="icon" href="resources/logo.jpeg" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" /> -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

    <!-- <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script> -->

</head>

<body class="body">

    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-4">
                <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>
            </div>

            <!-- <div class="col-12 bg-secondary bg-opacity-25 mb-2" style=" height: 100px;">
                <div class="row">

                    <div class="col-3 mt-2">
                        <div class="row">
                            <input class="d-none" type="text" value="<?php echo $s_id; ?>" id="sid">
                            <span class="form-label text-white fs-2 mx-4" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;" id="usid"><?php echo $session_data["id"]+ 1; ?></span>
                            <span class="form-label text-white fs-5 mx-4" style="font-family: 'Times New Roman', Times, serif; margin-top: -10px;"><?php echo $date ?></span>
                        </div>
                    </div>

                    <div class="col-6 mt-2 text-center text-white">
                        <div class="row">

                            <input class="d-none" type="text" value="<?php echo $threeMinutesLater ?>" id="time">
                            <div id="countdown"></div>

                        </div>
                    </div>

                    <div class="col-3 text-end">
                        <div class="row">
                            <button disabled class="btn btn-outline-primary fw-bold rounded rounded-5" id="investBtn" style="width:200px; margin-top: 15px; margin-left: 50px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Join Colour
                            </button>
                            <button disabled class="btn btn-outline-warning fw-bold rounded rounded-5" id="investBtn2" style="width:200px; margin-top: 5px; margin-left: 50px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                Join Number
                            </button>
                        </div>
                    </div>

                </div>
            </div> -->


            <!-- Toast -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                       
                        <strong class="me-auto">Bootstrap</strong>
                        <small>11 mins ago</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Hello, world! This is a toast message.
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <!-- <script src="bootstrap.js"></script>ෆ -->
    <script>
        const toastTrigger = document.getElementById('liveToastBtn');
        const toastLiveExample = document.getElementById('liveToast');

        if (toastTrigger) {
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastTrigger.addEventListener('click', () => {
                toastBootstrap.show()
            })
        }
    </script>


    <script src="sessionScript.js"></script>

</body>

</html>