<?php require_once("inc/connection.php") ?>
<?php   

  if(isset($_POST["submit"])){

    $errors = array();

    if(! isset($_POST["email"]) || strlen(trim($_POST["email"]))<1){
       $errors[] = "User name is missing/Invalid";
    }

    if(! isset($_POST["password"]) || strlen(trim($_POST["password"]))<1){
        $errors[] = "password is missing/Invalid";
     }

     if(empty($errors)){
        $email = mysqli_real_escape_string($connection,$_POST["email"]);
        $password = mysqli_real_escape_string($connection,$_POST["password"]);

        $hashed_password = sha1($password);

        $query = "SELECT * FROM user WHERE email = '{$email}' AND password = '{$password}' LIMIT 1;"; 
       
        $result_set = mysqli_query($connection, $query); 
        
        if($result_set){
            if(mysqli_num_rows($result_set) == 1){
                header("location: user.php");
            }
            else{
                $errors[] = "invalid username / password";
            }
        }
        else{
            $errors[] = "database query failed";
        }
     }
  
}


?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login user management system</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login">

<form action="index.php" method="post">

<fieldset>
    <legend>Log In</legend>


         <?php 
            if(isset($errors) && !empty($errors)){
                echo '    <p class="error">';
                echo $errors[0];
                echo '  </p>';
            }
         
         ?>
  
 

    <p>
        <label for="">Username</label>
        <input type="email" placeholder="Email Address" name="email">
    </p>


    <p>
        <label for="">password</label>
        <input type="password" placeholder="Password" name="password">
    </p>

    <p>
        <button type="submit" name="submit">Log In</button>
    </p>





</fieldset>
</form>
</div>
   
</body>
</html>
<?php mysqli_close($connection); ?>
