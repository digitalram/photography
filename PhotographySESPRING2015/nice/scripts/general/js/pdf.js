$().ready(function(){
	$('div.pdf .button').click(function(){	
	
	if($(this).parent().hasClass('pdfshow')){
		$('div.pdf').removeClass('pdfshow');
		$(this).html('<');
	}else{
		$('div.pdf').addClass('pdfshow');
		$(this).html('>');
	}
		
	});
});
$('div.pdf p a').click(function(){
	
	
    

$('#wrapper').print();


	
});