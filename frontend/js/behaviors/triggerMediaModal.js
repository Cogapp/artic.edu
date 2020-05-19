import { purgeProperties, triggerCustomEvent } from '@area17/a17-helpers';

const triggerMediaModal = function(container) {

  function _handleClicks(event) {
    var textarea = container.querySelector('textarea');
    if (!textarea) textarea = container.parentNode.querySelector('textarea');
    if (textarea) {
      var embedCode = textarea.value;
      if (embedCode) {
        event.preventDefault();
        event.stopPropagation();
        triggerCustomEvent(document, 'modal:open', {
          type: 'media',
          restricted: (container.parentNode.dataset.restricted == 'true') ? true : false,
          module3d: (container.parentNode.dataset.type == 'module3d') ? true : false,
          module360: (container.parentNode.dataset.type == 'module360') ? true : false,
          embedCode: embedCode,
          subtype: container.getAttribute('data-subtype') || null,
        });
        if(container.parentNode.dataset.type == 'module3d' && container.dataset.title) {
          triggerCustomEvent(document, 'gtm:push', {
            'event': '3D-open-modal',
            'eventCategory': 'in-page',
            'eventAction': container.dataset.title+' - Modal 3D'
          });
        }
        if(container.parentNode.dataset.type == 'module360' && container.dataset.title) {
          triggerCustomEvent(document, 'gtm:push', {
            'event': '360-open-modal',
            'eventCategory': 'in-page',
            'eventAction': container.dataset.title+' - Modal 360'
          });
        }
      }
    }
  }

  function _handleKeyUp(event) {
    if (event.keyCode == 13) {
      _handleClicks(event);
    }
  }

  function _init() {
    container.addEventListener('click', _handleClicks, false);
    container.addEventListener('keyup', _handleKeyUp, false);
  }

  this.destroy = function() {
    // remove specific event handlers
    container.removeEventListener('click', _handleClicks);
    container.removeEventListener('keyup', _handleKeyUp);

    // remove properties of this behavior
    A17.Helpers.purgeProperties(this);
  };

  this.init = function() {
    _init();
  };
};

export default triggerMediaModal;

