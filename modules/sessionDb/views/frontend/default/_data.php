<?php

/* @var $data array */
$i = 0;
?>
<?php if (!empty($data)) : ?>
    <?php foreach ($data as $key => $value) : ?>
        <?php if ($key == '__flash') : ?>
            <?php continue; ?>
        <?php endif; ?>
        <div class="wrap wrap-<?= $i++ ?>">
            <strong><?= $key ?>
                <button class="removeSession" data-key="<?= $key ?>"><i class="glyphicon-trash glyphicon"></i></button>
            </strong>
            <?= '<pre>'; ?>
            <?php var_dump($value); ?>
            <?= '</pre>'; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
