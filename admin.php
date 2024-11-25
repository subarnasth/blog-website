<?php
include 'includes/db.php';
include 'includes/header.php';

// Check if the user is submitting a new post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Insert the new post into the database
    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "New post added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<main>
    <h1>Add a New Post</h1>
    <form action="admin.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label for="content">Content:</label><br>
        <textarea name="content" required></textarea><br><br>

        <button type="submit">Publish</button>
    </form>
</main>

<?php
include 'includes/footer.php';
?>