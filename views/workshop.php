<header>
    <div class="centre">
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
    </div>
</header>

<div id="main">
    <div class="centre">
        <div id="user-slots">
            <i class="icon-spinner"></i>
        </div>

        <label id="request-assistance-btn" for="request-assistance-toggle"><i class="icon-add"></i><span>Request assistance</span></label>
        <input type="checkbox" id="request-assistance-toggle" class="checkbox-hack"/>

        <div id="request-assistance-modal">
            <div class="request-assistance-form-row">
                <label for="request-name">Name</label> <input type="text" id="request-name" tabindex="1" required/>
            </div>

            <div class="request-assistance-form-row">
                <label for="request-id">Kent ID</label> <input type="text" id="request-id" maxlength="5" tabindex="2" required/>
            </div>

            <div class="request-assistance-form-row">
                <label for="request-seat">Seat</label>
                <div id="request-map-wrapper">
                    <?= $map; ?>
                </div>
            </div>

            <div class="request-assistance-form-row">
                <div id="request-submit" tabindex="4"><i class="icon-add"></i>Request</div>
            </div>

            <i id="request-assistance-spinner" class="icon-spinner"></i>
        </div>

        <div id="map-modal">
            <i id="map-modal-spinner" class="icon-spinner"></i>
            <div id="map-modal-wrapper"></div>
        </div>
    </div>
</div>