<!--**********************************************************************************

                                     Pagination links

***********************************************************************************-->

<?php
    // $pagesCount, $currentPageIx, $paginationLinkBase, $pageGETparameter and $paginationLinkOption must been already defined.

    $maxNbrOfPageLinks = 11;
    $pagesOffset = 0;
    
    // Calculation of the $pagesOffset.
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

    <table class='pagination'>
        <!-- Row with the dots and arrows -->
        <tr>
            <?php if ($currentPageIx == 0) { ?>
            <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=0<?= $paginationLinkOption ?>' target='_self'><span class='fas fa-step-backward hidden'></span></a></td>
                <td><a href='#' target='_self'><span class='fas fa-caret-left hidden'></span></a></td>
            <?php } else { ?>
                <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=0<?= $paginationLinkOption ?>' target='_self'><span class='fas fa-step-backward'></span></a></td>
                <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=<?= ($currentPageIx - 1) ?><?= $paginationLinkOption ?>' target='_self'><span class='fas fa-caret-left'></span></a></td>
            <?php } ?>

            <?php $i = 0;
            while (($pagesOffset + $i) < $pagesCount && $i < $maxNbrOfPageLinks) {
                if (($pagesOffset + $i) == $currentPageIx) { ?>
                    <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=<?= ($pagesOffset + $i) ?><?= $paginationLinkOption ?>' target='_self' class='pageLink'><span class='fas fa-circle currentPage'></span></a></td>
            <?php   } else { ?>
                    <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=<?= ($pagesOffset + $i) ?><?= $paginationLinkOption ?>' target='_self' class='pageLink'><span class='fas fa-circle'></span></a></td>
            <?php   }
                $i++;
            } ?>

            <?php if ($currentPageIx == $pagesCount - 1) { ?>
                <td><a href='#' target='_self'><span class='fas fa-caret-right hidden'></span></a></td>
                <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=<?= ($pagesCount - 1) ?><?= $paginationLinkOption ?>' target='_self'><span class='fas fa-step-forward hidden'></span></a></td>
            <?php } else { ?>
                <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=<?= ($currentPageIx + 1) ?><?= $paginationLinkOption ?>' target='_self'><span class='fas fa-caret-right'></span></a></td>
                <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=<?= ($pagesCount - 1) ?><?= $paginationLinkOption ?>' target='_self'><span class='fas fa-step-forward'></span></a></td>
            <?php } ?>
        </tr>
        
        <!-- Row with the pages numbers -->
        <tr>
            <td></td>
            <td></td>
            
            <?php $i = 0;
            while (($pagesOffset + $i) < $pagesCount && $i < $maxNbrOfPageLinks) {
                if (($pagesOffset + $i) == $currentPageIx) { ?>
                    <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=<?= ($pagesOffset + $i) ?><?= $paginationLinkOption ?>' target='_self' class='pageLink'><?= ($pagesOffset + $i + 1) ?></a></td>
            <?php   } else { ?>
                    <td><a href='<?= $paginationLinkBase ?><?= $pageGETparameter ?>=<?= ($pagesOffset + $i) ?><?= $paginationLinkOption ?>' target='_self' class='pageLink'><?= ($pagesOffset + $i + 1) ?></a></td>
            <?php   }
                $i++;
            } ?>
            
            <td></td>
            <td></td>
        </tr>
    </table>

<?php } ?>