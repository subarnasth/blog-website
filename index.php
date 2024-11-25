<?php
include 'includes/db.php';
include 'includes/header.php';

// Fetch blog posts from the database
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<main>
    <h1>Welcome to My Blog</h1>
    <?php while ($row = $result->fetch_assoc()): ?>
        <article>
            <h2><a href="post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h2>
            <p><?php echo substr($row['content'], 0, 200) . '...'; ?></p>
            <a href="post.php?id=<?php echo $row['id']; ?>">Read More</a>
        </article>
    <?php endwhile; ?>
</main>

<?php
include 'includes/footer.php';
?>