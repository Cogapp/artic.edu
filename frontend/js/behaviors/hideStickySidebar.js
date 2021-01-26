import { purgeProperties, triggerCustomEvent } from '@area17/a17-helpers';

const hideStickySidebar = function(container) {

  function _handleClicks(event) {
    event.preventDefault();
    triggerCustomEvent(document, 'stickySidebar:close');
    container.blur();
  }

  function _init() {
    container.addEventListener('click', _handleClicks, false);
  }

  this.destroy = function() {
    // remove specific event handlers
    container.removeEventListener('click', _handleClicks);

    // remove properties of this behavior
    A17.Helpers.purgeProperties(this);
  };

  this.init = function() {
    _init();
  };
};

export default hideStickySidebar;
