<header class="centre">
    <img src="/img/<?= $workshop->type; ?>.png" alt="<?= $workshop->type; ?>" id="header-img"/>
    <div id="header-info">
        <h1 id="header-title"><?= $workshop->module; ?></h1>
        <div class="full-width">
            <p id="workshop-lecturer"><?= $workshop->lecturer; ?></p>
            <p id="workshop-date"><?= $workshop->date; ?></p>
        </div>
        <div class="full-width">
            <p id="workshop-room"><i class="icon-pc"></i> <?= $workshop->room; ?></p>
            <p id="workshop-users"><i class="icon-user"></i> <?= count($slots); ?></p>
            <p id="workshop-time"><i class="icon-time"></i> <?= $workshop->time; ?> mins</p>
        </div>
    </div>
</header>

<div id="main" class="centre">

    <?php if(empty($slots)): ?>
        <h2>There is currently no one in need of assistance.</h2>
    <?php endif; ?>

    <?php $i = 1; foreach($slots as $slot): ?>

        <div class="user-slot user-slot--me">
            <span class="user-order"><?= $i; ?></span>
            <span class="user-cancel"><i class="icon-cancel"></i></span>
            <span class="user-name"><?= $slot->name; ?> <span class="user-id"><?= $slot->kentId; ?></span></span>
            <label class="user-map-btn" for="user-slot-toggle--<?= $i; ?>"><i class="icon-map"></i></label>
            <input type="checkbox" id="user-slot-toggle--<?= $i; ?>" class="checkbox-hack"/>
            <img src="/img/seat-plan.jpg" class="user-map" title="<?= $slot->location; ?>"/>
        </div>

    <?php $i++; endforeach; ?>

    <label id="request-assistance-btn" for="request-assistance-toggle"><i class="icon-add"></i><span>Request assistance</span></label>
    <input type="checkbox" id="request-assistance-toggle" class="checkbox-hack"/>

    <div id="request-assistance-modal">
        <form>
            <div class="request-assistance-form-row">
                <label for="request-name">name</label> <input type="text" id="request-name" required/>
            </div>

            <div class="request-assistance-form-row">
                <label for="request-id">kent ID</label> <input type="text" id="request-id" required/>
            </div>

            <div class="request-assistance-form-row">
                <label for="request-seat">seat</label> <img src="/img/seat-plan.jpg"/>
            </div>

            <div class="request-assistance-form-row">
                <i class="icon-add"></i><input type="submit" value="done"/>
            </div>
        </form>
    </div>
</div>