import { purgeProperties } from 'a17-helpers';
import { setFocusOnTarget } from 'a17-helpers';
import { triggerCustomEvent } from 'a17-helpers';

const dropdown = function(container) {

  let active = false;
  let allow = true;
  let hoverable = (container.getAttribute('data-dropdown-hoverable') !== null);
  let hovered = false;
  let hoverTimer;
  const hoverIntentTime = 250;

  function _ignore(el) {
    let ignore = false;
    while (container.contains(el) && el !== container) {
      if (el.getAttribute('data-dropdown-ignore') !== null) {
        ignore = true;
      }
      el = el.parentNode;
    }
    return ignore;
  }

  function _open(event) {
    if (!allow) {
      return;
    }
    if (event) {
      event.stopPropagation();
    }
    container.classList.add('s-active');
    setFocusOnTarget(container.querySelector('ul'));
    triggerCustomEvent(document, 'dropdown:closed', { el: container });
    active = true;
  }

  function _close(event) {
    if (!active) {
      return;
    }
    if (event) {
      /*
        FireFox has a bug going back to 2009 that affects the cursor showing in an input
        if event.stopPropagation() has been called on that input on focus:
        https://bugzilla.mozilla.org/show_bug.cgi?id=509684
        So, I'm seeing of the event is a focus event, if so seeing what the active
        element is. If its an input, then blurring the input to then re-focus it after
        the event.stopPropagation().
      */
      let activeElement = null;
      if (event.type === 'focus' && document.activeElement.tagName === 'INPUT') {
        activeElement = document.activeElement;
        activeElement.blur();
      }
      event.stopPropagation();
      if (activeElement) {
        window.requestAnimationFrame(function(){
          activeElement.focus();
        });
      }
    }
    container.classList.remove('s-active');
    triggerCustomEvent(document, 'dropdown:closed', { el: container });
    active = false;
  }

  function _focus(event) {
    if (document.activeElement === container || container.contains(document.activeElement)) {
      event.stopPropagation();
      if (!active) {
        if (document.activeElement.getAttribute('data-dropdown-ignore') === null) {
          _open(event);
        }
      } else if (document.activeElement === container || document.activeElement === container.firstElementChild) {
        _close(event);
        setFocusOnTarget(container.parentNode);
      }
    } else {
      _close(event);
    }
  }

  function _clicks(event) {
    if (document.activeElement !== container && !container.contains(document.activeElement) && active) {
      _close(event);
    }
  }

  function _touchstart(event) {
    if (event.target !== container && !container.contains(event.target) && active) {
      _close(event);
    }
  }

  function _touchend(event) {
    if ((event.target === container || container.contains(event.target)) && !active) {
      if (_ignore(event.target)) {
        allow = false;
        setTimeout(function(){
          allow = true;
        }, 100);
      } else {
        event.preventDefault();
        container.focus();
      }
    }
  }

  function _mouseEnter() {
    if (hovered) {
      _open();
    } else {
      if (hoverTimer) {
        clearTimeout(hoverTimer);
      }
      hoverTimer = setTimeout(function(){
        hovered = true;
        _open();
      }, hoverIntentTime);
    }
  }

  function _mouseLeave() {
    if (hoverTimer) {
      clearTimeout(hoverTimer);
    }
    hoverTimer = setTimeout(function(){
      hovered = false;
      _close();
    }, hoverIntentTime);
  }

  function _init() {
    container.setAttribute('tabindex','0');
    active = container.classList.contains('s-active');
    document.addEventListener('focus', _focus, true);
    document.addEventListener('click', _clicks, false);
    document.addEventListener('touchstart', _touchstart, false);
    document.addEventListener('touchend', _touchend, false);
    container.addEventListener('dropdown:open', _open, false);
    container.addEventListener('dropdown:close', _close, false);
    if (hoverable) {
      container.addEventListener('mouseenter', _mouseEnter, false);
      container.addEventListener('mouseleave', _mouseLeave, false);
    }
  }

  this.destroy = function() {
    // remove specific event handlers
    document.removeEventListener('focus', _focus);
    document.removeEventListener('click', _clicks);
    document.removeEventListener('touchstart', _touchstart);
    document.removeEventListener('touchend', _touchend);
    container.removeEventListener('dropdown:open', _open);
    container.removeEventListener('dropdown:close', _close);
    if (hoverable) {
      container.removeEventListener('mouseenter', _mouseEnter);
      container.removeEventListener('mouseleave', _mouseLeave);
    }

    // remove properties of this behavior
    A17.Helpers.purgeProperties(this);
  };

  this.init = function() {
    _init();
  };
};

export default dropdown;
