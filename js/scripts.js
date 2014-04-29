// Get slots
var i = 1;
var userSlots = document.getElementById('user-slots');

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
                userSlots.innerHTML = response;
            } else {
                userSlots.innerHTML = '<h2>There is currently no one in need of assistance.</h2>';
            }
        }
    }
}

getSlots();