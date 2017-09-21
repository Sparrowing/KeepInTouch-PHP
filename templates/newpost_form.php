<div class="row">

    <div class="col-sm-offset-4 col-sm-4">

        <form class="form-horizontal" action="newpost.php" method="POST">

            <?php if ($error != ""): ?>
                <p class="bg-danger">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>

            <div class="form-group text-left">
                <label for="title">Title:</label>
                <input class="form-control" type="text" name="title" value="<?= htmlspecialchars($titleValue) ?>" placeholder="Post Title" />
            </div>

            <div class="form-group text-left">
                <label for="body">Body:</label>
                <textarea class="form-control" name="body" placeholder="Type Post Body Here"><?= htmlspecialchars($bodyValue) ?></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">Post!</button>
            </div>

        </form>

        <p class="text-muted">
            <a href="userhome.php">My Page</a>
        </p>

    </div>

</div>
