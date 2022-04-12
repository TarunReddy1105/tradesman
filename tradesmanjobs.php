<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tradesmen | My jobs</title>
</head>

<body>
    <?php

    session_start();
    // Include database connection file
    
    include_once('config.php');

    if (!isset($_SESSION['ID'])) {
        header("Location:login.php");
        exit();
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
        <div class="container">

           


                <?php

                $id = $_SESSION['ID'];
                $query = "SELECT * FROM jobs WHERE tradesman_id = $id";


                $result = $con->query($query);
                
                ?>
            

            <?php
            if ($result->num_rows > 0) {
                echo '<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Client_id</th>
        <th scope="col">Created</th>
        <th scope="col">Rate</th>
      </tr>
    </thead>';

                while ($row = $result->fetch_array()) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['client_id']."</td>";
                    echo "<td>".date('d-M-Y', strtotime($row['created']))."</td>";
                    echo "<td> ".$row['rate']." </td>";
                    echo "<tr>";
                }
            } else {
                echo "<h2>No recent jobs found!</h2>";
            }
            echo '</table>';
            ?>
            
        </div>

    </body>

    </html>
</body>

</html>