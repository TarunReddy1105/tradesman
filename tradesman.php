<?php

session_start();
// Include database connection file
include_once('config.php');

if (!isset($_SESSION['ID'])) {
    header("Location:login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $client_id = $_SESSION['ID'];
    $tradesman_id = $_SESSION['TRADESMAN_ID'];
    $query  = "INSERT INTO jobs (client_id, tradesman_id) VALUES ($client_id, $tradesman_id)";
    $result = $con->query($query);

    if ($result == true) {
        header("Location:clientjobs.php");
        die();
    } else {
        echo "Error hiring...Please Try again";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tradesmen | home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* unvisited link */
        a:link {
            color: black;
        }

        /* visited link */
        a:visited {
            color: black;
        }

        /* mouse over link */
        a:hover {
            color: #001a33;
        }

        /* selected link */
        a:active {
            color: #001a33;
        }
    </style>
</head>

<body>
    :
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
                            <a class="nav-link active" aria-current="page" href="homeclient.php"> <b>Home</b></a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="clientjobs.php"> <b>Jobs</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" class="btn btn-info " href="logout.php"><?php echo ucwords($_SESSION['NAME']); ?> Logout</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    <div class="container">


        <?php

        //Get clicked tradesman id from session
        $id = $_SESSION['TRADESMAN_ID'];
        $query = "SELECT * FROM profiles WHERE id = $id";


        $result = $con->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
        ?>

                <div class="row mb-3">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <img src="images/<?php echo $row['image']; ?>" class="rounded" width="170" height="170">
                    </div>
                    <div class="col-md-4">
                        <h4><?php echo $row['fname'] ?></h4> <br>
                        <h5>Rating goes here</h5>
                        <p class="mt-1"><?php echo $row['trade'] ?></p>
                        <?php echo $row['location'] ?> <br>

                    </div>
                    <div class="col-md-2 mb-1">
                        <?php echo date('d-M-Y', strtotime($row['created'])) ?> <br>
                        <form method="post" enctype="multipart/form-data">
                            <input type="submit" name="submit" value="Hire me" class='btn btn-success btn-lg btn-block  mt-5'>
                        </form>



                    </div>


                </div>


                <hr>

        <?php   }
        } else {
            echo "<h2>No tradesmen found!</h2>";
        } ?>

    </div>

</body>

</html>