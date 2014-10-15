<?php if($_SERVER['SERVER_NAME'] == 'wq.dev'): ?>

    <?php if($isHome): ?>
        <script src="/js/home.js"></script>
    <?php endif; ?>

    <?php if($isWorkshop): ?>
        <script>
            var workshopId = <?= $workshopId; ?>;
        </script>
        <script src="/js/workshop.js"></script>
    <?php endif; ?>

<?php else: ?>

    <?php if($isHome): ?>
        <script src="/build/home.min.js"></script>
    <?php endif; ?>

    <?php if($isWorkshop): ?>
        <script>
            var workshopId = <?= $workshopId; ?>;
        </script>
        <script src="/build/workshop.min.js"></script>
    <?php endif; ?>

<?php endif; ?>