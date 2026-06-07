<?php
/**
 * Hero block dùng chung — truyền $hero_kicker, $hero_title, $hero_desc (tùy chọn $hero_modifier class).
 */
$hero_kicker = $hero_kicker ?? '';
$hero_title = $hero_title ?? '';
$hero_desc = $hero_desc ?? '';
$hero_modifier = $hero_modifier ?? '';
?>
<section class="coffee-page-hero <?= htmlspecialchars($hero_modifier, ENT_QUOTES, 'UTF-8') ?>">
    <div class="container">
        <div class="coffee-page-hero__inner">
            <?php if ($hero_kicker !== '') { ?>
            <span class="coffee-page-hero__kicker"><?= htmlspecialchars($hero_kicker, ENT_QUOTES, 'UTF-8') ?></span>
            <?php } ?>
            <?php if ($hero_title !== '') { ?>
            <h1><?= htmlspecialchars($hero_title, ENT_QUOTES, 'UTF-8') ?></h1>
            <?php } ?>
            <?php if ($hero_desc !== '') { ?>
            <p><?= htmlspecialchars($hero_desc, ENT_QUOTES, 'UTF-8') ?></p>
            <?php } ?>
        </div>
    </div>
</section>
