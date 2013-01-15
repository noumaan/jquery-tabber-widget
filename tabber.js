	// Tabbed sidebar menu @ http://wp-mix.com/tabbed-sidebar-menu-jquery/
	$(document).ready(function() {
		$(".tab_content").hide();
		$("ul.tabs li:first").addClass("active").show();
		$(".tab_content:first").show();
		$("ul.tabs li").click(function() {
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide();
			var activeTab = $(this).find("a").attr("href");
			//$(activeTab).fadeIn();
			if ($.browser.msie) {$(activeTab).show();}
			else {$(activeTab).fadeIn();}
			return false;
		});
	});

