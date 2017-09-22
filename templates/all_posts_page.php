<h3 class="text-muted">All Posts</h3>

<?php if ($posts == false): ?>
    <p>No posts yet!</p>
<?php else: ?>

    <ul class="list-group">

        <?php foreach ($posts as $post): ?>

            <li class="list-group-item">
                <div class="post-holder">

                    <h3 class="text-left">
                        <a href="<?= $post->getUrl() ?>"><b><?= $post->getTitle() ?></b></a>
                        <small class="text-muted">-
                            <a href="userhome.php?u=<?= $post->getUserId() ?>">
                                <?= $post->getPostUser()->getUsername() ?>
                            </a>
                        </small>
                        <br />
                        <small class="text-muted"><i><?= $post->getTimestamp() ?></i></small>
                    </h3>
                    <p class="post-body text-justify"><?= $post->getBody() ?></p>

                </div>
            </li>

        <?php endforeach; ?>

    </ul>
<?php endif; ?>
