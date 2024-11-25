<?php
include 'includes/db.php';
include 'includes/header.php';

$post_id = $_GET['id']; // Get the post ID from the URL

// Fetch the post details from the database
$sql = "SELECT * FROM posts WHERE id = $post_id";
$post_result = $conn->query($sql);
$post = $post_result->fetch_assoc();

// Fetch comments for the post
$comment_sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC";
$comment_result = $conn->query($comment_sql);
?>

<main>
    <h1><?php echo $post['title']; ?></h1>
    <p><?php echo $post['content']; ?></p>

    <h2>Comments</h2>
    <?php while ($comment = $comment_result->fetch_assoc()): ?>
        <div class="comment">
            <p><strong><?php echo $comment['user_name']; ?></strong></p>
            <p><?php echo $comment['comment']; ?></p>
        </div>
    <?php endwhile; ?>

    <h3>Leave a Comment</h3>
    <form action="post.php?id=<?php echo $post_id; ?>" method="POST">
        <input type="text" name="user_name" placeholder="Your Name" required><br>
        <textarea name="comment" placeholder="Your Comment" required></textarea><br>
        <button type="submit">Submit</button>
    </form>
</main>

<?php
// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $comment = $_POST['comment'];

    $insert_sql = "INSERT INTO comments (post_id, user_name, comment) VALUES ('$post_id', '$user_name', '$comment')";
    if ($conn->query($insert_sql) === TRUE) {
        echo "Comment submitted successfully!";
        header("Location: post.php?id=$post_id"); // Redirect to refresh the page
    } else {
        echo "Error submitting comment: " . $conn->error;
    }
}

include 'includes/footer.php';
?>