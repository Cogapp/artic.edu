<footer id="footer" class="g-footer">
  <a href="#a17" class="g-footer__top-link arrow-link arrow-link--up f-small-caps">
    Back to top
    <span>
      <svg aria-hidden="true" class="icon--arrow"><use xlink:href="#icon--arrow" /></svg>
    </span>
  </a>

  <div class="g-footer__inner">
    <h2 class="sr-only" id="h-footer-grid">Footer content</h2>
    <ul class="g-footer__grid" aria-labelledby="h-footer-grid">
      <li>
        <nav aria-label="primary">
          <h3 class="sr-only" id="h-footer-nav-primary">Primary Navigation</h3>

          <a class="g-footer__logo" aria-label="Art Institute of Chicago" href="/">
            <svg aria-hidden="true">
              <use xlink:href="#icon--logo--outline--92" />
            </svg>
          </a>

          <ul class="g-footer__link-list" aria-labelledby="h-footer-nav-primary">
            <li><a href="{{ $_pages['visit'] }}">Visit</a></li>
            <li><a href="{{ $_pages['exhibitions'] }}">Exhibitions and Events</a></li>
            <li><a href="{{ $_pages['collection'] }}">The Collection</a></li>
          </ul>
        </nav>
      </li>

      <li class="u-hide@small-">
        <h3 class="sr-only" id="h-footer-nav-locations">Locations</h3>
        <ul class="g-footer__link-list g-footer__link-list--flush g-footer__link-list--spaced" aria-labelledby="h-footer-nav-locations">
          <li>

            <h4>Michigan Avenue Entrance</h4>
            <a href="https://www.google.com/maps/place/The+Art+Institute+of+Chicago/@41.8795845,-87.625902,17z/data=!3m1!5s0x880e2ca148f260e3:0xd473c3802aaff420!4m5!3m4!1s0x880e2ca3e2d94695:0x4829f3cc9ca2d0de!8m2!3d41.8795847!4d-87.623713" target="_blank">111 South Michigan Avenue <br>Chicago, IL 60603</a>
          </li>

          <li>
            <h4>Modern Wing Entrance</h4>
            <a href="https://www.google.com/maps/place/Modern+Wing+Entrance/@41.8797032,-87.6244036,17z/data=!3m1!5s0x880e2ca148f260e3:0xd473c3802aaff420!4m12!1m6!3m5!1s0x880e2ca3e2d94695:0x4829f3cc9ca2d0de!2sThe+Art+Institute+of+Chicago!8m2!3d41.8795847!4d-87.623713!3m4!1s0x880e2ca6cf1a0e41:0xa97b8d9d0c91fa6e!8m2!3d41.880725!4d-87.621932" target="_blank">159 East Monroe Street <br>Chicago, IL 60603</a>
          </li>
        </ul>
      </li>

      <li class="u-hide@small-">
        <div class="g-footer__grid__group">
          <h3 class="f-list-6" id="h-footer-about-us"><a href="{{ $_pages['about-us'] }}">About us<svg aria-hidden="true" class="icon--arrow"><use xlink:href="#icon--arrow" /></svg></a></h3>

          <ul class="g-footer__link-list" aria-labelledby="h-footer-about-us">
            <li><a href="{{ $_pages['about-us-identity-and-history'] }}">Identity and History</a></li>
            <li><a href="{{ $_pages['about-us-leadership'] }}">Leadership</a></li>
            <li><a href="{{ $_pages['about-us-departments'] }}">Departments</a></li>
            <li><a href="{{ $_pages['about-us-financial-reporting'] }}">Financial Reporting</a></li>
          </ul>
        </div>

        <div class="g-footer__grid__group">
          <h3 class="f-list-6" id="h-footer-support-us"><a href="{{ $_pages['support-us'] }}">Support us</a></h3>

          <ul class="g-footer__link-list" aria-labelledby="h-footer-support-us">
            <li><a href="{{ $_pages['support-us-membership'] }}">Membership</a></li>
            <li><a href="{{ $_pages['support-us-luminary'] }}">Luminary</a></li>
            <li><a href="{{ $_pages['support-us-planned-giving'] }}">Planned Giving</a></li>
            <li><a href="{{ $_pages['support-us-corporate-sponsorship'] }}">Corporate Sponsorship</a></li>
          </ul>
        </div>
      </li>

      <li>
        <div class="g-footer__grid__group u-hide@small-">
          <h3 class="f-list-6" id="h-footer-learn-with-us"><a href="{{ $_pages['learn'] }}">Learn with us<svg aria-hidden="true" class="icon--arrow"><use xlink:href="#icon--arrow" /></svg></a></h3>

          <ul class="g-footer__link-list" aria-labelledby="h-footer-learn-with-us">
            <li><a href="{{ $_pages['learn-families'] }}">Families</a></li>
            <li><a href="{{ $_pages['learn-teens'] }}">Teens</a></li>
            <li><a href="{{ $_pages['learn-educators'] }}">Educators</a></li>
            <li><a href="{{ $_pages['learn-adults'] }}">Adults</a></li>
          </ul>
        </div>

        <div class="g-footer__grid__group">
          <h3 class="f-list-6" id="h-footer-follow-us">Follow us</h3>

          <ul class="g-footer__link-list" aria-labelledby="h-footer-follow-us">
            <li><a href="{{ $_pages['follow-facebook'] }}" data-gtm-event="facebook" data-gtm-event-category="follow" target="_blank">Facebook</a></li>
            <li><a href="{{ $_pages['follow-twitter'] }}" data-gtm-event="twitter" data-gtm-event-category="follow" target="_blank">Twitter</a></li>
            <li><a href="{{ $_pages['follow-instagram'] }}" data-gtm-event="instagram" data-gtm-event-category="follow" target="_blank">Instagram</a></li>
            <li><a href="{{ $_pages['follow-youtube'] }}" data-gtm-event="youtube" data-gtm-event-category="follow" target="_blank">YouTube</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>

  <h2 class="sr-only" id="h-mobile-footer-links">Footer Links</h2>
  <ul class="g-footer__legals f-secondary" aria-labelledby="h-mobile-footer-links">
    <li><a href="{{ $_pages['legal-press'] }}">Press</a></li>
    <li><a href="{{ $_pages['legal-employment'] }}">Careers</a></li>
    <li><a href="{{ $_pages['legal-contact'] }}">Contact</a></li>
    <li><a href="{{ $_pages['legal-venue-rental'] }}">Venue Rental</a></li>
    <li><a href="{{ $_pages['legal-image-licensing'] }}">Image Licensing</a></li>
    <li><a href="{{ $_pages['legal-saic'] }}">SAIC</a></li>
    <li><a href="{{ $_pages['legal-terms'] }}">Terms</a></li>
  </ul>
</footer>
<a class="top-link" href="#a17" aria-label="top of page">
  <svg class="icon--arrow" aria-hidden="true">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon--arrow" />
  </svg>
</a>
