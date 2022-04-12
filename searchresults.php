<?php

session_start();
// Include database connection file
include_once('config.php');

if (!isset($_SESSION['ID'])) {
    header("Location:login.php");
    exit();
}
if (isset($_POST['submit'])) {
    $search_query = $_POST['search'];
    $_SESSION['SEARCH_QUERY'] = $search_query;

    header('Location:searchresults.php');
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
                        <a class="nav-link" class="btn btn-info " href="logout.php"><?php echo ucwords($_SESSION['NAME']); ?> Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
    <div class="row m-4">
            <form class="form-inline my-2 my-lg-0 input-group md-form form-sm form-1 pl-0" action="" method="POST">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search for a trade" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search Trade</button>
            </form>
        </div>
        

        <?php
        
        $search_query = $_SESSION['SEARCH_QUERY'];
        $search_query_formatted = "'%".$search_query."%'";
        $query = "SELECT * FROM profiles WHERE trade LIKE $search_query_formatted";
        
        $result=$con->query($query); 
        if($result){ 
         if ($result->num_rows> 0) {
           
         }else{ 
           
         } 
        }else{ 
        echo "Error in ".$query."
        ".$con->error; }
        $result = $con->query($query);
        if ($result->num_rows > 0) {
            echo '<div class="row">
            <h4><u>Found Tradesmen</u></h4>
            </div>';
            while ($row = $result->fetch_array()) {
        ?>

                <a href="tradesman.php">
                <!-- Save clicked tradesman id  -->
                <?php 
                    $_SESSION['TRADESMAN_ID'] = $row['id'];
                ?>
                
                    <div class="row mb-3">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <img src="images/<?php echo $row['image']; ?>" class="rounded" width="170" height="170">
                        </div>
                        <div class="col-md-4">
                            <h4><?php echo $row['fname'] ?></h4> <br>
                            

                            <?php 
                            $tradesman_id = $row['id'];
                            $query2 = "SELECT * FROM jobs WHERE tradesman_id = '$tradesman_id'";
                            $result2 = $con->query($query2);
                            if ($result2->num_rows > 0) {
                                $rates = array();
                                while ($row2 = $result2->fetch_array()) {
                                    array_push($rates, $row2['rate']);

                                }
                             
                        
                              
                            } else {
                              $errorMsg = "No user found on this username";
                            }
                            ?>
                            <h5>Rate <?php 
                                if(!empty($rates) > 0){
                                    echo array_sum($rates)/count($rates); 
                                } else{
                                    echo '0';
                                }
                                ?>
                            / 5</h5>
                            <p class="mt-1"><?php echo $row['trade'] ?></p>
                            <?php echo $row['location'] ?> <br>

                        </div>
                        <div class="col-md-2 mb-1">
                            <?php echo date('d-M-Y', strtotime($row['created'])) ?> <br>
                            <?php
                            if($row['availability']){
                                echo "<button type='button' class='btn btn-success btn-lg btn-block mt-5'>Available</button>";
                            } else {
                                echo "<button type='button' class='btn btn-danger btn-lg btn-block mt-5'>Not available</button>"; 
                            }
                            ?>
                            
                        </div>


                    </div>
                </a>

                <hr>

        <?php   }
        } else {
            echo "<h2>No tradesmen found!</h2>";
        } ?>

    </div>

</body>

</html>