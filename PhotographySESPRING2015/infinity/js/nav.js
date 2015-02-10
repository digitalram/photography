var overBut = false;
var overDrop = false;
var publish = 1;

$('#top_nav ul li.master').hover(function(){
	$('#top_nav div').show();
	overBut=true;
}, function(){
	overBut=false;
	if(!(overDrop)){
		$('#top_nav div').hide();
	}	
});

$('#top_nav div').hover(function(){
	overDrop = true;
}, function(){
	overDrop = false;	
	if(!(overDrop)){
		$('#top_nav div').hide();
	}	
});


//changes the active nav button and gets the new data VIA AJAX
$('#top_nav ul li a').click(function(){	
	
	curVal = $(this).attr('href');
	var curPage=window.location.href.split("=");
	
	
	if(curPage[1] != curVal){
		
		if(curVal != "faq.php"){
			$('div.pdf').fadeIn(500);	
		}else{
			$('div.pdf').fadeOut(500);	
		}
		
		
		$.ajax({
			type: 'POST',
			url: 'publish.php',
			success: function(data){
				publish = data;	
				
				
				if(publish == 1 || curVal == 'faq.php'){
					
					$('#wrapper').hide("slide",{direction: 'up'},800);
						
					$.ajax({
						type: 'POST',
						url: curVal,
						success: function(newdata){
							
							
								
								$('#wrapper').html(newdata);
								
								history.pushState({}, 'title', '?id=' + curVal);
								
								var curPage=window.location.href.split("=");
				
								$('#top a[href$="' + curPage[1] +'"]').addClass('current');
								
								$('#wrapper').show("slide",{direction: 'up'},800, function(){});
								
						}
					
					});
				}
		
		
			}
		});
	}
	
	return false;
});
