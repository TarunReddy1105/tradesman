<?php

  // Include database connection file

  include_once('config.php');

  if (isset($_POST['submit'])) {
    
    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string(md5($_POST['password']));
    $role     = $con->real_escape_string($_POST['role']);

    $query  = "INSERT INTO users (username,password,role) VALUES ('$username','$password','$role')";
    $result = $con->query($query);
    
    if ($result==true) {
      header("Location:login.php");
      die();
    }else{
      $errorMsg  = "Registration failed..Please Try again";
    }   

  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tradesmen | Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container">
    <h3 style="padding:20px;">
      Tradesmen
    </h3>
  </div>

  <div class="card text-center" >
    <h4>Welcome </h4>
  </div><br>

<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
      <div class="col-md-6 shadow-lg p-4">      
        <?php if (isset($errorMsg)) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $errorMsg; ?>
          </div>
        <?php } ?>
        <form action="" method="POST">
          <div class="form-group">  
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username" required="">
          </div>
          <div class="form-group">  
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter Password" required="">
          </div>
          <div class="form-group">  
            <label for="role">Role:</label>
            <select class="form-control" name="role" required="">
              <option value="">Select Role</option>
              <option value="tradesman">Tradesman/Professional</option>
              <option value="client">Normal Client</option>
            </select>
          </div>
          <div class="form-group">
            <p>Already have account ?<a href="login.php"> Login</a></p>
            <input type="submit" name="submit" class="btn btn-primary">
          </div>
        </form>
      </div>
  </div>
</div>
</body>
</html>