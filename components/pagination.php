<div class="d-flex justify-content-end">
    <div>
        <ul class="pagination">
            <?php if ($page > 1) : ?>
                <li class="page-item" id="1">
                    <span class="page-link">First</span>
                </li>
            <?php endif; ?>

            <?php
            $max = max(1, $page - 2);
            $min = min($page + 3, $total_pages + 1);

            for (; $max < $min; $max++) :
                $active_page = $max == $page ? "active" : "";
            ?>
                <li class="page-item <?= $active_page ?>" id="<?= $max ?>">
                    <span class="page-link"><?= $max ?></span>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages) : ?>
                <?php $next = $page + 1; ?>
                <?php if ($total_pages - 2 > $page) : ?>
                    <li class="page-item"><span class="page-link">...</span></li>
                    <li class="page-item" id="<?= $total_pages ?>">
                        <span class="page-link"><?= $total_pages ?></span>
                    </li>
                <?php endif; ?>
                <li class="page-item" id="<?= $next ?>">
                    <span class="page-link">Next</span>
                </li>
            <?php else : ?>
                <li class="disabled"><span class="page-link">Next</span></li>
            <?php endif; ?>
        </ul>
    </div>
</div>