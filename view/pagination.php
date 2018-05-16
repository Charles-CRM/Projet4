<?php
    // $pagesCount and $currentPageIx must been already defined.

    $maxNbrOfPageLinks = 11;
    $pagesOffset = 0;

    if ($pagesCount > $maxNbrOfPageLinks) {
        if ($currentPageIx <  ceil($maxNbrOfPageLinks / 2)) {
            $pagesOffset = 0;
        } else if ($currentPageIx >=  floor($pagesCount - ($maxNbrOfPageLinks / 2))) {
            $pagesOffset = $pagesCount - $maxNbrOfPageLinks;
        } else {
            $pagesOffset = $currentPageIx - floor($maxNbrOfPageLinks / 2);
        }
    }


    if ($pagesCount > 1) {
?>

    <div id='pagination'>

        <?php if ($currentPageIx == 0) { ?>
            <a href='./?p=0' target='_self'><i class='fas fa-step-backward hidden'></i></a>
            <a href='#' target='_self'><i class='fas fa-caret-left hidden'></i></a>
        <?php } else { ?>
            <a href='./?p=0' target='_self'><i class='fas fa-step-backward'></i></a>
            <a href='./?p=<?= ($currentPageIx - 1) ?>' target='_self'><i class='fas fa-caret-left'></i></a>
        <?php } ?>

        <?php $i = 0;
        while (($pagesOffset + $i) < $pagesCount && $i < $maxNbrOfPageLinks) {
            if (($pagesOffset + $i) == $currentPageIx) { ?>
                <a href='./?p=<?= ($pagesOffset + $i) ?>' target='_self' class='pageLink'><i class='fas fa-circle currentPage'></i><span><?= ($pagesOffset + $i + 1) ?></span></a>
        <?php   } else { ?>
                <a href='./?p=<?= ($pagesOffset + $i) ?>' target='_self' class='pageLink'><i class='fas fa-circle'></i><span><?= ($pagesOffset + $i + 1) ?></span></a>
        <?php   }
            $i++;
        } ?>

        <?php if ($currentPageIx == $pagesCount - 1) { ?>
            <a href='#' target='_self'><i class='fas fa-caret-right hidden'></i></a>
            <a href='./?p=<?= ($pagesCount - 1) ?>' target='_self'><i class='fas fa-step-forward hidden'></i></a>
        <?php } else { ?>
            <a href='./?p=<?= ($currentPageIx + 1) ?>' target='_self'><i class='fas fa-caret-right'></i></a>
            <a href='./?p=<?= ($pagesCount - 1) ?>' target='_self'><i class='fas fa-step-forward'></i></a>
        <?php } ?>

    </div>

<?php } ?>