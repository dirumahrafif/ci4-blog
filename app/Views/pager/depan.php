<?php
$pager->setSurroundCount(0)
// 
?>
<div class="row">
    <div class="col-lg-6 d-flex justify-content-start mb-4">
        <?php if ($pager->hasPrevious()) { ?>
            <a class="btn btn-primary text-uppercase" href="<?php echo $pager->getPrevious() ?>">&lsaquo; Newer Posts</a>
        <?php } ?>
    </div>
    <div class="col-lg-6 d-flex justify-content-end mb-4">
        <?php if ($pager->hasNext()) { ?>
            <a class="btn btn-primary text-uppercase" href="<?php echo $pager->getNext() ?>">Older Posts &rsaquo;</a>
        <?php } ?>
    </div>
</div>