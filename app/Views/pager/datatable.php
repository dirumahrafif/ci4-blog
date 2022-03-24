<nav class="dataTable-pagination">
    <ul class="dataTable-pagination-list">
        <!-- <li class="active"><a href="#" data-page="1">1</a></li>
        <li class=""><a href="#" data-page="2">2</a></li>
        <li class=""><a href="#" data-page="3">3</a></li>
        <li class=""><a href="#" data-page="4">4</a></li>
        <li class=""><a href="#" data-page="5">5</a></li>
        <li class=""><a href="#" data-page="6">6</a></li>
        <li class="pager"><a href="#" data-page="2">›</a></li> -->
        <?php
        foreach ($pager->links() as $link) {
            $activeclass = $link['active'] ? 'active' : '';
        ?>
            <li class="<?php echo $activeclass ?>">
                <a href='<?php echo $link['uri'] ?>'><?php echo $link['title'] ?></a>
            </li>
        <?php
        }
        ?>
    </ul>
</nav>