<div class="post-holder">

    <h2><?= $post->getTitle() ?>
        <h4>
            <a href="userhome.php?u=<?= $post->getPostUser()->getId() ?>">
                <?= $post->getPostUser()->getUsername() ?>
            </a>
        </h4>
        <small class="text-muted">
            <?= $post->getTimestamp() ?>
        </small>
    </h2>

    <hr>

    <p class="post-body"><?= $post->getBody() ?></p>

</div>
