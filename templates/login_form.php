<form action="login.php" method="POST">

    <?php if ($error != ""): ?>
        <p>
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

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

    <input type="submit" value="Log In" />

</form>

<p><a href="register.php">Register</a></p>
