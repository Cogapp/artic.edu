// dragScroll

import { purgeProperties } from 'a17-helpers';

const dragScroll = function(container) {

  let lastScrollLeft = 0;
  let lastScrollTop = 0;
  let lastClientX = 0;
  let lastClientY = 0;
  let dragging = false;
  let allowClicks = true;
  let xVelocity = 0;
  let yVelocity = 0;

  function updateScroll(x, y) {
    let newScrollLeft = lastScrollLeft - x;
    let newScrollTop = lastScrollTop - y;
    container.scrollLeft = newScrollLeft;
    container.scrollTop = newScrollTop;
    lastScrollLeft = newScrollLeft;
    lastScrollTop = newScrollTop;
  }

  function _momentum() {
    if (!dragging) {
      // if there is some velocity, shrink it, linear (no easing)
      if (Math.abs(xVelocity) > 0) {
        xVelocity = (xVelocity > 0) ? xVelocity - 1 : xVelocity + 1;
      }
      if (Math.abs(yVelocity) > 0) {
        yVelocity = (yVelocity > 0) ? yVelocity - 1 : yVelocity + 1;
      }
      // if some momentum remains, update scroll and try again
      if (Math.abs(xVelocity) > 0 || Math.abs(yVelocity) > 0) {
        updateScroll(xVelocity, yVelocity);
        window.requestAnimationFrame(_momentum);
      }
    }
  }

  function _clicks(event) {
    if (!allowClicks) {
      event.preventDefault();
      event.stopPropagation();
    }
  }

  function _mouseDown(event) {
    event.preventDefault();
    // reset everything
    xVelocity = 0;
    yVelocity = 0;
    lastScrollLeft = container.scrollLeft;
    lastScrollTop = container.scrollTop;
    lastClientX = event.clientX;
    lastClientY = event.clientY;
    // allow mouse move tracking
    dragging = true;
  }

  function _mouseUp(event) {
    // stop mouse move tracking
    dragging = false;
    // if we have some velocity, do momentum
    if (Math.abs(xVelocity) > 0 || Math.abs(yVelocity) > 0) {
      window.requestAnimationFrame(_momentum);
    }
    setTimeout(function(){
      allowClicks = true;
    }, 50);
  }

  function _mouseMove(event) {
    if (dragging) {
      // get the distance moved
      xVelocity = -lastClientX + event.clientX;
      yVelocity = -lastClientX + event.clientX;
      // update
      updateScroll(xVelocity, yVelocity);
      // set so we can compare
      lastClientX = event.clientX;
      lastClientY = event.clientY;
      // if it looks like the user is trying to scroll, block link clicks
      if (Math.abs(xVelocity) > 2 || Math.abs(yVelocity) > 2) {
        allowClicks = false;
      }
    }
  }

  function _init() {
    container.addEventListener('click', _clicks, false);
    container.addEventListener('mousedown', _mouseDown, false);
    window.addEventListener('mouseup', _mouseUp, false);
    window.addEventListener('mousemove', _mouseMove, false);
  }

  this.destroy = function() {
    // remove specific event handlers
    container.removeEventListener('click', _clicks);
    container.removeEventListener('mousedown', _mouseDown);
    window.removeEventListener('mouseup', _mouseUp);
    window.removeEventListener('mousemove', _mouseMove);

    // remove properties of this behavior
    A17.Helpers.purgeProperties(this);
  };

  this.init = function() {
    _init();
  };
};

export default dragScroll;
