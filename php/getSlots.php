<?php

session_start();

$workshopId = $_POST['workshopId'];

require_once('Workshop.php');
$slots = Workshop::getSlots($workshopId);

foreach($slots as $slot) {
    echo $slot->seat . ',';
}

echo '~';

$i = 1;

foreach($slots as $slot) {
    echo '<div class="user-slot" data-slotid="' . $slot->slotId . '" data-seat="' . $slot->seat . '">
              <span class="user-order">' . $i . '</span>
              <span class="user-info"><span class="user-name">' . $slot->name . '</span> <span class="user-id">' . $slot->kentId . '</span> <span class="user-seat">' . $slot->seat . '</span></span>';
    if($slot->slotId == $_SESSION['mySlotId'] || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
        echo '<span class="user-cancel"><i class="icon-cancel"></i></span>';
    }
    echo '</div>';

    $i++;
}