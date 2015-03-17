<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
        <style>

            * {
                margin: 0;
                padding: 0;
                outline: 0;
            }

            body, html {
                height: 100%;
                width: 100%;
            }

            body {
                font-size: 14px;
                line-height: 18px;
                font-family: 'Open Sans', sans-serif;
                color: #aeaeae;
                overflow: hidden; /* needed to eliminate scroll bars caused by the background image */
                padding: 0;
                margin: 0; /* necessary for the raster to fill the screen */
                height: 100%;
                width: 100%;
            }

            a {
                color: #0252aa;
                text-decoration: none;
                cursor: pointer;
            }

            a:hover {
                text-decoration: underline;
            }

            a img {
                border: 0;
            }

            /* ---------- FUll WIDTH BACKGROUND ---------- */

            #bgimg {
                position: absolute;
                z-index: -1;
            }

            .content-box {
                width: 570px;
                z-index: 2;
                position: relative;
                left: 53%;
                top: 0;
                padding: 34px 0;
            }

            .content-box.type2 {
                padding-top: 108px;
            }

            .content-box.type2 .blackbox form {
                padding-top: 6px;
            }

            #logo {
                display: block;
                margin: 0 auto;
                text-align: center;
            }

            #logo img {
                margin: 0 auto;
                max-height: 100px;
                max-width: 300px;
            }

            .blackbox {
                background: #233d53;
                border-radius: 7px;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
            }

            .blackbox {
                text-align: center;
                padding-bottom: 17px;
                padding-top: 17px;
                margin-bottom: 11px;
            }

            .blackbox h3,
            .blackbox h2 {
                font-size: 28px;
                line-height: 28px;
                color: #fefefe;
                font-weight: normal;
                padding: 20px 30px;
                overflow: hidden;
            }

            .blackbox h3 {
                font-size: 28px;
                font-weight: 600;
                line-height: 30px;
                padding: 12px 50px;
                overflow: hidden;
            }

            .blackbox p {
                font-size: 16px;
                font-weight: 400;
                padding: 10px 30px;
                overflow: hidden;
                color: #a4d9ff;
            }

            .blackbox #subtext {
                font-size: 14px;
                line-height: 20px;
            }

            .blackbox form {
                padding: 10px 0 16px;
            }

            .blackbox .field {
                background-color: #fff;
                font-size: 14px;
                padding: 6px 10px;
                border: 0;
                width: 256px;
                margin-bottom: 16px;
            }

            .blackbox .field {
                box-shadow: inset 0 2px 2px rgba(0, 0, 0, 0.3);
                -moz-box-shadow: inset 0 2px 2px rgba(0, 0, 0, 0.3);
                -webkit-box-shadow: inset 0 2px 2px rgba(0, 0, 0, 0.3);
                border-radius: 4px;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
            }

            .blackbox #optin-button {
                border-radius: 4px;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
                display: block;
                background: #ffc600;
                color: #fcfcfc;
                font-family: 'Open Sans Condensed', sans-serif;
                font-size: 30px;
                font-weight: 600;
                width: 395px;
                height: 50px;
                cursor: pointer;
                -webkit-appearance: none;
                line-height: 49px;
                margin: 0 auto;
                padding: 5px 5px;
                text-decoration: none;
                overflow: hidden;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            }

            .blackbox #optin-button:hover {
                background-color: #059edd;
            }

            .footer {
                color: #073051;
                font-size: 14px;
                text-align: center;
            }

            .footer a {
                color: #fafafa;
            }

            @media only screen and (max-width: 1300px) {
                .content-box {
                    left: 45%;
                }
            }

            @media only screen and (max-width: 1100px) {
                .content-box {
                    left: 35%;
                }
            }

            @media only screen and (max-width: 1000px) {
                .content-box {
                    left: 28%;
                }
            }

            @media only screen and (max-width: 850px) {
                .content-box {
                    left: 22%;
                }
            }

            @media only screen and (max-width: 768px) {
                .content-box {
                    margin: 0 auto;
                    position: static;
                    max-width: 85%;
                }
            }

            @media only screen and (max-width: 650px) {

                .content-box.type2 {
                    padding-top: 60px;
                }

                .blackbox h3 {
                    font-size: 18px;
                    line-height: 22px;
                }

                .blackbox .field {
                    width: 85%;
                }

                .blackbox #optin-button {
                    font-size: 20px;
                    width: 85%;
                }
            }

            @media only screen and (max-width: 340px) {
                body {
                    font-size: 12px;
                }

                .content-box.type2 {
                    padding-top: 30px;
                }

                #logo img {
                    max-width: 210px;
                }

                .blackbox h3 {
                    font-size: 16px;
                    line-height: 21px;
                    padding: 12px 15px;
                }

                .blackbox .field {
                    width: 80%;
                }

                .blackbox #optin-button {
                    width: 80%;
                    font-size: 18px;
                }

                .blackbox p {
                    font-size: 12px;
                    line-height: 14px;
                    padding: 8px 15px;
                }

                .blackbox #subtext {
                    font-size: 12px;
                    line-height: 14px;
                }
            }

        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript">
           /**
            * @preserve HTML5 Shiv v3.6.2 | @afarkas @jdalton @jon_neal @rem | MIT/GPL2 Licensed
            */
           ;
           (function (window, document) {
               /*jshint evil:true */
               /** version */
               var version = '3.6.2';

               /** Preset options */
               var options = window.html5 || {};

               /** Used to skip problem elements */
               var reSkip = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i;

               /** Not all elements can be cloned in IE **/
               var saveClones = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i;

               /** Detect whether the browser supports default html5 styles */
               var supportsHtml5Styles;

               /** Name of the expando, to work with multiple documents or to re-shiv one document */
               var expando = '_html5shiv';

               /** The id for the the documents expando */
               var expanID = 0;

               /** Cached data for each document */
               var expandoData = {};

               /** Detect whether the browser supports unknown elements */
               var supportsUnknownElements;

               (function () {
                   try {
                       var a = document.createElement('a');
                       a.innerHTML = '<xyz></xyz>';
                       //if the hidden property is implemented we can assume, that the browser supports basic HTML5 Styles
                       supportsHtml5Styles = ('hidden' in a);

                       supportsUnknownElements = a.childNodes.length == 1 || (function () {
                           // assign a false positive if unable to shiv
                           (document.createElement)('a');
                           var frag = document.createDocumentFragment();
                           return (
                                   typeof frag.cloneNode == 'undefined' ||
                                   typeof frag.createDocumentFragment == 'undefined' ||
                                   typeof frag.createElement == 'undefined'
                                   );
                       }());
                   } catch (e) {
                       // assign a false positive if detection fails => unable to shiv
                       supportsHtml5Styles = true;
                       supportsUnknownElements = true;
                   }

               }());

               /*--------------------------------------------------------------------------*/

               /**
                * Creates a style sheet with the given CSS text and adds it to the document.
                * @private
                * @param {Document} ownerDocument The document.
                * @param {String} cssText The CSS text.
                * @returns {StyleSheet} The style element.
                */
               function addStyleSheet(ownerDocument, cssText) {
                   var p = ownerDocument.createElement('p'),
                           parent = ownerDocument.getElementsByTagName('head')[0] || ownerDocument.documentElement;

                   p.innerHTML = 'x<style>' + cssText + '</style>';
                   return parent.insertBefore(p.lastChild, parent.firstChild);
               }

               /**
                * Returns the value of `html5.elements` as an array.
                * @private
                * @returns {Array} An array of shived element node names.
                */
               function getElements() {
                   var elements = html5.elements;
                   return typeof elements == 'string' ? elements.split(' ') : elements;
               }

               /**
                * Returns the data associated to the given document
                * @private
                * @param {Document} ownerDocument The document.
                * @returns {Object} An object of data.
                */
               function getExpandoData(ownerDocument) {
                   var data = expandoData[ownerDocument[expando]];
                   if (!data) {
                       data = {};
                       expanID++;
                       ownerDocument[expando] = expanID;
                       expandoData[expanID] = data;
                   }
                   return data;
               }

               /**
                * returns a shived element for the given nodeName and document
                * @memberOf html5
                * @param {String} nodeName name of the element
                * @param {Document} ownerDocument The context document.
                * @returns {Object} The shived element.
                */
               function createElement(nodeName, ownerDocument, data) {
                   if (!ownerDocument) {
                       ownerDocument = document;
                   }
                   if (supportsUnknownElements) {
                       return ownerDocument.createElement(nodeName);
                   }
                   if (!data) {
                       data = getExpandoData(ownerDocument);
                   }
                   var node;

                   if (data.cache[nodeName]) {
                       node = data.cache[nodeName].cloneNode();
                   } else if (saveClones.test(nodeName)) {
                       node = (data.cache[nodeName] = data.createElem(nodeName)).cloneNode();
                   } else {
                       node = data.createElem(nodeName);
                   }

                   // Avoid adding some elements to fragments in IE < 9 because
                   // * Attributes like `name` or `type` cannot be set/changed once an element
                   //   is inserted into a document/fragment
                   // * Link elements with `src` attributes that are inaccessible, as with
                   //   a 403 response, will cause the tab/window to crash
                   // * Script elements appended to fragments will execute when their `src`
                   //   or `text` property is set
                   return node.canHaveChildren && !reSkip.test(nodeName) ? data.frag.appendChild(node) : node;
               }

               /**
                * returns a shived DocumentFragment for the given document
                * @memberOf html5
                * @param {Document} ownerDocument The context document.
                * @returns {Object} The shived DocumentFragment.
                */
               function createDocumentFragment(ownerDocument, data) {
                   if (!ownerDocument) {
                       ownerDocument = document;
                   }
                   if (supportsUnknownElements) {
                       return ownerDocument.createDocumentFragment();
                   }
                   data = data || getExpandoData(ownerDocument);
                   var clone = data.frag.cloneNode(),
                           i = 0,
                           elems = getElements(),
                           l = elems.length;
                   for (; i < l; i++) {
                       clone.createElement(elems[i]);
                   }
                   return clone;
               }

               /**
                * Shivs the `createElement` and `createDocumentFragment` methods of the document.
                * @private
                * @param {Document|DocumentFragment} ownerDocument The document.
                * @param {Object} data of the document.
                */
               function shivMethods(ownerDocument, data) {
                   if (!data.cache) {
                       data.cache = {};
                       data.createElem = ownerDocument.createElement;
                       data.createFrag = ownerDocument.createDocumentFragment;
                       data.frag = data.createFrag();
                   }


                   ownerDocument.createElement = function (nodeName) {
                       //abort shiv
                       if (!html5.shivMethods) {
                           return data.createElem(nodeName);
                       }
                       return createElement(nodeName, ownerDocument, data);
                   };

                   ownerDocument.createDocumentFragment = Function('h,f', 'return function(){' +
                           'var n=f.cloneNode(),c=n.createElement;' +
                           'h.shivMethods&&(' +
                           // unroll the `createElement` calls
                           getElements().join().replace(/\w+/g, function (nodeName) {
                       data.createElem(nodeName);
                       data.frag.createElement(nodeName);
                       return 'c("' + nodeName + '")';
                   }) +
                           ');return n}'
                           )(html5, data.frag);
               }

               /*--------------------------------------------------------------------------*/

               /**
                * Shivs the given document.
                * @memberOf html5
                * @param {Document} ownerDocument The document to shiv.
                * @returns {Document} The shived document.
                */
               function shivDocument(ownerDocument) {
                   if (!ownerDocument) {
                       ownerDocument = document;
                   }
                   var data = getExpandoData(ownerDocument);

                   if (html5.shivCSS && !supportsHtml5Styles && !data.hasCSS) {
                       data.hasCSS = !!addStyleSheet(ownerDocument,
                               // corrects block display not defined in IE6/7/8/9
                               'article,aside,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}' +
                               // adds styling not present in IE6/7/8/9
                               'mark{background:#FF0;color:#000}' +
                               // hides non-rendered elements
                               'template{display:none}'
                               );
                   }
                   if (!supportsUnknownElements) {
                       shivMethods(ownerDocument, data);
                   }
                   return ownerDocument;
               }

               /*--------------------------------------------------------------------------*/

               /**
                * The `html5` object is exposed so that more elements can be shived and
                * existing shiving can be detected on iframes.
                * @type Object
                * @example
                *
                * // options can be changed before the script is included
                * html5 = { 'elements': 'mark section', 'shivCSS': false, 'shivMethods': false };
                */
               var html5 = {
                   /**
                    * An array or space separated string of node names of the elements to shiv.
                    * @memberOf html5
                    * @type Array|String
                    */
                   'elements': options.elements || 'abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup main mark meter nav output progress section summary template time video',
                   /**
                    * current version of html5shiv
                    */
                   'version': version,
                   /**
                    * A flag to indicate that the HTML5 style sheet should be inserted.
                    * @memberOf html5
                    * @type Boolean
                    */
                   'shivCSS': (options.shivCSS !== false),
                   /**
                    * Is equal to true if a browser supports creating unknown/HTML5 elements
                    * @memberOf html5
                    * @type boolean
                    */
                   'supportsUnknownElements': supportsUnknownElements,
                   /**
                    * A flag to indicate that the document's `createElement` and `createDocumentFragment`
                    * methods should be overwritten.
                    * @memberOf html5
                    * @type Boolean
                    */
                   'shivMethods': (options.shivMethods !== false),
                   /**
                    * A string to describe the type of `html5` object ("default" or "default print").
                    * @memberOf html5
                    * @type String
                    */
                   'type': 'default',
                   // shivs the document according to the specified `html5` object options
                   'shivDocument': shivDocument,
                   //creates a shived element
                   createElement: createElement,
                   //creates a shived documentFragment
                   createDocumentFragment: createDocumentFragment
               };

               /*--------------------------------------------------------------------------*/

               // expose html5
               window.html5 = html5;

               // shiv the document
               shivDocument(document);

           }(this, document));

        </script>
        <script type="text/javascript">
           // background logic
           (function ($) {
               $.setBackground = function (options) {
                   options = options ? options : {};
                   options = $.extend({}, {width: 1440, height: 1100, element: '#background'}, options);
                   $(document).ready(function () {
                       $.resizeBackground(options)
                   });
                   $(window).bind('resize', function () {
                       $.resizeBackground(options)
                   });
               };
               $.resizeBackground = function (options) {
                   var $element = $(options.element);
                   var ratio = options.height / options.width;
                   var browserwidth = $(window).width();
                   var browserheight = $(window).height();
                   if ((browserheight / browserwidth) > ratio) {
                       $element.height(browserheight);
                       $element.width(browserheight / ratio);
                   } else {
                       $element.width(browserwidth);
                       $element.height(browserwidth * ratio);
                   }
               };
           })(jQuery);

           // invoke background
           $(function () {
               $.setBackground({
                   element: '#bgimg',
                   width: 1440,
                   height: 1100
               });
           });
        </script>
        <title><?php wp_title('|', true, 'right'); ?></title>
    </head>
    <body>
              <?php $img = get_post_meta(get_the_ID(), 'konora_lead_background_image', TRUE); ?>
              <!-- background image -->
              <img id="bgimg" src="<?= $img != '' ? $img : plugins_url("images/bg.jpg", __FILE__); ?>" alt="" class="bg" data-lead-id="background-img" />
              
              <!-- wrapper -->
              <?php the_content(); ?>
    </body>
</html>