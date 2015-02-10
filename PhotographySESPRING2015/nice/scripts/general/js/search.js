
$(function(){

	console.log("executed");

	$('div.search form.search input[type=text]').keyup(function(){
	
		console.log("trigger hit");
		
		if($(this).val() ==""){
			$('div.search div.results').removeClass('show').html("");
		}else{
			var data = $( "div.search form.search" ).serialize();
			
			
			$.ajax({
				type: 'POST',
				data: data,
				url: 'scripts/general/php/search.php',
				success: function(newdata){
					$('div.search div.results').addClass('show').html(newdata);
					
					$('.search div.results p').click(function(){
						var data = $(this).html();
						
						var name = data.split(', ');
						$('div.search form.hidden input[name=last]').val(name[0]);
						$('div.search form.hidden input[name=first]').val(name[1]);
						$('div.search form.hidden').submit();
					});
				}
			});
		}
	
	});
});

$(':not(input[name=search])').click(function(){
	$('div.search div.results').removeClass('show').html("");
});


