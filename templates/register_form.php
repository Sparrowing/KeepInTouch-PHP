<form action="register.php" method="post">

    <?php if ($error !== ""): ?>
        <p>
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif ?>

    <p>
        <label for="username">Username:
            <input type="text" name="username" value="<?= htmlspecialchars($usernameValue) ?>" />
        </label>
    </p>

    <p>
        <label for="password">Password:
            <input type="password" name="password" />
        </label>
    </p>

    <p>
        <label for="confirm">Confirm Password:
            <input type="password" name="confirm" />
        </label>
    </p>

    <input type="submit" value="Register!" />

</form>
