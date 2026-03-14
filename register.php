<?php
include "db.php";

if(isset($_POST['register']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        echo "All fields are required!";
        exit();
    }

    // Hash the password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();

    echo "Registration successful! <a href='login.php'>Login here</a>";
}
?>

<h2>Register</h2>

<form method="POST">

Email:<br>
<input type="email" name="email" required>

<br><br>

Password:<br>
<input type="password" name="password" required>

<br><br>

<button name="register">Register</button>

</form>