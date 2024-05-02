var fullscreenButton = document.getElementById("ic-fullscreen");
fullscreenButton.addEventListener("click", toggleFullScreen, false);

function toggleFullScreen() {
 
  if (!document.fullscreenElement &&    // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } 
    else if (document.documentElement.msRequestFullscreen) {
      document.documentElement.msRequestFullscreen();
    } 
    else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } 
    else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
   
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } 
    else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } 
    else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } 
    else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
}


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
})
