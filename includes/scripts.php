<?php if($isHome): ?>
    <script src="/js/home.js"></script>
<?php endif; ?>

<?php if($isWorkshop): ?>
    <script>
        var workshopId = <?= $workshopId; ?>;
    </script>
    <script src="/js/workshop.js"></script>
<?php endif; ?>