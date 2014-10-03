<header>
    <div class="centre">
        <img src="/img/logo.png" alt="Workshop Queue logo" id="header-img"/>
        <div id="header-info">
            <h1 id="header-title">Workshop Queue <sup>beta</sup></h1>
            <p>Workshop Queue is a tool to help students request assistance from the lecturer, assistants and demonstrators during workshops.</p>
            <p>Rather than waiting with your hand up trying to gain their attention, simply type in your name and select where you are sitting and Workshop Queue will add your name to a first-come first-serve queue.</p>
            <p>The queue will update automatically every 5 seconds so you can see when your turn is up next.</p>
        </div>
    </div>
</header>

<div id="main">
    <div class="centre">
        <h2>Which workshop are you in?</h2>

        <div id="workshop-cards">
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin']): ?>

                <a href="/new-workshop" class="workshop-card workshop-card--add">
                    <i class="icon-add"></i>
                </a>

            <?php endif; ?>

            <?php foreach($workshops as $workshop): ?>

                <a href="/workshop/<?= $workshop->workshopId; ?>" class="workshop-card">
                    <img src="/img/<?= $workshop->type; ?>.png" alt="<?= $workshop->type; ?>"/>
                    <span class="workshop-card-title"><?= $workshop->moduleCode; ?> <?= $workshop->moduleName; ?></span>
                    <span class="workshop-card-lecturer"><?= $workshop->lecturer; ?></span>
                    <span class="workshop-card-date"><?= $workshop->date; ?></span>
                    <span class="workshop-card-room"><?= $workshop->room; ?></span>
                </a>

            <?php endforeach; ?>
        </div>
    </div>
</div>