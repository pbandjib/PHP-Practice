<?php
$user = '<script>window.location.replace("https://youtube.com")</script>';
?>

<?php include './templates/header.php'; ?>
    <?php if($user): ?>
        <p><?= htmlspecialchars($user) ?></p>
        <p>This user is logged in!!</p>
    <?php endif;?>
    <h2>Cats</h2>
        <ul>
            <?php foreach($cats as $cat): ?>
            <li>Name: <?= esc($cat['name']) ?></li>
            <li>Age: <?= esc($cat['age']) ?></li>
            <li>ID: <?= esc($cat['id']) ?></li>
            <?php if($cat['owner_id']): ?>
                <li>Owner ID: <?= esc($cat['owner_id'])?></li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>

    <h2>Add Cat</h2>
    <form method="POST">
        <label>Name</label>
        <input type="text" name="name" />
        <label>Age</label>
        <input type="number" name="age" />
        <label>Owner ID</label>
        <input type="number" name="owner_id" />
        <button type="submit">Submit</button>

    </form>

<?php include './templates/footer.php'; ?>

