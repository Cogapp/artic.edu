import { purgeProperties, triggerCustomEvent, queryStringHandler } from 'a17-helpers';

const calendar = function(container) {

  const today = new Date();
  const todayDate = today.getDate();
  const todayMonth = today.getMonth();
  const todayYear = today.getFullYear();
  const searchUrl = container.getAttribute('data-calendar-url') || '/';

  let monthsVisible = 2;
  let monthDivs = [];

  let minDate = today;
  let opener = false;

  let currentMonth;
  let currentYear;
  let months = [];
  let monthLengths = [];
  let daysHtml = '';

  let $monthsContainer, $template, $start, $end;

  let datesSelected = {};
  let selecting = 'start';

  datesSelected.start = {};
  datesSelected.end = {};

  // give the months some names
  months[0] = 'Jan';
  months[1] = 'Feb';
  months[2] = 'Mar';
  months[3] = 'Apr';
  months[4] = 'May';
  months[5] = 'Jun';
  months[6] = 'Jul';
  months[7] = 'Aug';
  months[8] = 'Sep';
  months[9] = 'Oct';
  months[10] = 'Nov';
  months[11] = 'Dec';

  // how many days in each month

  monthLengths[0] = 31;
  monthLengths[1] = 28; // will be updated in generate calendar func for leap years
  monthLengths[2] = 31;
  monthLengths[3] = 30;
  monthLengths[4] = 31;
  monthLengths[5] = 30;
  monthLengths[6] = 31;
  monthLengths[7] = 31;
  monthLengths[8] = 30;
  monthLengths[9] = 31;
  monthLengths[10] = 30;
  monthLengths[11] = 31;

  function _normaliseYearMonth(){
    // if months over 11 (December), we must be wanting January a year later
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }
    // if months under 0 (January), we must be wanting December last year
    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
  }

  function _generateCalendar(el, year, month) {
    // JS this date
    var theDate = new Date(year, month);
    // is leap year?
    var isLeapYear = (new Date(year, 1, 29).getMonth() === 1);
    // update length of February as required
    monthLengths[1] = (isLeapYear) ? 29 : 28;
    // what day within the week is the first day of the month?
    var firstDayOfMonth = new Date(year, month).getDay();
    // we want to loop a multiple of 7 days and add spaces around the actual starting day
    var loopMonthLengths = monthLengths[month] + firstDayOfMonth;
    // make that loop length a multiple of 7
    while(loopMonthLengths % 7 > 0) {
      loopMonthLengths++;
    }
    // generate HTML
    // open new tr
    daysHtml = '<tr>';
    // now loop
    for (let i = 1; i <= loopMonthLengths; i++) {
      var thisDay = '';
      var tdClassName = '';
      // the gaps for if a month doesn't start on monday and to make the total TDs a multiple of 7
      if (i <= firstDayOfMonth || i > (monthLengths[month] + firstDayOfMonth)) {
        thisDay = '&nbsp;';
      } else {
        // normalize date
        var currentDate = (i - firstDayOfMonth);
        var istoday = (currentDate === todayDate && month === todayMonth && year === todayYear);
        var beforeMinDate = (year < minDate.getFullYear() || (year === minDate.getFullYear() && month < minDate.getMonth()) || (year === minDate.getFullYear() && month === minDate.getMonth() && currentDate < minDate.getDate()));
        // is this today?
        if (istoday) {
          tdClassName = 'm-calendar__today';
        }
        // if today or after, add a link
        if (istoday || !beforeMinDate) {
          var titleAttr = currentDate + ' ' + months[month] + ', ' + year;
          var urlMonth = (month + 1);
          urlMonth = (urlMonth < 10) ? '0' + urlMonth : urlMonth.toString();
          var urlDay = (currentDate < 10) ? '0' + currentDate : currentDate.toString();
          var windowLocationHref = queryStringHandler.updateParameter(window.location.href, 'date', (year.toString() + urlMonth + urlDay));
          thisDay = '<a href="'+ windowLocationHref + '" data-date="' + year.toString() + urlMonth + urlDay + '" title="' + titleAttr + '">' + currentDate + '</a>';
        } else {
          thisDay = currentDate;
        }
      }

      // update HTML string, adding new table rows when needed
      daysHtml = daysHtml + '<td class="' + tdClassName + '">' + thisDay + '</td>\n' + ((i !== 0 && i !== loopMonthLengths && i % 7 === 0) ? '</tr>\n<tr>\n' : '');
    }
    // close that last tr
    daysHtml += '</tr>';
    // insert the html
    el.querySelector('[data-calendar-title]').textContent = months[month] + ' ' + year;
    el.querySelector('tbody').innerHTML = daysHtml;
  }

  function _generateCalendars(year, month) {
    if (monthDivs.length !== monthsVisible) {
      // clone $template, update and insert
      for (let i = 0; i < monthsVisible; i++) {
        let $thisCopy = $template.cloneNode(true);
        $thisCopy.removeAttribute('data-calendar-month-$template');
        $thisCopy.removeAttribute('style');
        $monthsContainer.insertBefore($thisCopy, $template);
        monthDivs.push($thisCopy);
      }
    }
    currentYear = year;
    currentMonth = month;
    for (let i = 0; i < monthsVisible; i++) {
      currentMonth = currentMonth + i;
      _normaliseYearMonth();
      _generateCalendar(monthDivs[i], currentYear, currentMonth);
    }
  }

  function _dateSelected(clicked) {
    let chosenDate = clicked.getAttribute('data-date');
    let dateObj = new Date(parseInt(chosenDate.substring(0,4)), (parseInt(chosenDate.substring(4,6)) - 1), parseInt(chosenDate.substring(6,8)));
    let friendlyString = clicked.getAttribute('title');

    datesSelected[selecting] = {
      dateString: chosenDate,
      dateObj: dateObj,
      dateFriendlyString: friendlyString,
    };

    if (selecting === 'start') {
      selecting = 'end';
      datesSelected.end = {};
      $start.classList.remove('s-active');
      $start.classList.add('s-has-date');
      $start.textContent = friendlyString;
      $end.classList.add('s-active');
      $end.textContent = 'To';
    } else if (selecting === 'end') {
      $end.textContent = friendlyString;
    }
  }

  function _reset(which) {
    if (which === 'end') {
      selecting = 'start';
      datesSelected.end = {};
      $start.classList.add('s-active');
      $end.classList.remove('s-has-date');
      $end.classList.remove('s-active');
      $end.textContent = 'To';
    }

    if (which === 'all') {
      selecting = 'start';
      datesSelected.start = {};
      datesSelected.end = {};
      $start.classList.add('s-active');
      $start.classList.remove('s-has-date');
      $start.textContent = 'From';
      $end.classList.remove('s-active');
      $end.classList.remove('s-has-date');
      $end.textContent = 'To';
    }
  }

  function _handleClicks(event) {
    event.preventDefault();
    event.stopPropagation();
    //
    let clicked = event.target;
    clicked.blur();
    // pick action
    if (clicked.getAttribute('data-calendar-next') !== null) {
      currentMonth++;
      _normaliseYearMonth();
      _generateCalendars(currentYear, currentMonth);
    }
    if (clicked.getAttribute('data-calendar-prev') !== null) {
      currentMonth = currentMonth - monthsVisible - 1;
      _normaliseYearMonth();
      _generateCalendars(currentYear, currentMonth);
    }
    if (clicked.getAttribute('data-calendar-start') !== null) {
      _reset('end');
    }
    if (clicked.getAttribute('data-calendar-end') !== null) {
      selecting = 'end';
      $start.classList.remove('s-active');
      $end.classList.add('s-active');
    }
    if (clicked.getAttribute('data-calendar-reset') !== null) {
      _reset('all');
    }
    if (clicked.getAttribute('data-calendar-close') !== null) {
      triggerCustomEvent(document, 'selectDate:close');
      _reset('all');
    }
    if (clicked.getAttribute('data-calendar-done') !== null) {
      if (Object.keys(datesSelected.start).length === 0) {
        triggerCustomEvent(document, 'selectDate:close');
      } else {
        if (Object.keys(datesSelected.end).length === 0) {
          datesSelected.end = datesSelected.start;
        }
        triggerCustomEvent(opener, 'calendar:datesSelected', {
          dates: datesSelected,
        });
      }
      _reset('all');
    }
    if (clicked.getAttribute('data-date') !== null) {
      _dateSelected(clicked);
    }
  }

  function _openerSent(event) {
    if (event && event.data.el) {
      opener = event.data.el;
    }
    if (event && event.data.minDate && event.data.minDate !== 'today') {
      minDate = event.data.minDate;
    } else {
      minDate = today;
    }
    _generateCalendars(minDate.getFullYear(), minDate.getMonth());
  }

  function _init() {
    $monthsContainer = container.querySelector('[data-calendar-months]');
    $template = $monthsContainer.querySelector('[data-calendar-month-template]');
    $start = container.querySelector('[data-calendar-start]');
    $end = container.querySelector('[data-calendar-end]');
    // listen for clicks
    container.addEventListener('click', _handleClicks, false);
    container.addEventListener('calendar:opener', _openerSent, false);
    // draw initial calendar
    _generateCalendars(minDate.getFullYear(), minDate.getMonth());
  }

  this.destroy = function() {
    // remove specific event handlers
    container.removeEventListener('click', _handleClicks);
    container.removeEventListener('calendar:opener', _openerSent);

    // remove properties of this behavior
    purgeProperties(this);
  };

  this.init = function() {
    _init();
  };
};

export default calendar;
