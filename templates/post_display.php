<div class="post-holder">

    <h2 class="text-left">
        <a href="<?= $post->getUrl() ?>">
            <b><?= $post->getTitle() ?></b>
        </a> -
        <small>
            <a href="userhome.php?u=<?= $post->getPostUser()->getId() ?>">
                <?= $post->getPostUser()->getUsername() ?>
            </a>
        </small>

        <br />

        <small class="text-muted">
            <i><?= $post->getTimestamp() ?></i>
        </small>

    </h2>

    <hr>

    <p class="post-body text-justify"><?= $post->getBody() ?></p>

</div>
