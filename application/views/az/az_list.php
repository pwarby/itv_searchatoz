<ol class="az unstyled inline">
<?php foreach ($azlist as $index): ?>
    <li>
        <?php if ($letter === $index): ?>
        <a class="muted"><?= $index ?></a>
        <?php else: ?>
        <a href="/a-z/<?= $index ?>"><?= $index ?></a>
        <?php endif ?>
    </li>
<?php endforeach ?>
</ol>