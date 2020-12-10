/**
 * DevCon2020 v1.0.0 - Developer Conference 2020
 * @link https://zafree.github.io/devcon2020
 * @copyright 2020 Zafree
 * @license MIT
 */
"use strict";

(function () {
  'use strict';

  var root = document.documentElement,
      body = document.body,
      modals = body.querySelectorAll('[data-modal]'); //   const _kErnel = document.querySelector('._kErnel');

  var modalShown = true,
      scrollPosition = 0;

  if (typeof modals != 'undefined' && modals != null && modals.length > 0) {
    Array.prototype.forEach.call(modals, function (modal) {
      modal.addEventListener('click', modalCallback);
    });
  }

  function modalCallback(e) {
    e.preventDefault(); // get target dataset

    var target = e.target,
        getId = target.dataset.modal; // close all modals

    var closeAllModals = body.querySelectorAll('.modal');
    Array.prototype.forEach.call(closeAllModals, function (closeAllModal) {
      if (closeAllModal.classList.contains("modal--open")) {
        removeModal(closeAllModal);
      }
    }); // if modal exists in DOM

    var modal = document.getElementById(getId);

    if (typeof modal != 'undefined' && modal != null) {
      // console.log(modal);
      modalStateCallback(modal);
    } else {
      console.log("undefine id: " + getId);
    }
  }

  function modalStateCallback(e) {
    if (modalShown) {
      showModal(e);
      cancelDetector(e);
    } else {
      removeModal(e);
    }

    modalShown = !modalShown;
  }

  function cancelDetector(e) {
    var dismisses = e.querySelectorAll('[data-dismiss]');

    if (typeof dismisses != 'undefined' && dismisses != null && dismisses.length > 0) {
      Array.prototype.forEach.call(dismisses, function (dismiss) {
        dismiss.addEventListener('click', dismissCallback);
      });
    } else {
      console.log("missing: data-dismiss");
    }
  }

  function dismissCallback(e) {
    var target = e.target;
    var targetDismiss = target.closest('.modal');
    removeModal(targetDismiss);
    modalShown = true;
  }

  function showModal(e) {
    e.classList.add("modal--open"); // e.classList.toggle("modal--open");
    // scrollPosition = window.pageYOffset;
    // _kErnel.style.top = -scrollPosition + 'px';
    // root.classList.add('isScrollDisabled');
  }

  function removeModal(e) {
    e.classList.remove("modal--open"); // e.classList.toggle("modal--open");
    // root.classList.remove('isScrollDisabled');
    // _kErnel.style.top = null;
    // window.scrollTo(null, scrollPosition);

    modalShown = true;
  }
})();
"use strict";

(function () {
  'use strict';

  var button = document.getElementById('next');

  button.onclick = function () {
    var container = document.getElementById('slider');
    sideScroll(container, 'right', 40, 200, 20);
  };

  var back = document.getElementById('prev');

  back.onclick = function () {
    var container = document.getElementById('slider');
    sideScroll(container, 'left', 40, 200, 20);
  };

  function sideScroll(element, direction, speed, distance, step) {
    var scrollAmount = 0;
    var slideTimer = setInterval(function () {
      if (direction == 'left') {
        console.log("left");
        element.scrollLeft -= step;
      } else {
        console.log("right");
        element.scrollLeft += step;
      }

      scrollAmount += step;

      if (scrollAmount >= distance) {
        window.clearInterval(slideTimer);
      }
    }, speed);
  }
})();