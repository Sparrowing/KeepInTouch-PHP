<h2><?= $username ?></h2>
<?php foreach($posts as $post): ?>
    <h3><?= $post->getTitle() ?></h3>
    <h4><?= $post->getTimestamp() ?></h4>
    <p><?= $post->getBody() ?></p>
<?php endforeach ?>
<p>Page coming soon!</p>
