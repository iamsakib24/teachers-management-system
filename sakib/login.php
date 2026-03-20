<?php
session_start();
include "db.php";

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $res = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
    if($res->num_rows > 0){
        $user = $res->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
    } else {
        echo "Invalid login";
    }
}
?>

<form method="POST">
<h2>Login</h2>
<input type="text" name="username" placeholder="Username" required><br>
<input type="password" name="password" placeholder="Password" required><br>
<button type="submit">Login</button>
</form>
