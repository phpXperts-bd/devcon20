(function() {

  'use strict';

  var liveIndicator =  document.getElementById("current");

  var status = true;
  setInterval(function() {

    // live date
    // var currenttime = new Date().toLocaleTimeString('en-US', { hour12: true, hour: "numeric", minute: "numeric", second: "numeric"});
    // document.getElementById('clock').innerText = currenttime;


    var eventDate = "12/17/2020";
    var timeStart = new Date(eventDate + " 09:55 AM"); 
    var timeEnd = new Date(eventDate + " 06:05 PM"); 
    var todaysDate = new Date();

    // time between given range
    if((todaysDate >= timeStart) && (todaysDate <= timeEnd)) {

      var minutesNow = todaysDate.getHours()*3600+todaysDate.getMinutes()*60+todaysDate.getSeconds();
      var minutesEventStart = timeStart.getHours()*3600+timeStart.getMinutes()*60;
      var timediff = (minutesNow - minutesEventStart) / 60; 

      // calc 5mins = 60px 
      var beforeSpace = 0;
      var px = timediff * (60/5) + beforeSpace;
      
      if (typeof(liveIndicator) != 'undefined' && liveIndicator != null) {
        // document.getElementById('increment').innerText = px+"px";
        liveIndicator.classList.add('active');
        liveIndicator.style.marginLeft = px+'px';
      }

      let content = document.getElementById('content');
      if (typeof(content) != 'undefined' && content != null) {
        let contentWidth = content.clientWidth / 2;
        if ((px > contentWidth) && status) {
          var swipe = px - contentWidth;
          sideScroll(slider,'right', 40, swipe, 20);
          status = false;
        }
      }
    } else {
      if (typeof(liveIndicator) != 'undefined' && liveIndicator != null) {
        liveIndicator.classList.remove('active');
        liveIndicator.style.marginLeft = '';
      }
    }
  }, 1000)

  // next prev

  var slider = document.getElementById('slider');
  var next = document.getElementById('next');
  if (typeof(next) != 'undefined' && next != null) {
    next.onclick = function () {
      sideScroll(slider,'right', 40, 200, 20);
    };
  }

  var prev = document.getElementById('prev');
  if (typeof(prev) != 'undefined' && prev != null) {
    prev.onclick = function () {
      sideScroll(slider,'left', 40, 200, 20);
    };
  }

  function sideScroll(element, direction, speed, distance, step){
    let scrollAmount = 0;
    var slideTimer = setInterval(function(){
      if(direction == 'left'){
        // console.log("left");
          element.scrollLeft -= step;
      } else {
        // console.log("right");
        element.scrollLeft += step;
      }
      scrollAmount += step;
      if(scrollAmount >= distance){
        window.clearInterval(slideTimer);
      }
    }, speed);
  }


})();