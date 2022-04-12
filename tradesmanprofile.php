<?php

session_start();
// Include database connection file
include_once('config.php');

if (!isset($_SESSION['ID'])) {
    header("Location:login.php");
    exit();
}


//Post profile details into db
if (isset($_POST['submit'])) {


    $profile_id = $_SESSION['ID'];
    $fname = $con->real_escape_string($_POST['fname']);
    
    $trade     = $con->real_escape_string($_POST['trade']);
    
    $email     = $con->real_escape_string($_POST['email']);
    $availabilty= filter_input(INPUT_POST, 'availability', FILTER_SANITIZE_STRING);
    

    
    $query  = "UPDATE profiles SET fname = $fname,email= $email, trade = $trade, availability=$availabilty WHERE user_id = $profile_id";
    $result = $con->query($query);

    if ($result == true) {
        $image_success = "Profile updated successfully.";
        header("Location:tradesmanjobs.php");
        die();
    } else {
        header("Location:tradesmanjobs.php");
    }
}
?>
<style type="text/css">
    .nav-link {
        color: #f9f6f6;
        font-size: 14px;
    }
</style>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<nav id="navbar" class="navbar navbar-expand-md navbar-light bg-white shadow-lg pt-3 pb-3 mb-4">
            <div class="container-fluid d-flex justify-items-center ">
                <div class="navbar-brand d-flex justify-content-center">

                    <h2><b>Tradesmen</b></h2>

                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav my-auto">
                        
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="tradesmanprofile.php"> <b>Profile</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="tradesmanjobs.php"> <b>Jobs</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" class="btn btn-info " href="logout.php"><?php echo ucwords($_SESSION['NAME']); ?> Logout</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    <div class="container mt-4">
        <?php if (isset($image_err)) { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $image_err; ?>
            </div>
        <?php } ?>
        <?php if (isset($image_success)) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $image_success; ?>
            </div>
        <?php } ?>
        <div class="mb-2">
            Hi, <?php echo ucwords($_SESSION['NAME']); ?>. Provide the following information to update your profile.
        </div>
        <div class="row shadow-lg p-4">


            <div class="col-md-4 border-right">

                <div id="preview">
                    <img src="images/placeholder.png" width="300" height="auto" alt="profile picture">
                </div>

            </div>
            <div class="col-md-8">
                <form method="post" enctype="multipart/form-data">
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Full name</label>
                        <div class="col-sm-10">
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="Full name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="trade" class="col-sm-2 col-form-label">Trade</label>
                        <div class="col-sm-10">
                            <input type="text" name="trade" class="form-control" id="trade" placeholder="Trade/Profession">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="hours" class="col-sm-2 col-form-label">Opening & Closing</label>
                        <div class="col-sm-10">
                            <input type="text" name="hours" class="form-control" id="hours" placeholder="Opening and closing hours">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">Availability</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="availability" id="availability">
                        <option value="">Select availability..</option>
                            <option value="true" >Available</option>
                            <option value="false">Currently unavailable</option>
                        </select>
                        </div>
                    </div>

                    <input type="submit" name="submit" value="Update profile">
                </form>
            </div>

        </div>



    </div>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function imagePreview(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function(event) {
                    $('#preview').html('<img src="' + event.target.result + '" width="300" height="auto"/>');
                };
                fileReader.readAsDataURL(fileInput.files[0]);
            }
        }

        $("#image").change(function() {
            imagePreview(this);
        });
    </script>
</body>

</html>