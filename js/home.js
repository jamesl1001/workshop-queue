// Init
var workshopCardsWrapper = document.getElementById('workshop-cards');

// Listeners
workshopCardsWrapper.addEventListener('click', function(e) {
    if(e.target.className.match('workshop-card-end')) {
        e.preventDefault();
        endWorkshop(e.target.parentElement.getAttribute('data-workshopid'));
    }

    if(e.target.className.match('icon-cancel')) {
        e.preventDefault();
        endWorkshop(e.target.parentElement.parentElement.getAttribute('data-workshopid'));
    }
});

// Events
function endWorkshop(workshopId) {
    var choice = confirm('Are you sure you would like to end this workshop?');

    if(choice) {
        var data = 'workshopId=' + workshopId;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/endWorkshop.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                location.reload();
            }
        }

        request.onerror = function() {
            alert('Something went wrong. Please try again.');
        }
    }
}