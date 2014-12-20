// Init
var data                    = 'workshopId=' + workshopId;
var main                    = document.getElementById('main');
var workshopSlotCount       = document.getElementById('workshop-slot-count');
var userSlotsWrapper        = document.getElementById('user-slots');
var requestAssistanceModal  = document.getElementById('request-assistance-modal');
var requestAssistanceSubmit = document.getElementById('request-submit');
var requestAssistanceToggle = document.getElementById('request-assistance-toggle');
var mapModal                = document.getElementById('map-modal');
var mapModalWrapper         = document.getElementById('map-modal-wrapper');
var radios                  = document.getElementsByClassName('cell-radio');

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
    if(e.target.className == 'user-info') {
        showMap(e.target.parentElement.getAttribute('data-seat'));
    }

    if(e.target.className.match('user-name|user-seat')) {
        showMap(e.target.parentElement.parentElement.getAttribute('data-seat'));
    }

    if(e.target.className == 'user-assisting') {
        assistSlot(e.target.parentElement.getAttribute('data-slotid'));
    }

    if(e.target.className == 'icon-assisting') {
        assistSlot(e.target.parentElement.parentElement.getAttribute('data-slotid'));
    }

    if(e.target.className == 'user-cancel') {
        cancelSlot(e.target.parentElement.getAttribute('data-slotid'));
    }

    if(e.target.className == 'icon-cancel') {
        cancelSlot(e.target.parentElement.parentElement.getAttribute('data-slotid'));
    }
});

requestAssistanceSubmit.addEventListener('click', requestAssistance);

document.addEventListener('keydown', function(e) {
    if(e.which == 13 && requestAssistanceToggle.checked == true) {
        requestAssistance();
    }
});

mapModal.addEventListener('click', hideMap);

document.addEventListener('keydown', function(e) {
    if(e.which == 27) {
        hideMap();
    }
});

window.addEventListener('hashchange', hashChange);

// Events
function getSlots() {
    var request = new XMLHttpRequest();
    request.open('POST', '/php/getSlots.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if(response) {
                var responseSplit = response.split('~');
                var seats = responseSplit[0].split(',');

                for(var i = 0, l = radios.length; i < l; i++) {
                    var radio = document.getElementById(radios[i].id);

                    if(seats.indexOf(radios[i].id) !== -1) {
                        radio.disabled = true;
                    } else {
                        radio.disabled = false;
                    }
                }

                userSlotsWrapper.innerHTML = responseSplit[1];
                var slotCount = document.getElementsByClassName('user-slot').length;
                workshopSlotCount.innerHTML = slotCount;
            } else {
                userSlotsWrapper.innerHTML = '<h2>There is currently no one in need of assistance.</h2>';
            }
        }
    }
}

function showMap(seat) {
    mapModal.className = 'map-modal--show';
    location.hash      = 'map';
    var seatSplit      = seat.split('-');

    var data = 'room=' + seatSplit[0] + '&seat=' + seatSplit[1];
    var x = new XMLHttpRequest();
    x.open('POST', '/php/getSeatMap.php', true);
    x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    x.send(data);
    x.onreadystatechange = function() {
        if(x.readyState == 4 && x.status == 200) {
            var response = x.responseText;
            mapModalWrapper.innerHTML = response;
            mapModal.className += ' map-modal--done';
        }
    }
}

function hideMap() {
    mapModal.className = mapModal.className.replace('map-modal--show', '');
    location.hash      = '';
}

function hashChange() {
    if(location.hash == '') {
        hideMap();
    }
}

function assistSlot(slotId) {
    var data = 'slotId=' + slotId;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/assistSlot.php', true);
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

function cancelSlot(slotId) {
    var choice = confirm('Are you sure you would like to cancel your request?');

    if(choice) {
        var data = 'slotId=' + slotId;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/cancelSlot.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.setRequestHeader('X-Csrf-workshop', getCookie('csrf-workshop'));
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
    requestAssistanceModal.className = 'requesting';

    var requestName   = document.getElementById('request-name').value;
    var requestSeat;

    var requestSeats = document.getElementsByName('seat');
    for(var i = 0, l = requestSeats.length; i < l; i++) {
        if(requestSeats[i].checked) {
            requestSeat = requestSeats[i].value;
        }
    }

    if(requestName && requestSeat) {
        var data = 'workshopId=' + workshopId + '&requestName=' + requestName + '&requestSeat=' + requestSeat;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/requestAssistance.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                if(request.responseText == 'duplicate') {
                    alert('You have already requested assistance!');
                } else if(request.responseText == 'profanity') {
                    alert('No profanity please!');
                } else {
                    getSlots();
                    requestAssistanceToggle.checked = false;
                    window.scrollTo(0,0);
                    alert('Assistance has been requested. You have been added to the end of the queue.');
                }
                stopRequesting();
            }
        }

        request.onerror = function() {
            alert('Something went wrong. Please try again.');
            stopRequesting();
        }
    } else {
        alert('All fields are required.');
        stopRequesting();
    }

    function stopRequesting() {
        requestAssistanceModal.className = '';
    }
}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}