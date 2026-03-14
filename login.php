<?php
session_start();
include "db.php";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        echo "All fields are required!";
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        $user = $result->fetch_assoc();

        if(password_verify($password,$user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            header("Location:index.php");
        }
        else
        {
            echo "Invalid password";
        }
    }
    else
    {
        echo "User not found";
    }
}
?>

<h2>Login</h2>

<form method="POST">

Email:<br>
<input type="email" name="email" required>

<br><br>

Password:<br>
<input type="password" name="password" required>

<br><br>

<button name="login">Login</button>

</form>