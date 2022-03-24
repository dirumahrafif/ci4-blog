<?php
foreach ($record as $key => $value) {
?>
    <div class="post-preview">
        <a href="<?php echo set_post_link($value['post_id']) ?>">
            <h2 class="post-title">
                <?php echo $value['post_title'] ?>
            </h2>
            <?php if ($value['post_description']) { ?>
                <h3 class="post-subtitle">
                    <?php echo $value['post_description'] ?>
                </h3>
            <?php } ?>
        </a>
        <p class="post-meta">
            Posted by
            <a href="#!"><?php echo post_penulis($value['username']) ?></a>
            on <?php echo tanggal_indonesia($value['post_time']) ?>
        </p>
    </div>
    <!-- Divider-->
    <hr class="my-4" />
<?php } ?>
<?php echo $pager->simpleLinks('ft', 'depan') ?>