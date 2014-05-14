// Init
var main                    = document.getElementById('main');
var workshopSlotCount       = document.getElementById('workshop-slot-count');
var userSlotsWrapper        = document.getElementById('user-slots');
var requestAssistanceSubmit = document.getElementById('request-submit');
var requestAssistanceToggle = document.getElementById('request-assistance-toggle');
var mapModal                = document.getElementById('map-modal');
var mapModalWrapper         = document.getElementById('map-modal-wrapper');

getSlots();

// Poll for slot changes
var i = 1;

setInterval(function() {
    console.log('Polling... [' + i + ']');
    getSlots();
    i++;
}, 5000);

// Listeners
userSlotsWrapper.addEventListener('click', function(e) {
    if(e.target.className == 'user-name') {
        showMap(e.target.parentElement.getAttribute('data-seat'));
    }

    if(e.target.className == 'user-id') {
        showMap(e.target.parentElement.parentElement.getAttribute('data-seat'));
    }

    if(e.target.className == 'user-cancel') {
        cancelSlot(e.target.parentElement.getAttribute('data-slotid'));
    }

    if(e.target.className == 'icon-cancel') {
        cancelSlot(e.target.parentElement.parentElement.getAttribute('data-slotid'));
    }
});

requestAssistanceSubmit.addEventListener('click', requestAssistance);

mapModal.addEventListener('click', hideMap);

// Events
function getSlots() {
    var data = 'workshopId=' + workshopId;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/getSlots.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if(response) {
                userSlotsWrapper.innerHTML = response;
                var slotCount = document.getElementsByClassName('user-slot').length;
                workshopSlotCount.innerHTML = slotCount;
            } else {
                userSlotsWrapper.innerHTML = '<h2>There is currently no one in need of assistance.</h2>';
            }
        }
    }
}

function showMap(seat) {
    var seatSplit = seat.split('-');

    var data = 'room=' + seatSplit[0] + '&seat=' + seatSplit[1];
    var x = new XMLHttpRequest();
    x.open('POST', '/php/getSeatMap.php', true);
    x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    x.send(data);
    x.onreadystatechange = function() {
        if(x.readyState == 4 && x.status == 200) {
            var response = x.responseText;
            mapModalWrapper.innerHTML = response;
            mapModal.className = 'map-modal--show';
        }
    }
}

function hideMap() {
    mapModal.className = mapModal.className.replace('map-modal--show', '');
}

function cancelSlot(slotId) {
    var choice = confirm('Are you sure you would like to cancel your request?');

    if(choice) {
        var data = 'slotId=' + slotId;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/cancelSlot.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                getSlots();
            }
        }

        request.onerror = function() {
            alert('Something went wrong. Please try again.');
        }
    }
}

function requestAssistance() {
    var requestName   = document.getElementById('request-name').value;
    var requestKentId = document.getElementById('request-id').value;
    var requestSeat;

    var requestSeats = document.getElementsByName('seat');
    for(var i = 0, l = requestSeats.length; i < l; i++) {
        if(requestSeats[i].checked) {
            requestSeat = requestSeats[i].value;
        }
    }

    if(requestName && requestKentId && requestSeat) {
        var data = 'workshopId=' + workshopId + '&requestName=' + requestName + '&requestKentId=' + requestKentId + '&requestSeat=' + requestSeat;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/requestAssistance.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                getSlots();
                requestAssistanceToggle.checked = false;
                window.scrollTo(0,0);
            }
        }

        request.onerror = function() {
            alert('Something went wrong. Please try again.');
        }
    } else {
        alert('All fields are required.');
    }
}