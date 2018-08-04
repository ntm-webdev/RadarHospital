/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
    $("#mySidenav").css('width', '75%');
    $("#main").css('marginLeft', '75%');
    $(".resultado").css('opacity', '0.3');
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
    $("#mySidenav").css('width', '0');
    $("#main").css('marginLeft', '0');
    $(".resultado").css('opacity', '1');
}

var slider = document.getElementById("hospital__distancia");
var output = document.getElementById("demo");
output.innerHTML = slider.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
    output.innerHTML = this.value + " Km";
}