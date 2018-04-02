(function($){
	$(function() { 
		/*确认退出层*/
		$('.sign-out>a').click(function() {
			$(this).parents('body').find('.outlayer').slideDown(200);
		});
		$('.tip-box .cancel').click(function(){
			$(this).parents('.outlayer').slideUp(200);
		});
		
		/*展示选择框*/
		$('.show-btn').click(function(){
			$(this).siblings('.checkshow').toggle().siblings('.goin').toggle();
			$(this).parents('body').find('.cover-bg').show();
		});
		$('.close').click(function(){
			$(this).parent('.checkshow').hide().parents('body').find('.cover-bg').hide();
		});
		$('.checkshow>p').click(function(){
			$(this).addClass('checked').siblings().removeClass('checked');
		});
		$('.sex>label').click(function(){
			$(this).addClass('sex-check').siblings().removeClass('sex-check');
			$('#gender').val($(this).data('gender'));
		});
		$('.hd>li').click(function(){
			var index=$(this).index();
			console.log(index)
			$(this).addClass('active').siblings().removeClass('active');
			$('.bd>div').eq(index).show().siblings().hide();
		});
	
		$('.notice-content a:even').css('background','#eee');
		
		/* $(document).on("click", ".page-item", function (e) {
	          $(this).addClass('active');
	        });*/
	    
	});  
})(jQuery);