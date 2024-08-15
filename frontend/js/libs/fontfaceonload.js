/*! fontfaceonload - v1.0.2 - 2017-06-28
 * https://github.com/zachleat/fontfaceonload
 * Copyright (c) 2017 Zach Leatherman (@zachleat)
 * MIT License */

/*
 * Copyright 2013 Zach Leatherman
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
* distribute, sublicense, and/or sell copies of the Software, and to
* permit persons to whom the Software is furnished to do so, subject to
* the following conditions:
*
* The above copyright notice and this permission notice shall be
* included in all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
* MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
* LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
* OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
* WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

(function (root, factory) {
  'use strict';
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define([], factory);
  } else if (typeof exports === 'object') {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like environments that support module.exports,
    // like Node.
    module.exports = factory();
  } else {
    // Browser globals (root is window)
    root.FontFaceOnload = factory();
  }
}(this, function () {
  'use strict';

  var TEST_STRING = 'AxmTYklsjo190QW',
    SANS_SERIF_FONTS = 'sans-serif',
    SERIF_FONTS = 'serif',

    defaultOptions = {
      tolerance: 2, // px
      delay: 100,
      glyphs: '',
      success: function() {},
      error: function() {},
      timeout: 5000,
      weight: '400', // normal
      style: 'normal',
      window: window
    },

    // See https://github.com/typekit/webfontloader/blob/master/src/core/fontruler.js#L41
    style = [
      'display:block',
      'position:absolute',
      'top:-999px',
      'left:-999px',
      'font-size:48px',
      'width:auto',
      'height:auto',
      'line-height:normal',
      'margin:0',
      'padding:0',
      'font-variant:normal',
      'white-space:nowrap'
    ],
    html = '<div style="%s" aria-hidden="true">' + TEST_STRING + '</div>';

  var FontFaceOnloadInstance = function() {
    this.fontFamily = '';
    this.appended = false;
    this.serif = undefined;
    this.sansSerif = undefined;
    this.parent = undefined;
    this.options = {};
  };

  FontFaceOnloadInstance.prototype.getMeasurements = function () {
    return {
      sansSerif: {
        width: this.sansSerif.offsetWidth,
        height: this.sansSerif.offsetHeight
      },
      serif: {
        width: this.serif.offsetWidth,
        height: this.serif.offsetHeight
      }
    };
  };

  FontFaceOnloadInstance.prototype.load = function () {
    var startTime = new Date(),
      that = this,
      serif = that.serif,
      sansSerif = that.sansSerif,
      parent = that.parent,
      appended = that.appended,
      dimensions,
      options = that.options,
      ref = options.reference;

    function getStyle( family ) {
      return style
        .concat( [ 'font-weight:' + options.weight, 'font-style:' + options.style ] )
        .concat( "font-family:" + family )
        .join( ";" );
    }

    var sansSerifHtml = html.replace( /\%s/, getStyle( SANS_SERIF_FONTS ) ),
      serifHtml = html.replace( /\%s/, getStyle(  SERIF_FONTS ) );

    if( !parent ) {
      parent = that.parent = options.window.document.createElement( "div" );
    }

    parent.innerHTML = sansSerifHtml + serifHtml;
    sansSerif = that.sansSerif = parent.firstChild;
    serif = that.serif = sansSerif.nextSibling;

    if( options.glyphs ) {
      sansSerif.innerHTML += options.glyphs;
      serif.innerHTML += options.glyphs;
    }

    function hasNewDimensions( dims, el, tolerance ) {
      return Math.abs( dims.width - el.offsetWidth ) > tolerance ||
        Math.abs( dims.height - el.offsetHeight ) > tolerance;
    }

    function isTimeout() {
      return ( new Date() ).getTime() - startTime.getTime() > options.timeout;
    }

    (function checkDimensions() {
      if( !ref ) {
        ref = options.window.document.body;
      }
      if( !appended && ref ) {
        ref.appendChild( parent );
        appended = that.appended = true;

        dimensions = that.getMeasurements();

        // Make sure we set the new font-family after we take our initial dimensions:
        // handles the case where FontFaceOnload is called after the font has already
        // loaded.
        sansSerif.style.fontFamily = that.fontFamily + ', ' + SANS_SERIF_FONTS;
        serif.style.fontFamily = that.fontFamily + ', ' + SERIF_FONTS;
      }

      if( appended && dimensions &&
        ( hasNewDimensions( dimensions.sansSerif, sansSerif, options.tolerance ) ||
        hasNewDimensions( dimensions.serif, serif, options.tolerance ) ) ) {

        options.success();
      } else if( isTimeout() ) {
        options.error();
      } else {
        if( !appended && "requestAnimationFrame" in options.window ) {
          options.window.requestAnimationFrame( checkDimensions );
        } else {
          options.window.setTimeout( checkDimensions, options.delay );
        }
      }
    })();
  }; // end load()

  FontFaceOnloadInstance.prototype.cleanFamilyName = function( family ) {
    return family.replace( /[\'\"]/g, '' ).toLowerCase();
  };

  FontFaceOnloadInstance.prototype.cleanWeight = function( weight ) {
    // lighter and bolder not supported
    var weightLookup = {
      normal: '400',
      bold: '700'
    };

    return '' + (weightLookup[ weight ] || weight);
  };

  FontFaceOnloadInstance.prototype.checkFontFaces = function( timeout ) {
    var _t = this;
    _t.options.window.document.fonts.forEach(function( font ) {
      if( _t.cleanFamilyName( font.family ) === _t.cleanFamilyName( _t.fontFamily ) &&
        _t.cleanWeight( font.weight ) === _t.cleanWeight( _t.options.weight ) &&
        font.style === _t.options.style ) {
        font.load().then(function() {
          _t.options.success( font );
          _t.options.window.clearTimeout( timeout );
        });
      }
    });
  };

  FontFaceOnloadInstance.prototype.init = function( fontFamily, options ) {
    var timeout;

    for( var j in defaultOptions ) {
      if( !options.hasOwnProperty( j ) ) {
        options[ j ] = defaultOptions[ j ];
      }
    }

    this.options = options;
    this.fontFamily = fontFamily;

    // For some reason this was failing on afontgarde + icon fonts.
    if( !options.glyphs && "fonts" in options.window.document ) {
      if( options.timeout ) {
        timeout = options.window.setTimeout(function() {
          options.error();
        }, options.timeout );
      }

      this.checkFontFaces( timeout );
    } else {
      this.load();
    }
  };

  var FontFaceOnload = function( fontFamily, options ) {
    var instance = new FontFaceOnloadInstance();
    instance.init(fontFamily, options);

    return instance;
  };

  return FontFaceOnload;
}));
