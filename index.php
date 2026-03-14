<?php
include "db.php";
?>

<h2>Posts</h2>

<a href="add_post.php">Add Post</a>

<br><br>

<table border="1">

<tr>
<th>ID</th>
<th>Title</th>
<th>Content</th>
<th>Action</th>
</tr>

<?php

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{

?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['content']; ?></td>

<td>

<a href="edit_post.php?id=<?php echo $row['id']; ?>">Edit</a>

<a href="delete_post.php?id=<?php echo $row['id']; ?>">Delete</a>

</td>

</tr>

<?php

}

?>

</table>