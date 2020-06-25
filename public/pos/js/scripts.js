/*
 * NYASA ADMIN TEMPLATE JAVASCRIPT
 * ======================================================================
 * NOTE : All JavaScript plugins require jQuery to be included
 * http://jquery.com/
 *
 */
/* ========================================================================
 * SELECTOR CACHE v.1.0
 * -------------------------------------------------------------------------
 * - Designbudy.com -
 * ========================================================================*/
/*
To improve performance and load time, you don't need to create a new variable to get main selector,
for the main selector has been cached and used in all of plugins, just need to call the variables.

Example:
To get selector "#container" maybe you can use

var $container = $ ('# container');
$container.addClass('effect');


For more efficient, simply called "nyasa.container".


nyasa.container.addClass('effect');


Both of the above methods will produce the same results.

*/
$(document).on('ready',function() {
    "use strict";

    window.nyasa = {
        'container': $('#container'),
        'contentContainer': $('#content-container'),
        'navbar': $('#navbar'),
        'mainNav': $('#mainnav-container'),
        'aside': $('#aside-container'),
        'footer': $('#footer'),
        'scrollTop': $('#scroll-top'),

        'window': $(window),
        'body': $('body'),
        'bodyHtml': $('body, html'),
        'document': $(document),
        'screenSize': '', // return value xs, sm, md, lg
        'isMobile': function() {
            return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
        }(),
        'randomInt': function(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        },
        'transition': function() {
            var thisBody = document.body || document.documentElement,
                thisStyle = thisBody.style,
                support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined;
            return support
        }()
    };


        // BOOTSTRAP TOOLTIP
        // =================================================================
        // Require Bootstrap Tooltip
        // =================================================================

           $('[data-toggle="tooltip"]').tooltip()

        // BOOTSTRAP POPOVER
        // =================================================================
        // Require Bootstrap popover
        // =================================================================
		   
           $('[data-toggle="popover"]').popover()

		   
        // STYLEABLE SCROLLBARS
        // =================================================================
        // Require nanoScroller
        // http://jamesflorentino.github.io/nanoScrollerJS/
        // =================================================================
        var nano = $('.nano');
        if (nano.length) nano.nanoScroller({
            preventPageScrolling: true
        });

        // Update nancoscroller
        $('#navbar-container .navbar-top-links').on('shown.bs.dropdown', '.dropdown', function() {
            $(this).find('.nano').nanoScroller({
                preventPageScrolling: true
            });
        });


        nyasa.body.addClass('page-effect');



    /* ========================================================================
     * PANEL REMOVAL v1.0
     * -------------------------------------------------------------------------
     * Optional Font Icon : By Font Awesome
     * http://fortawesome.github.io/Font-Awesome/
     * ========================================================================*/
        var closebtn = $('[data-dismiss="panel"]');

        if (closebtn.length) {
            closebtn.one('click', function(e) {
                e.preventDefault();
                var el = $(this).parents('.panel');

                el.addClass('remove').on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(e) {
                    if (e.originalEvent.propertyName == "opacity") {
                        el.remove();
                    }
                });
            });
        }


    /* ========================================================================
     * SCROLL TO TOP BUTTON v1.0
     * -------------------------------------------------------------------------
     * Optional Font Icon : By Font Awesome
     * http://fortawesome.github.io/Font-Awesome/
     * ========================================================================*/

	 if (nyasa.scrollTop.length && !nyasa.isMobile) {
            var isVisible = true;
            var offsetTop = 250;

            nyasa.window.scroll(function() {
                if (nyasa.window.scrollTop() > offsetTop && !isVisible) {
                    nyasa.navbar.addClass('shadow');
                    nyasa.scrollTop.addClass('in');
                    isVisible = true;
                } else if (nyasa.window.scrollTop() < offsetTop && isVisible) {
                    nyasa.navbar.removeClass('shadow');
                    nyasa.scrollTop.removeClass('in');
                    isVisible = false;
                }
            });

            nyasa.scrollTop.on('click', function(e) {
                e.preventDefault();

                nyasa.bodyHtml.animate({
                    scrollTop: 0
                }, 500);
            });

        }




    /* ========================================================================
     * nyasa OVERLAY v1.0
     * -------------------------------------------------------------------------
     * Optional Font Icon : By Font Awesome
     * http://fortawesome.github.io/Font-Awesome/
     * ========================================================================*/

    var defaults = {
            'displayIcon': true,
            // DESC	 		: Should we display the icon or not.
            // VALUE	 	: true or false
            // TYPE 	 	: Boolean


            'iconColor': 'text-dark',
            // DESC	 		: The color of the icon..
            // VALUE	 	: text-light || text-primary || text-info || text-success || text-warning || text-danger || text-mint || text-purple || text-pink || text-dark
            // TYPE 	 	: String

            'iconClass': 'fa fa-refresh fa-spin fa-2x',
            // DESC  		: Class name of the font awesome icons", Currently we use font-awesome for default value.
            // VALUE 		: (Icon Class Name)
            // TYPE			: String


            'title': '',
            // DESC			: Overlay title
            // TYPE			: String

            'desc': ''
            // DESC			: Descrition
            // TYPE			: String


        },
        uID = function() {
            return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
        },
        methods = {
            'show': function(el) {
                var target = $(el.attr('data-target')),
                    ovId = 'nyasa-overlay-' + uID() + uID() + "-" + uID(),
                    panelOv = $('<div id="' + ovId + '" class="panel-overlay"></div>');

                el.prop('disabled', true).data('jasmineOverlay', ovId);
                target.addClass('panel-overlay-wrap');
                panelOv.appendTo(target).html(el.data('overlayTemplate'));
                return null;
            },
            'hide': function(el) {
                var target = $(el.attr('data-target'));
                var boxLoad = $('#' + el.data('jasmineOverlay'));

                if (boxLoad.length) {
                    el.prop('disabled', false);
                    target.removeClass('panel-overlay-wrap');
                    boxLoad.hide().remove();
                }
                return null;
            }
        },
        loadBox = function(el, options) {
            if (el.data('overlayTemplate')) {
                return null;
            }
            var opt = $.extend({}, defaults, options),
                icon = (opt.displayIcon) ? '<span class="panel-overlay-icon ' + opt.iconColor + '"><i class="' + opt.iconClass + '"></i></span>' : '';
            el.data('overlayTemplate', '<div class="panel-overlay-content pad-all unselectable">' + icon + '<h4 class="panel-overlay-title">' + opt.title + '</h4><p>' + opt.desc + '</p></div>');
            return null;
        };

    $.fn.jasmineOverlay = function(method) {
        if (methods[method]) {
            return methods[method](this);
        } else if (typeof method === 'object' || !method) {
            return this.each(function() {
                loadBox($(this), method);
            });
        }
        return null;
    };



    /* ========================================================================
     * nyasa NOTIFICATION v1.1
     * -------------------------------------------------------------------------
     * By Squaredesigns.net
     * ========================================================================*/

    var pageHolder, floatContainer = {},
        notyContainer, addNew = false;
    $.jasmineNoty = function(options) {
        var defaults = {
                type: 'primary',
                // DESC     : Specify style for the alerts.
                // VALUE    : primary || info || success || warning || danger || mint || purple || pink ||  dark
                // TYPE     : String


                icon: '',
                // DESC     : Icon class names
                // VALUE    : (Icon Class Name)
                // TYPE     : String


                title: '',
                // VALUE    : (The title of the alert)
                // TYPE     : String

                message: '',
                // VALUE    : (Message of the alert.)
                // TYPE     : String


                closeBtn: true,
                // VALUE    : Show or hide the close button.
                // TYPE     : Boolean



                container: 'page',
                // DESC     : This option is particularly useful in that it allows you to position the notification.
                // VALUE    : page || floating ||  "specified target name"
                // TYPE     : STRING


                floating: {
                    position: 'top-right',
                    // Floating position.
                    // Currently only supports "top-right". We will make further development for the next version.


                    animationIn: 'jellyIn',
                    // Please use the animated class name from animate.css

                    animationOut: 'fadeOut'
                    // Please use the animated class name from animate.css

                },

                html: null,
                // Insert HTML into the notification.  If false, jQuery's text method will be used to insert content into the DOM.


                focus: true,
                //Scroll to the notification


                timer: 0
                // DESC     : To enable the "auto close" alerts, please specify the time to show the alert before it closed.
                // VALUE    : Value is in milliseconds. (0 to disable the autoclose.)
                // TYPE     : Number

            },
            opt = $.extend({}, defaults, options),
            el = $('<div class="alert-wrap"></div>'),
            iconTemplate = function() {
                var icon = '';
                if (options && options.icon) {
                    icon = '<div class="media-left"><span class="icon-wrap icon-wrap-xs icon-circle alert-icon"><i class="' + opt.icon + '"></i></span></div>';
                }
                return icon;
            },
            alertTimer,
            template = function() {
                var clsBtn = opt.closeBtn ? '<button class="close" type="button"><i class="fa fa-times-circle"></i></button>' : '';
                var defTemplate = '<div class="alert alert-' + opt.type + '" role="alert">' + clsBtn + '<div class="media">';
                if (!opt.html) {
                    return defTemplate + iconTemplate() + '<div class="media-body"><h4 class="alert-title">' + opt.title + '</h4><p class="alert-message">' + opt.message + '</p></div></div>';
                }
                return defTemplate + opt.html + '</div></div>';
            }(),
            closeAlert = function(e) {
                if (opt.container === 'floating' && opt.floating.animationOut) {
                    el.removeClass(opt.floating.animationIn).addClass(opt.floating.animationOut);
                    if (!nyasa.transition) {
                        el.remove();
                    }
                }

                el.removeClass('in').on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(e) {
                    if (e.originalEvent.propertyName == "max-height") {
                        el.remove();
                    }
                });
                clearInterval(alertTimer);
                return null;
            },
            focusElement = function(pos) {
                nyasa.bodyHtml.animate({
                    scrollTop: pos
                }, 300, function() {
                    el.addClass('in');
                });
            },
            init = function() {
                if (opt.container === 'page') {
                    if (!pageHolder) {
                        pageHolder = $('<div id="page-alert"></div>');
                        nyasa.contentContainer.prepend(pageHolder);
                    };

                    notyContainer = pageHolder;
                    if (opt.focus) focusElement(0);

                } else if (opt.container === 'floating') {
                    if (!floatContainer[opt.floating.position]) {
                        floatContainer[opt.floating.position] = $('<div id="floating-' + opt.floating.position + '" class="floating-container"></div>');
                        nyasa.container.append(floatContainer[opt.floating.position]);
                    }

                    notyContainer = floatContainer[opt.floating.position];

                    if (opt.floating.animationIn) el.addClass('in animated ' + opt.floating.animationIn);
                    opt.focus = false;
                } else {
                    var $ct = $(opt.container);
                    var $panelct = $ct.children('.panel-alert');
                    var $panelhd = $ct.children('.panel-heading');

                    if (!$ct.length) {
                        addNew = false;
                        return false;
                    }


                    if (!$panelct.length) {
                        notyContainer = $('<div class="panel-alert"></div>');
                        if ($panelhd.length) {
                            $panelhd.after(notyContainer);
                        } else {
                            $ct.prepend(notyContainer)
                        }
                    } else {
                        notyContainer = $panelct;
                    }

                    if (opt.focus) focusElement($ct.offset().top - 30);

                }
                addNew = true;
                return false;
            }();

        if (addNew) {
            notyContainer.append(el.html(template));
            el.find('[data-dismiss="noty"]').one('click', closeAlert);
            if (opt.closeBtn) el.find('.close').one('click', closeAlert);
            if (opt.timer > 0) alertTimer = setInterval(closeAlert, opt.timer);
            if (!opt.focus) var addIn = setInterval(function() {
                el.addClass('in');
                clearInterval(addIn);
            }, 200);
        }
    };



    /* ========================================================================
     * nyasa CHECK v1.1
     * -------------------------------------------------------------------------
     * - squaredesigns.net -
     * ========================================================================*/

    var allFormEl,
        formElement = function(el) {
            if (el.data('nyasa-check')) {
                return;
            } else {
                el.data('nyasa-check', true);
                if (el.text().trim().length) {
                    el.addClass("form-text");
                } else {
                    el.removeClass("form-text");
                }
            }


            var input = el.find('input')[0],
                groupName = input.name,
                $groupInput = function() {
                    if (input.type == 'radio' && groupName) {
                        return $('.form-radio').not(el).find('input').filter('input[name=' + groupName + ']').parent();
                    } else {
                        return false;
                    }
                }(),
                changed = function() {
                    if (input.type == 'radio' && $groupInput.length) {
                        $groupInput.each(function() {
                            var $gi = $(this);
                            if ($gi.hasClass('active')) $gi.trigger('nyasa.ch.unchecked');
                            $gi.removeClass('active');
                        });
                    }


                    if (input.checked) {
                        el.addClass('active').trigger('nyasa.ch.checked');
                    } else {
                        el.removeClass('active').trigger('nyasa.ch.unchecked');
                    }
                };

            if (input.checked) {
                el.addClass('active');
            } else {
                el.removeClass('active');
            }

            $(input).on('change', changed);
        },
        methods = {
            isChecked: function() {
                return this[0].checked;
            },
            toggle: function() {
                this[0].checked = !this[0].checked;
                this.trigger('change');
                return null;
            },
            toggleOn: function() {
                if (!this[0].checked) {
                    this[0].checked = true;
                    this.trigger('change');
                }
                return null;
            },
            toggleOff: function() {
                if (this[0].checked && this[0].type == 'checkbox') {
                    this[0].checked = false;
                    this.trigger('change');
                }
                return null;
            }
        };

    $.fn.jasmineCheck = function(method) {
        var chk = false;
        this.each(function() {
            if (methods[method]) {
                chk = methods[method].apply($(this).find('input'), Array.prototype.slice.call(arguments, 1));
            } else if (typeof method === 'object' || !method) {
                formElement($(this));
            };
        });
        return chk;
    };

        allFormEl = $('.form-checkbox, .form-radio');
        if (allFormEl.length) allFormEl.jasmineCheck();

    nyasa.document.on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, ''),
            size = function() {
                try {
                    return input[0].files[0].size;
                } catch (err) {
                    return 'Nan';
                }
            }(),
            fileSize = function() {
                if (size == 'Nan') {
                    return "Unknown";
                }
                var rSize = Math.floor(Math.log(size) / Math.log(1024));
                return (size / Math.pow(1024, rSize)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][rSize];
            }();



        input.trigger('fileselect', [numFiles, label, fileSize]);
    });



    // NAVIGATION SHORTCUT BUTTONS
    // =================================================================
    // Require Bootstrap Popover
    // http://getbootstrap.com/javascript/#popovers
    // =================================================================

        var shortcutBtn = $('#mainnav-shortcut');

        if (shortcutBtn.length) {
            shortcutBtn.find('li').each(function() {
                var $el = $(this);
                $el.popover({
                    animation: false,
                    trigger: 'hover focus',
                    placement: 'bottom',
                    container: '#mainnav-container',
                    template: '<div class="popover mainnav-shortcut"><div class="arrow"></div><div class="popover-content"></div>'
                });
            });
        }


    /* ========================================================================
     * nyasa NAVIGATION v1.2.1
     * -------------------------------------------------------------------------
     *
     * Require Bootstrap Popover
     * http://getbootstrap.com/javascript/#popovers
     *
     * Require jQuery Resize End
     * https://github.com/nielse63/jQuery-ResizeEnd
     *
     * ========================================================================*/


    var $menulink = $('#mainnav-menu > li > a, #mainnav-menu-wrap .mainnav-widget a[data-toggle="menu-widget"]'),
        mainNavHeight = $('#mainnav').height(),
        scrollbar = null,
        updateMethod = false,
        isSmallNav = false,
        screenCat = null,
        defaultSize = null,


        // Determine and bind hover or "touch" event
        // ===============================================
        bindSmallNav = function() {
            var hidePopover;

            $menulink.each(function() {
                var $el = $(this),
                    $listTitle = $el.children('.menu-title'),
                    $listSub = $el.siblings('.collapse'),
                    $listWidget = $($el.attr('data-target')),
                    $listWidgetParent = ($listWidget.length) ? $listWidget.parent() : null,
                    $popover = null,
                    $poptitle = null,
                    $popcontent = null,
                    $popoverSub = null,
                    popoverPosBottom = 0,
                    popoverCssBottom = 0,
                    elPadding = $el.outerHeight() - $el.height() / 4,
                    listSubScroll = false,
                    elHasSub = function() {
                        if ($listWidget.length) {
                            $el.on('click', function(e) {
                                e.preventDefault()
                            });
                        }
                        if ($listSub.length) {
                            //$listSub.removeClass('in').removeAttr('style');
                            $el.on('click', function(e) {
                                e.preventDefault()
                            }).parent('li').removeClass('active');
                            return true;
                        } else {
                            return false;
                        }
                    }(),
                    updateScrollInterval = null,
                    updateScrollBar = function(el) {
                        clearInterval(updateScrollInterval);
                        updateScrollInterval = setInterval(function() {
                            el.nanoScroller({
                                preventPageScrolling: true,
                                alwaysVisible: true
                            });
                            clearInterval(updateScrollInterval);
                        }, 700);
                    };

                $('#mainnav-container').on("click", function(event, values) {
                    $el.removeClass('hover').popover('hide');
                });

                $('#mainnav-menu-wrap > .nano').on("update", function(event, values) {
                    $el.removeClass('hover').popover('hide');
                });


                $el.popover({
                    animation: false,
                    trigger: 'manual',
                    container: '#mainnav',
                    viewport: $el,
                    html: true,
                    title: function() {
                        if (elHasSub) return $listTitle.html();
                        return null
                    },
                    content: function() {
                        var $content;
                        if (elHasSub) {
                            $content = $('<div class="sub-menu"></div>');
                            $listSub.addClass('pop-in').wrap('<div class="nano-content"></div>').parent().appendTo($content);
                        } else if ($listWidget.length) {
                            $content = $('<div class="sidebar-widget-popover"></div>');
                            $listWidget.wrap('<div class="nano-content"></div>').parent().appendTo($content);
                        } else {
                            $content = '<span class="single-content">' + $listTitle.html() + '</span>';
                        }
                        return $content;
                    },
                    template: '<div class="popover menu-popover"><h4 class="popover-title"></h4><div class="popover-content"></div></div>'
                }).on('show.bs.popover', function() {
                    if (!$popover) {
                        $popover = $el.data('bs.popover').tip();
                        $poptitle = $popover.find('.popover-title');
                        $popcontent = $popover.children('.popover-content');

                        if (!elHasSub && $listWidget.length == 0) return;
                        $popoverSub = $popcontent.children('.sub-menu');
                    }
                    if (!elHasSub && $listWidget.length == 0) return;
                }).
                on('shown.bs.popover', function() {
                        if (!elHasSub && $listWidget.length == 0) {
                            var margintop = 0 - (0.5 * $el.outerHeight());
                            $popcontent.css({
                                'margin-top': margintop + 'px',
                                'width': 'auto'
                            });
                            return;
                        }


                        var offsetTop = parseInt($popover.css('top'), radix),
                            elHeight = $el.outerHeight(),
                            offsetBottom = function() {
                                if (nyasa.container.hasClass('mainnav-fixed')) {
                                    return $(window).outerHeight() - offsetTop - elHeight;
                                } else {
                                    return $(document).height() - offsetTop - elHeight;
                                }
                            }(),
                            popoverHeight = $popcontent.find('.nano-content').children().css('height', 'auto').outerHeight();
                        $popcontent.find('.nano-content').children().css('height', '');



                        if (offsetTop > offsetBottom) {
                            if ($poptitle.length && !$poptitle.is(':visible')) elHeight = Math.round(0 - (0.5 * elHeight));
                            offsetTop -= 5;
                            $popcontent.css({
                                'top': '',
                                'bottom': elHeight + 'px',
                                'height': offsetTop
                            }).children().addClass('nano').css({
                                'width': '100%'
                            }).nanoScroller({
                                preventPageScrolling: true
                            });
                            updateScrollBar($popcontent.find('.nano'));
                        } else {
                            if (!nyasa.container.hasClass('navbar-fixed') && nyasa.mainNav.hasClass('affix-top')) offsetBottom -= 50;
                            if (popoverHeight > offsetBottom) {
                                if (nyasa.container.hasClass('navbar-fixed') || nyasa.mainNav.hasClass('affix-top')) offsetBottom -= (elHeight + 5);

                                offsetBottom -= 5;
                                $popcontent.css({
                                    'top': elHeight + 'px',
                                    'bottom': '',
                                    'height': offsetBottom
                                }).children().addClass('nano').css({
                                    'width': '100%'
                                }).nanoScroller({
                                    preventPageScrolling: true
                                });

                                updateScrollBar($popcontent.find('.nano'));
                            } else {
                                if ($poptitle.length && !$poptitle.is(':visible')) elHeight = Math.round(0 - (0.5 * elHeight));
                                $popcontent.css({
                                    'top': elHeight + 'px',
                                    'bottom': '',
                                    'height': 'auto'
                                });
                            }
                        }
                        if ($poptitle.length) $poptitle.css('height', $el.outerHeight());
                        $popcontent.on('click', function() {
                            $popcontent.find('.nano-pane').hide();
                            updateScrollBar($popcontent.find('.nano'));
                        });
                    })
                    .on('hidden.bs.popover', function() {
                        // detach from popover, fire event then clean up data
                        $el.removeClass('hover');
                        if (elHasSub) {
                            $listSub.removeAttr('style').appendTo($el.parent());
                        } else if ($listWidget.length) {
                            $listWidget.appendTo($listWidgetParent);
                        }
                        clearInterval(hidePopover);
                    })
                    .on('click', function() {
                        if (!nyasa.container.hasClass('mainnav-sm')) return;
                        $menulink.popover('hide');
                        $el.addClass('hover').popover('show');
                    })
                    .hover(
                        function() {
                            $menulink.popover('hide');
                            $el.addClass('hover').popover('show');
                        },
                        function() {
                            clearInterval(hidePopover);
                            hidePopover = setInterval(function() {
                                if ($popover) {
                                    $popover.one('mouseleave', function() {
                                        $el.removeClass('hover').popover('hide');
                                    });
                                    if (!$popover.is(":hover")) {
                                        $el.removeClass('hover').popover('hide');
                                    }
                                };
                                clearInterval(hidePopover);
                            }, 500);
                        }
                    );
            });
            isSmallNav = true;
        },
        unbindSmallNav = function() {
            var colapsed = $('#mainnav-menu').find('.collapse');
            if (colapsed.length) {
                colapsed.each(function() {
                    var cl = $(this);
                    if (cl.hasClass('in')) {
                        cl.parent('li').addClass('active');
                    } else {
                        cl.parent('li').removeClass('active');
                    }
                });
            }
            if (scrollbar != null && scrollbar.length) {
                scrollbar.nanoScroller({
                    stop: true
                });
            }

            $menulink.popover('destroy').unbind('mouseenter mouseleave');
            isSmallNav = false;
        },
        updateSize = function() {
            //if(!defaultSize) return;

            var sw = nyasa.container.width(),
                currentScreen;


            if (sw <= 740) {
                currentScreen = 'xs';
            } else if (sw > 740 && sw < 992) {
                currentScreen = 'sm';
            } else if (sw >= 992 && sw <= 1200) {
                currentScreen = 'md';
            } else {
                currentScreen = 'lg';
            }

            if (screenCat != currentScreen) {
                screenCat = currentScreen;
                nyasa.screenSize = currentScreen;

                if (nyasa.screenSize == 'sm' && nyasa.container.hasClass('mainnav-lg')) {
                    $.jasmineNav('collapse');
                }
            }
        },
        updateNav = function(e) {
            nyasa.mainNav.jasmineAffix('update');

            unbindSmallNav();
            updateSize();

            if (updateMethod == 'collapse' || nyasa.container.hasClass('mainnav-sm')) {
                nyasa.container.removeClass('mainnav-in mainnav-out mainnav-lg');
                bindSmallNav();
            }

            mainNavHeight = $('#mainnav').height();
            updateMethod = false;
            return null;
        },
        init = function() {
            if (!defaultSize) {
                defaultSize = {
                    xs: 'mainnav-out',
                    sm: nyasa.mainNav.data('sm') || nyasa.mainNav.data('all'),
                    md: nyasa.mainNav.data('md') || nyasa.mainNav.data('all'),
                    lg: nyasa.mainNav.data('lg') || nyasa.mainNav.data('all')
                }

                var hasData = false;
                for (var item in defaultSize) {
                    if (defaultSize[item]) {
                        hasData = true;
                        break;
                    }
                }

                if (!hasData) defaultSize = null;
                updateSize();
            }
        },
        methods = {
            'revealToggle': function() {
                if (!nyasa.container.hasClass('reveal')) nyasa.container.addClass('reveal');
                nyasa.container.toggleClass('mainnav-in mainnav-out').removeClass('mainnav-lg mainnav-sm')
                if (isSmallNav) unbindSmallNav();
                return;
            },
            'revealIn': function() {
                if (!nyasa.container.hasClass('reveal')) nyasa.container.addClass('reveal');
                nyasa.container.addClass('mainnav-in').removeClass('mainnav-out mainnav-lg mainnav-sm');
                if (isSmallNav) unbindSmallNav();
                return;
            },
            'revealOut': function() {
                if (!nyasa.container.hasClass('reveal')) nyasa.container.addClass('reveal');
                nyasa.container.removeClass('mainnav-in mainnav-lg mainnav-sm').addClass('mainnav-out');
                if (isSmallNav) unbindSmallNav();
                return;
            },
            'slideToggle': function() {
                if (!nyasa.container.hasClass('slide')) nyasa.container.addClass('slide');
                nyasa.container.toggleClass('mainnav-in mainnav-out').removeClass('mainnav-lg mainnav-sm')
                if (isSmallNav) unbindSmallNav();
                return;
            },
            'slideIn': function() {
                if (!nyasa.container.hasClass('slide')) nyasa.container.addClass('slide');
                nyasa.container.addClass('mainnav-in').removeClass('mainnav-out mainnav-lg mainnav-sm');
                if (isSmallNav) unbindSmallNav();
                return;
            },
            'slideOut': function() {
                if (!nyasa.container.hasClass('slide')) nyasa.container.addClass('slide');
                nyasa.container.removeClass('mainnav-in mainnav-lg mainnav-sm').addClass('mainnav-out');
                if (isSmallNav) unbindSmallNav();
                return;
            },
            'pushToggle': function() {
                nyasa.container.toggleClass('mainnav-in mainnav-out').removeClass('mainnav-lg mainnav-sm');
                if (nyasa.container.hasClass('mainnav-in mainnav-out')) nyasa.container.removeClass('mainnav-in');
                //if (nyasa.container.hasClass('mainnav-in')) //nyasa.container.removeClass('aside-in');
                if (isSmallNav) unbindSmallNav();
                return;
            },
            'pushIn': function() {
                nyasa.container.addClass('mainnav-in').removeClass('mainnav-out mainnav-lg mainnav-sm');
                if (isSmallNav) unbindSmallNav();
                return;
            },
            'pushOut': function() {
                nyasa.container.removeClass('mainnav-in mainnav-lg mainnav-sm').addClass('mainnav-out');
                if (isSmallNav) unbindSmallNav();
                return;
            },
            'colExpToggle': function() {
                if (nyasa.container.hasClass('mainnav-lg mainnav-sm')) nyasa.container.removeClass('mainnav-lg');
                nyasa.container.toggleClass('mainnav-lg mainnav-sm').removeClass('mainnav-in mainnav-out');
                return nyasa.window.trigger('resize');
            },
            'collapse': function() {
                nyasa.container.addClass('mainnav-sm').removeClass('mainnav-lg mainnav-in mainnav-out');
                updateMethod = 'collapse';
                return nyasa.window.trigger('resize');
            },
            'expand': function() {
                nyasa.container.removeClass('mainnav-sm mainnav-in mainnav-out').addClass('mainnav-lg');
                return nyasa.window.trigger('resize');
            },
            'togglePosition': function() {
                nyasa.container.toggleClass('mainnav-fixed');
                nyasa.mainNav.jasmineAffix('update');
            },
            'fixedPosition': function() {
                nyasa.container.addClass('mainnav-fixed');
                nyasa.mainNav.jasmineAffix('update');
            },
            'staticPosition': function() {
                nyasa.container.removeClass('mainnav-fixed');
                nyasa.mainNav.jasmineAffix('update');
            },
            'update': updateNav,
            'forceUpdate': updateSize,
            'getScreenSize': function() {
                return screenCat
            }
        };


    $.jasmineNav = function(method, complete) {
        if (methods[method]) {
            if (method == 'colExpToggle' || method == 'expand' || method == 'collapse') {
                if (nyasa.screenSize == 'xs' && method == 'collapse') {
                    method = 'pushOut';
                } else if ((nyasa.screenSize == 'xs' || nyasa.screenSize == 'sm') && (method == 'colExpToggle' || method == 'expand') && nyasa.container.hasClass('mainnav-sm')) {
                    method = 'pushIn';
                }
            }
            var val = methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
            if (complete) return complete();
            else if (val) return val;
        }
        return null;
    };



    $.fn.isOnScreen = function() {
        var viewport = {
            top: nyasa.window.scrollTop(),
            left: nyasa.window.scrollLeft()
        };
        viewport.right = viewport.left + nyasa.window.width();
        viewport.bottom = viewport.top + nyasa.window.height();

        var bounds = this.offset();
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();

        return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.bottom || viewport.top > bounds.top));

    };

    nyasa.window.on('resizeEnd', updateNav).trigger('resize');


        var toggleBtn = $('.mainnav-toggle');
        if (toggleBtn.length) {
            toggleBtn.on('click', function(e) {
                e.preventDefault();

                if (toggleBtn.hasClass('push')) {
                    $.jasmineNav('pushToggle');
                } else if (toggleBtn.hasClass('slide')) {
                    $.jasmineNav('slideToggle');
                } else if (toggleBtn.hasClass('reveal')) {
                    $.jasmineNav('revealToggle');
                } else {
                    $.jasmineNav('colExpToggle');
                }
            })
        }

        var menu = $('#mainnav-menu');
        if (menu.length) {
            // COLLAPSIBLE MENU LIST
            // =================================================================
            // Require MetisMenu
            // http://demo.onokumus.com/metisMenu/
            // =================================================================
            $('#mainnav-menu').metisMenu({
                toggle: true
            });

            // STYLEABLE SCROLLBARS
            // =================================================================
            // Require nanoScroller
            // http://jamesflorentino.github.io/nanoScrollerJS/
            // =================================================================
            scrollbar = nyasa.mainNav.find('.nano');
            if (scrollbar.length) {
                scrollbar.nanoScroller({
                    preventPageScrolling: true
                });
            }

        }



    /* ========================================================================
     * nyasa ASIDE v1.0.1
     * -------------------------------------------------------------------------
     * - squaredesigns.net -
     * ========================================================================*/

    var asideMethods = {
            'toggleHideShow': function() {
                nyasa.container.toggleClass('aside-in');
                nyasa.window.trigger('resize');
                if (nyasa.container.hasClass('aside-in')) {
                    toggleNav();
                }
            },
            'show': function() {
                nyasa.container.addClass('aside-in');
                nyasa.window.trigger('resize');
                toggleNav();
            },
            'hide': function() {
                nyasa.container.removeClass('aside-in');
                nyasa.window.trigger('resize');
            },
            'toggleAlign': function() {
                nyasa.container.toggleClass('aside-left');
                nyasa.aside.jasmineAffix('update');
            },
            'alignLeft': function() {
                nyasa.container.addClass('aside-left');
                nyasa.aside.jasmineAffix('update');
            },
            'alignRight': function() {
                nyasa.container.removeClass('aside-left');
                nyasa.aside.jasmineAffix('update');
            },
            'togglePosition': function() {
                nyasa.container.toggleClass('aside-fixed');
                nyasa.aside.jasmineAffix('update');
            },
            'fixedPosition': function() {
                nyasa.container.addClass('aside-fixed');
                nyasa.aside.jasmineAffix('update');
            },
            'staticPosition': function() {
                nyasa.container.removeClass('aside-fixed');
                nyasa.aside.jasmineAffix('update');
            },
            'toggleTheme': function() {
                nyasa.container.toggleClass('aside-bright');
            },
            'brightTheme': function() {
                nyasa.container.addClass('aside-bright');
            },
            'darkTheme': function() {
                nyasa.container.removeClass('aside-bright');
            }
        },
        toggleNav = function() {
            if (nyasa.container.hasClass('mainnav-in') && nyasa.screenSize != 'xs') {
                if (nyasa.screenSize == 'sm') {
                    $.jasmineNav('collapse');
                } else {
                    nyasa.container.removeClass('mainnav-in mainnav-lg mainnav-sm').addClass('mainnav-out');
                }
            }
        };



    $.jasmineAside = function(method, complete) {
        if (asideMethods[method]) {
            asideMethods[method].apply(this, Array.prototype.slice.call(arguments, 1));
            if (complete) return complete();
        }
        return null;
    }

        if (nyasa.aside.length) {

            // STYLEABLE SCROLLBARS
            // =================================================================
            // Require nanoScroller
            // http://jamesflorentino.github.io/nanoScrollerJS/
            // =================================================================
            nyasa.aside.find('.nano').nanoScroller({
                preventPageScrolling: true,
                alwaysVisible: false
            });

            var toggleBtn = $('.aside-toggle');
            if (toggleBtn.length) {
                toggleBtn.on('click', function(e) {
                    $.jasmineAside('toggleHideShow');
                })
            }
        }



    /* ========================================================================
     * nyasa AFFIX v1.0
     * -------------------------------------------------------------------------
     * Require Bootstrap Affix
     * http://getbootstrap.com/javascript/#affix
     * ========================================================================*/

    $.fn.jasmineAffix = function(method) {
            return this.each(function() {
                var el = $(this),
                    className;

                if (typeof method === 'object' || !method) {
                    className = method.className;
                    el.data('nyasa.af.class', method.className);
                } else if (method == 'update') {
                    className = el.data('nyasa.af.class');
                }

                if (nyasa.container.hasClass(className) && !nyasa.container.hasClass('navbar-fixed')) {
                    el.affix({
                        offset: {
                            top: $('#navbar').outerHeight()
                        }
                    });
                } else if (!nyasa.container.hasClass(className) || nyasa.container.hasClass('navbar-fixed')) {
                    nyasa.window.off(el.attr('id') + '.affix');
                    el.removeClass('affix affix-top affix-bottom').removeData('bs.affix');
                }
            });
        },


            nyasa.mainNav.length && nyasa.mainNav.jasmineAffix({
                className: "mainnav-fixed"
            }), nyasa.aside.length && nyasa.aside.jasmineAffix({
                className: "aside-fixed"
            })

        $(".inbox-star").click(function() {
            $(this).toggleClass("starred")

        }),

        $("#profilebtn").click(function() {
            $("#profilebody").slideToggle();
        }),

        $(".conversation-toggle").on("click", function() {
            $(".conversation").toggleClass("closed")
        });


    var elems = Array.prototype.slice.call(document.querySelectorAll('.demo-switch'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });


        // FULLSCREEN
        // =================================================================
        // Toggle fullscreen
        // =================================================================

        $('[data-toggle="fullscreen"]').click(function() {
            return screenfull.enabled && screenfull.toggle(), !1
        }), screenfull.enabled && document.addEventListener(screenfull.raw.fullscreenchange, function() {
            $('[data-toggle="fullscreen"]').toggleClass("active", screenfull.isFullscreen)
        })
});

