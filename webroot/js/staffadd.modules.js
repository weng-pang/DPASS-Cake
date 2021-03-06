// Location Service
let latitude = document.getElementById('latitude');
let longitude = document.getElementById('longitude');
let accuracy = document.getElementById('accuracy');
let locationDisplay =  document.getElementById('location-service');

function getLocation(){
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition, showError);

    } else {
        locationDisplay.innerHTML = notSupported;
        locationFail();
    }
}

function locationSuccess(){
    locationDisplay.classList.remove('alert-danger');
    locationDisplay.classList.remove('fa-times-circle');
    locationDisplay.classList.add('alert-success');
    locationDisplay.classList.add('fa-check-circle');
}

function locationFail(){
    locationDisplay.classList.remove('alert-success');
    locationDisplay.classList.remove('fa-check-circle');
    locationDisplay.classList.add('alert-danger');
    locationDisplay.classList.add('fa-times-circle');
}

function showPosition(position){
    latitude.value = position.coords.latitude;
    longitude.value = position.coords.longitude;
    accuracy.value = position.coords.accuracy;
    locationDisplay.innerHTML = ready;
    locationSuccess();
}

function showError(error){
    switch(error.code) {
        case error.PERMISSION_DENIED:
            locationDisplay.innerHTML = denied;
            break;
        case error.POSITION_UNAVAILABLE:
            locationDisplay.innerHTML = unavailable;
            break;
        case error.TIMEOUT:
            locationDisplay.innerHTML = timeout;
            break;
        default:
            locationDisplay.innerHTML = unknown;
            break;
    }
    locationFail();
}

// Photo Present Check
function checkPhotoUpload(){
    if (document.getElementById("photo").files.length == 0){
        $( "#no-photo-confirm" ).dialog( "open" );
        event.returnValue = false; // Stop the original form submit
    }
}

// Block UI - Wait screen for record uploading work
let blockCss = {
    border: 'none',
    padding: '15px',
    backgroundColor: '#000',
    '-webkit-border-radius': '10px',
    '-moz-border-radius': '10px',
    opacity: .5,
    color: '#fff'
};

$("#record-form").submit( function (){
    // Screen 1
    $.blockUI({
        message : wait,
        css : blockCss,
        fadeOut : 0 // No fade out
    });
    setTimeout( function(){ // https://stackoverflow.com/a/1836140
        // Screen 2
            $.blockUI({
                message : loading,
                css : blockCss,
                fadeIn : 0, // No fade in & out
                fadeOut : 0
            });
        }
        , waitTime );
    setTimeout( function(){ // https://stackoverflow.com/a/1836140
            // Screen 3
            $.blockUI({
                message : $('#long-loading'),
                css : blockCss,
                fadeIn : 0, // No fade in & out
                fadeOut : 0
            });
        }
        , waitTime * 2 ); // Double the wait time as screen 2
});