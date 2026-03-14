<?php
include "db.php";

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Server-side validation
    if(empty($title) || empty($content)){
        echo "All fields are required!";
        exit();
    }

    // Prepared statement
    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();

    header("Location: index.php");
}
?>

<h2>Add New Post</h2>

<form method="POST">

Title:<br>
<input type="text" name="title" required>

<br><br>

Content:<br>
<textarea name="content" required></textarea>

<br><br>

<button type="submit" name="submit">Add Post</button>

</form>

<br>
<a href="index.php">Back</a>