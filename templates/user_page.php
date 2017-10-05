<h3 class="text-muted">Home of <?= $username ?></h3>

<?php if ($posts == false): ?>
    <p>No posts yet!</p>
<?php else: ?>

    <ul class="list-group">

        <?php foreach ($posts as $post): ?>

            <li class="list-group-item">
                <div class="post-holder">

                    <h3 class="text-left">
                        <table>
                            <td>
                                <a href="<?= $post->getUrl() ?>"><b><?= $post->getTitle() ?></b></a>
                            </td>

                            <?php if ($isHomePage): ?>
                                <td>
                                    <form action="delete.php" method="POST" onsubmit="return confirm('Delete this post?');">
                                        <button class="btn btn-danger btn-xs del-btn" type="submit" name="id" value="<?= $post->getId() ?>">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </table>

                        <small class="text-muted"><i><?= $post->getTimestamp() ?></i></small>
                    </h3>
                    <p class="post-body text-justify"><?= $post->getBody() ?>

                </div>
            </li>

        <?php endforeach; ?>

    </ul>
<?php endif; ?>
