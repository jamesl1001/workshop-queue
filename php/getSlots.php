<?php

session_start();

$workshopId = $_POST['workshopId'];

require_once('Workshop.php');
$slots = Workshop::getWorkshopSlots($workshopId);

$i = 1;

foreach($slots as $slot) {
    echo '<div class="user-slot" data-slotid="' . $slot->slotId . '" data-location="' . $slot->location . '">
              <span class="user-order">' . $i . '</span>
              <span class="user-name">' . $slot->name . ' <span class="user-id">' . $slot->kentId . '</span></span>';
    if($slot->slotId == $_SESSION['mySlotId']) {
        echo '<span class="user-cancel"><i class="icon-cancel"></i></span>';
    }
    echo '</div>';

    $i++;
}