jQuery(document).ready(function($) {
	$('.tab_box').hide();
	$('.box_tab_1').show();
	$('#tab_1').addClass('active');
	$('.tab_menu_item').click(function(){
		var tabId = this.id;
		$('.tab_box').hide();
		$('.tab_menu_item').removeClass('active');
		$('.box_' + tabId).show();
		$('#' + tabId).addClass('active');
	});
});//end of document ready