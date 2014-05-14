<header>
    <div class="centre">
        <img src="/img/logo.png" alt="Workshop Queue logo" id="header-img"/>
        <div id="header-info">
            <h1 id="header-title">Workshop Queue <sup>beta</sup></h1>
            <p>Explain what WQ is here...</p>
        </div>
    </div>
</header>

<div id="main">
    <div class="centre">
        <h2>Which workshop are you in?</h2>

        <div id="workshop-cards">
            <?php foreach($workshops as $workshop): ?>

                <a href="/workshop/<?= $workshop->workshopId; ?>" class="workshop-card">
                    <img src="/img/<?= $workshop->type; ?>.png" alt="<?= $workshop->type; ?>"/>
                    <span class="workshop-card-title"><?= $workshop->module; ?></span>
                    <span class="workshop-card-lecturer"><?= $workshop->lecturer; ?></span>
                    <span class="workshop-card-date"><?= $workshop->date; ?></span>
                    <span class="workshop-card-room"><?= $workshop->room; ?></span>
                </a>

            <?php endforeach; ?>
        </div>
    </div>
</div>