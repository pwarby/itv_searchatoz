<ol class="media-list">
<?php foreach ($programmes as $programme): ?>
    <li class="media">
        <?php if ($programme->getUri()) : ?>
        <a href ="<?= $programme->getUri() ?>">
        <?php else : ?>
        <div class="muted">
        <?php endif ?>
        <? if ($programme->getImage()) : ?>
            <img class="pull-left" src="<?= $programme->getImage() ?>" />
        <? endif ?>
            <div class="media-body">
                <h3 class="media-heading"><?= $programme->getTitle() ?></h3>
            <? if ($programme->getShortSynopsis()) : ?>
                <p><?= $programme->getShortSynopsis() ?></p>
            <? endif ?>
            </div>
        <?php if ($programme->getUri()) : ?>
        </a>
        <?php else : ?>
        </div>
        <?php endif ?>
    </li>
<?php endforeach ?>
</ol>