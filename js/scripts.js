// Init
var main                    = document.getElementById('main');
var workshopSlotCount       = document.getElementById('workshop-slot-count');
var userSlotsWrapper        = document.getElementById('user-slots');
var requestAssistanceSubmit = document.getElementById('request-submit');
var requestAssistanceToggle = document.getElementById('request-assistance-toggle');
var mapModal                = document.getElementById('map-modal');
var mapModalMarker          = document.getElementById('map-modal-marker');

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
        showMap(e.target.parentElement.getAttribute('data-location'));
    }

    if(e.target.className == 'user-id') {
        showMap(e.target.parentElement.parentElement.getAttribute('data-location'));
    }

    if(e.target.className == 'user-cancel') {
        cancelSlot(e.target.parentElement.getAttribute('data-slotid'));
    }

    if(e.target.className == 'icon-cancel') {
        cancelSlot(e.target.parentElement.parentElement.getAttribute('data-slotid'));
    }
});

requestAssistanceSubmit.addEventListener('click', function(e) {
    e.preventDefault();
    requestAssistance();
});

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

function showMap(location) {
    main.className += ' map-modal--show';
    mapModalMarker.innerHTML = location;
}

function hideMap() {
    main.className = main.className.replace(' map-modal--show', '');
}

function cancelSlot(slotId) {
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

function requestAssistance() {
    var requestName     = document.getElementById('request-name').value;
    var requestKentId   = document.getElementById('request-id').value;
    var requestLocation = 'test';

    var data = 'workshopId=' + workshopId + '&requestName=' + requestName + '&requestKentId=' + requestKentId + '&requestLocation=' + requestLocation;
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
}