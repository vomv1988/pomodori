<html>
        <head>
                <title>Log-in</title>
        </head>
        <body>
                <h1>Log-in</h1>
<?php

# Naive log-in
#       _ Use https for session security
#       _ Consider using Source/22
#       _ 

session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$conn = new mysqli('localhost', 'pomodori_user', 'tomatoes', 'pomodori');

if(mysqli_connect_error()){
?>
	        <p>Could not connect to database</p>
                <p><?php echo(mysqli_connect_error()); ?></p>
<?php
} else {
?>
                <p>Connection with database successful</p>
<?php
}

$query = "select * from users "
        ."where username='$username' "
        ."and password='$password'";

$result = $conn->query($query);

if($result){
?>
                <p>Query successful</p>
<?php
        if($result->num_rows > 0 ){
        ?>
                <p>Log in successful.</p>
                <p>Welcome, <b><?php echo($username); ?></b>!</p>
        <?php
                $_SESSION['valid_user'] = $username;    
        } else {
        ?>
                <p>Could not log you in.</p>
        <?php
        }
} else {
?>
                <p>Query failed.</p>
                <p><?php echo($conn->error); ?></p>
<?php
}
?>
        </body>
</html>
