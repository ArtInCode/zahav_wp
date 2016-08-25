var Quize = {


};

$(document).ready(function () {
	//$(".wpcf7").attr('dir','rtl');
	var points = 0;
	var wrapID = 0;
	var currentWrap = 0; 
	var clickOunt = 0; 
	$(".cool-checkbox").change(function () {
		points += ($(this).val() - 0);
		wrapID = ($(this).data("wrap") - 0);
		$(this).addClass('checked-item');
		currentWrap = wrapID - 1; 
		setTimeout(function () {
			
			$("#wrap-num-"+currentWrap ).hide();
			$("#wrap-num-"+wrapID).show();
			clickOunt++;
			if(clickOunt==6){
				if(points>=10){
					$("#above").show();
				}else{
					$("#bellow").show();
				}
				//alert("Done");
			}

		}, 1000);
		
		
		//alert(points+"| wrapID"+wrapID); 
	});
});  