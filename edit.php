<?php

session_start();
// Include database connection file
include_once('config.php');

if (!isset($_SESSION['ID'])) {
    header("Location:login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $job_id = $_SESSION['JOB_ID'];
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $rate = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_STRING);

    $query  = "UPDATE jobs SET status = '$status', rate = $rate WHERE id = $job_id";
    $result = $con->query($query);

    if ($result == true) {
        header("Location:clientjobs.php");
        die();
    } else {
        echo "Error rating...Please Try again";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tradesmen | edit</title>
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
                        <form class="form-inline my-2 my-lg-0" action="" method="POST">
                             <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
                        </form>

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
        $id = $_SESSION['JOB_ID'];
        $query = "SELECT * FROM jobs WHERE id = $id";


        $result = $con->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
        ?>


                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="rate" class="col-sm-5 col-form-label">Rate <?php echo $_SESSION['NAME']; ?>,s work</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="rate" id="rate">
                                    <option value="">Select rate..</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rate" class="col-sm-5 col-form-label">Status</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="status" id="status">
                                    <option value="">Select status of the job..</option>
                                    <option value="complete">Completed</option>
                                    <option value="incomplete">incomplete</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" name="submit" value="Rate" class='btn btn-success btn-lg btn-block  mt-5'>
                    </form>




    </div>


    <hr>

<?php   }
        } else {
            echo "<h2>Error fetching job!</h2>";
        } ?>

</div>

</body>

</html>