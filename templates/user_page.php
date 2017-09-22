<h3 class="text-muted">Home of <?= $username ?></h3>

<?php if ($posts == false): ?>
    <p>No posts yet!</p>
<?php else: ?>

    <ul class="list-group">

        <?php foreach ($posts as $post): ?>

            <li class="list-group-item">
                <div class="post-holder">

                    <h3><?= $post->getTitle() ?>
                        <br />
                        <small><?= $post->getTimestamp() ?></small>
                    </h3>
                    <p class="post-body"><?= $post->getBody() ?>

                </div>
            </li>

        <?php endforeach; ?>

    </ul>
<?php endif; ?>
