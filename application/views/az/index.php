<h2>
    <?php if (!$letter): ?>
    <?= $title ?>
    <?php else : ?>
    <a href="/a-z"><?= $title ?></a>
    <small>(showing <?= ucfirst($letter) ?>)</small>
    <?php endif; ?>
</h2>