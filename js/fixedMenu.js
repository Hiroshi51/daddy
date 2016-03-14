$(document).ready(function(){
    var $fixedMenu = $('#fixedMenu');
    var $categorySection = $('#categorySection');
    var $titleImg = $('.titleImg');
	var $window = $(window);
	var flag = 0;
	var triggerHeight = $categorySection.offset().top-15;
	function displayScroll(){
		
		if ($window.scrollTop() >= triggerHeight && flag == 0) {
		$fixedMenu.css({
			'position':'fixed',
			'top':'15px',
			'width':'343px',
     
			 
		});
		$categorySection.css({
            'margin':'0px',
            'padding':'0px'

		});
		$titleImg.css({
            'margin':'0px 0 10px 0',
            'padding':'0px'

		});
		console.log("fixed");
		flag = 1;
	    }
		else if($window.scrollTop() <= triggerHeight && flag == 1) {
		$fixedMenu.css({
			'position':'relative',
			'top':'0px'
		
		});	
		$categorySection.css({
            'margin':'30px 0 20px 0'
          

		});
		$titleImg.css({
            'margin':'10px 0'
          

		});	
		console.log("released");
		flag = 0;
		}
	}
	$window.on("load scroll",function(){
	displayScroll();
	});
});