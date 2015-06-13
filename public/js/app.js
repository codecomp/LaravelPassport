(function($) {

	$(document).ready(function(){
		$('.sidebar-menu > li a').click(function(){
			var $menu_item 	= $(this).parent();
			var $sub_menu 	= $(this).siblings('.sub-menu');

			if( $menu_item.hasClass('open') && !$menu_item.hasClass('active') ){
				$menu_item.removeClass('open');
			} else {
				$menu_item.addClass('open');
			}

		});


		$('.confirm-delete').confirmation({
			trigger: 'click',
			placement: 'bottom',
			singleton: true,
			popout: true,
			onConfirm: function(event, element) {
				element.closest('form').submit();
			}
		})
	});

})(jQuery);