
// Form Layout.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - Designbudy.com -


 $(document).ready(function() {


	// PANEL WITH BUTTONS - LOADING OVERLAY
	// =================================================================
	// Require Nyasa Admin Javascript
	// Designbudy.com
	// =================================================================
	$('.demo-panel-ref-btn').jasmineOverlay().on('click', function(){
		var $el = $(this), relTime;
		$el.jasmineOverlay('show');

		// Do something...



		relTime = setInterval(function(){
			// Hide the screen overlay
			$el.jasmineOverlay('hide');

			clearInterval(relTime);
		},2000);
	});


	// FULLSCREEN PANEL
	// =================================================================
	// Require Nyasa Admin Javascript
	// Designbudy.com
	// =================================================================

    $("[data-click=panel-expand]").click(function(e) {
        e.preventDefault();
        var t = $(this).closest(".panel");
        if ($("body").hasClass("panel-expand") && $(t).hasClass("panel-expand")) {
            $("body, .panel").removeClass("panel-expand");
            $(".panel").removeAttr("style")
        } else {
            $("body").addClass("panel-expand");
            $(this).closest(".panel").addClass("panel-expand")
        }
        $(window).trigger("resize")
    });


	// COLLAPSE PANEL
	// =================================================================
	// Require Nyasa Admin Javascript
	// Designbudy.com
	// =================================================================

    $("[data-click=panel-collapse]").click(function(e) {
        e.preventDefault();
        $(this).closest(".panel").find(".panel-body").slideToggle()
    });


	// RELOAD PANEL
	// =================================================================
	// Require Nyasa Admin Javascript
	// Designbudy.com
	// =================================================================


    $("[data-click=panel-reload]").click(function(e) {
        e.preventDefault();
        var t = $(this).closest(".panel");
        if (!$(t).hasClass("panel-loading")) {
            var n = $(t).find(".panel-body");
            var r = '<div class="panel-loader"><span class="spinner-small"></span></div>';
            $(t).addClass("panel-loading");
            $(n).prepend(r);
            setTimeout(function() {
                $(t).removeClass("panel-loading");
                $(t).find(".panel-loader").remove()
            }, 2000)
        }
    });

 });