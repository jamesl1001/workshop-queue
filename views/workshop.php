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
            <p id="workshop-users"><i class="icon-user"></i> <span id="workshop-slot-count"><?= count($slots); ?></span></p>
            <p id="workshop-time"><i class="icon-time"></i> <?= $workshop->time; ?> mins</p>
        </div>
    </div>
    <a href="/" id="exit-btn" title="Exit"><i class="icon-exit"></i></a>
</header>

<div id="main" class="centre">

    <div id="user-slots"></div>

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
                <label for="request-seat">seat</label> <img src="/img/room-<?= $workshop->room; ?>.png"/>
            </div>

            <div class="request-assistance-form-row">
                <i class="icon-add"></i><input type="submit" value="done" id="request-submit"/>
            </div>
        </form>
    </div>

    <div id="map-modal">
        <h2><?= $workshop->room; ?></h2>
        <img src="/img/room-<?= $workshop->room; ?>.png" title="<?= $workshop->room; ?>"/>
        <div id="map-modal-marker"></div>
    </div>
</div>