const showAdmissionTooltip = function(container) {

    let tooltipSized = false;

    let targetAttribute = container.getAttribute('data-tooltip-target');
    let targetTooltip = document.getElementById(targetAttribute);

    container.addEventListener('click', function() {
        toggleTooltip.call(this);
    });

    function toggleTooltip() {
        hideTooltips();
        showTooltip(targetTooltip);
        sizeToolTips();
    }

    function hideTooltips() {
        const tooltips = document.querySelectorAll('.admission-info-button-info');
        tooltips.forEach(element => {
            element.setAttribute('style', 'display: none');
            element.setAttribute('aria-expanded','false');
            element.setAttribute('aria-hidden','true');
            element.classList.remove('admission-info-visible')
        })
    }

    function showTooltip(targetTooltip) {
        if (targetTooltip) {
            targetTooltip.setAttribute('aria-expanded','true');
            targetTooltip.setAttribute('aria-hidden','false');
            targetTooltip.setAttribute('style', 'display: block');
            targetTooltip.classList.add('admission-info-visible');
        }
    }

    function sizeToolTips() {
        if (!tooltipSized){
            tooltipSized = true;

            const posTooltips = document.querySelectorAll('.admission-info-button-info');

            posTooltips.forEach(element => {
            if (element.clientHeight !== undefined) {
                const newTopValue = -1 * (element.clientHeight) + 'px';
                element.setAttribute('style', 'top: ' + newTopValue);
            }
            });
        }
      }

    function _init() {
        hideTooltips();
        document.addEventListener('click', hideTooltips, false);
        window.addEventListener('resize', sizeToolTips, false);
    }

    this.init = function() {
        _init();
    };
};
export default showAdmissionTooltip;
