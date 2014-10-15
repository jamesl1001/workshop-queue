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

    <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create','UA-28297381-3','auto');ga('send','pageview');</script>

<?php endif; ?>