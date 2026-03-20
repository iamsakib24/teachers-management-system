<?php
session_start();
if($_SESSION['role'] != 'admin'){
    die("Access denied");
}
include "db.php";

$result = $conn->query("SELECT * FROM messages ORDER BY id DESC");
?>

<h2>Admin Panel - Chat History</h2>
<a href="index.php">Back to Chat</a><br><br>

<table border="1" cellpadding="10">
<tr><th>User ID</th><th>Message</th><th>Response</th><th>Date</th></tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['user_id'] ?></td>
<td><?= $row['message'] ?></td>
<td><?= $row['response'] ?></td>
<td><?= $row['created_at'] ?></td>
</tr>
<?php endwhile; ?>
</table>
