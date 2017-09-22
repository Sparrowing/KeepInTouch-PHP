<div class="row">

    <div class="col-sm-offset-4 col-sm-4">

        <form class="form-horizontal" action="login.php" method="POST">

            <?php if ($error != ""): ?>
                <p class="bg-danger">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>

            <div class="form-group text-left">
                <label for="username">Username:</label>
                <input class="form-control" type="text" name="username" value="<?= $usernameValue ?>" placeholder="KeepInTouch Username" />
            </div>

            <div class="form-group text-left">
                <label for="password">Password:</label>
                <input class="form-control" type="password" name="password" placeholder="KeepInTouch Password" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">Log In!</button>
            </div>

        </form>

        <p class="text-muted">
            <a href="register.php">Register</a>
        </p>

    </div>

</div>
