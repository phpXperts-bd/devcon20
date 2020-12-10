(function() {

  'use strict';

  var button = document.getElementById('next');
  button.onclick = function () {
    var container = document.getElementById('slider');
    sideScroll(container,'right', 40, 200, 20);
  };

  var back = document.getElementById('prev');
  back.onclick = function () {
    var container = document.getElementById('slider');
    sideScroll(container,'left', 40, 200, 20);
  };

  function sideScroll(element, direction, speed, distance, step){
    let scrollAmount = 0;
    var slideTimer = setInterval(function(){
      if(direction == 'left'){
        console.log("left");
          element.scrollLeft -= step;
      } else {
        console.log("right");
        element.scrollLeft += step;
      }
      scrollAmount += step;
      if(scrollAmount >= distance){
        window.clearInterval(slideTimer);
      }
    }, speed);
  }


})();