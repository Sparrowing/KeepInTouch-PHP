<form action="newpost.php" method="POST">

    <?php if ($error != ""): ?>
        <p>
            <?= $error ?>
        </p>
    <?php endif; ?>

    <p>
        <label for="title">Title:<br/>
            <input type="text" name="title" value="<?= htmlspecialchars($titleValue) ?>" />
        </label>
    </p>

    <p>
        <label for="body">Body:<br/>
            <textarea name="body"><?= htmlspecialchars($bodyValue)?></textarea>
        </label>
    </p>

    <input type="submit" value="Post!" />

</form>
