<!--**********************************************************************************

                                     Pagination links

***********************************************************************************-->

<?php
    // $pagesCount and $currentPageIx must been already defined.

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

    <table id='pagination'>
        <!-- Row with the dots and arrows -->
        <tr>
            <?php if ($currentPageIx == 0) { ?>
            <td><a href='<?= $paginationLinkBase ?>p=0<?= $paginationLinkOption ?>' target='_self'><i class='fas fa-step-backward hidden'></i></a></td>
                <td><a href='#' target='_self'><i class='fas fa-caret-left hidden'></i></a></td>
            <?php } else { ?>
                <td><a href='<?= $paginationLinkBase ?>p=0<?= $paginationLinkOption ?>' target='_self'><i class='fas fa-step-backward'></i></a></td>
                <td><a href='<?= $paginationLinkBase ?>p=<?= ($currentPageIx - 1) ?><?= $paginationLinkOption ?>' target='_self'><i class='fas fa-caret-left'></i></a></td>
            <?php } ?>

            <?php $i = 0;
            while (($pagesOffset + $i) < $pagesCount && $i < $maxNbrOfPageLinks) {
                if (($pagesOffset + $i) == $currentPageIx) { ?>
                    <td><a href='<?= $paginationLinkBase ?>p=<?= ($pagesOffset + $i) ?><?= $paginationLinkOption ?>' target='_self' class='pageLink'><i class='fas fa-circle currentPage'></i></a></td>
            <?php   } else { ?>
                    <td><a href='<?= $paginationLinkBase ?>p=<?= ($pagesOffset + $i) ?><?= $paginationLinkOption ?>' target='_self' class='pageLink'><i class='fas fa-circle'></i></a></td>
            <?php   }
                $i++;
            } ?>

            <?php if ($currentPageIx == $pagesCount - 1) { ?>
                <td><a href='#' target='_self'><i class='fas fa-caret-right hidden'></i></a></td>
                <td><a href='<?= $paginationLinkBase ?>p=<?= ($pagesCount - 1) ?><?= $paginationLinkOption ?>' target='_self'><i class='fas fa-step-forward hidden'></i></a></td>
            <?php } else { ?>
                <td><a href='<?= $paginationLinkBase ?>p=<?= ($currentPageIx + 1) ?><?= $paginationLinkOption ?>' target='_self'><i class='fas fa-caret-right'></i></a></td>
                <td><a href='<?= $paginationLinkBase ?>p=<?= ($pagesCount - 1) ?><?= $paginationLinkOption ?>' target='_self'><i class='fas fa-step-forward'></i></a></td>
            <?php } ?>
        </tr>
        
        <!-- Row with the pages numbers -->
        <tr>
            <td></td>
            <td></td>
            
            <?php $i = 0;
            while (($pagesOffset + $i) < $pagesCount && $i < $maxNbrOfPageLinks) {
                if (($pagesOffset + $i) == $currentPageIx) { ?>
                    <td><a href='<?= $paginationLinkBase ?>p=<?= ($pagesOffset + $i) ?><?= $paginationLinkOption ?>' target='_self' class='pageLink'><?= ($pagesOffset + $i + 1) ?></a></td>
            <?php   } else { ?>
                    <td><a href='<?= $paginationLinkBase ?>p=<?= ($pagesOffset + $i) ?><?= $paginationLinkOption ?>' target='_self' class='pageLink'><?= ($pagesOffset + $i + 1) ?></a></td>
            <?php   }
                $i++;
            } ?>
            
            <td></td>
            <td></td>
        </tr>
    </table>

<?php } ?>