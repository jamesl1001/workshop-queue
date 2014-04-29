<?php

$workshopId = $_POST['workshopId'];

require_once('Workshop.php');
$slots = Workshop::getWorkshopSlots($workshopId);

$i = 1;

foreach($slots as $slot) {
    echo '<div class="user-slot">
              <span class="user-order">' . $i . '</span>
              <span class="user-name">' . $slot->name . ' <span class="user-id">' . $slot->kentId . '</span></span>
              <span class="user-cancel"><i class="icon-cancel"></i></span>
              <label class="user-map-btn" for="user-slot-toggle--' . $i . '"></label>
              <input type="checkbox" id="user-slot-toggle--' . $i . '" class="checkbox-hack"/>
              <img src="/img/seat-plan.jpg" class="user-map" title="' . $slot->location . '"/>
          </div>';

    $i++;
}