// Get slots
var i = 1;
var userSlotsWrapper = document.getElementById('user-slots');

setInterval(function() {
    console.log('interval' + i);
    getSlots();
    i++;
}, 5000);

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
            } else {
                userSlotsWrapper.innerHTML = '<h2>There is currently no one in need of assistance.</h2>';
            }
        }
    }
}

getSlots();

// Show map
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

var main           = document.getElementById('main');
var mapModal       = document.getElementById('map-modal');
var mapModalMarker = document.getElementById('map-modal-marker');

mapModal.addEventListener('click', hideMap);

function showMap(location) {
    main.className += ' map-modal--show';
    mapModalMarker.innerHTML = location;
}

function hideMap() {
    main.className = main.className.replace(' map-modal--show', '');
}

function cancelSlot(slotId) {
    console.log(slotId);
}