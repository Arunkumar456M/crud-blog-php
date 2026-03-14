<?php
include "db.php";

$id = $_GET['id'];

/* Fetch post safely */
$stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

/* Update post */
if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    if(empty($title) || empty($content)){
        echo "All fields are required!";
        exit();
    }

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();

    header("Location: index.php");
}
?>

<h2>Edit Post</h2>

<form method="POST">

Title:<br>
<input type="text" name="title" value="<?php echo $row['title']; ?>" required>

<br><br>

Content:<br>
<textarea name="content" required><?php echo $row['content']; ?></textarea>

<br><br>

<button name="update">Update Post</button>

</form>

<br>
<a href="index.php">Back</a>