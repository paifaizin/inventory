$('#add-det-stock').click(function(){
	var html = $("#child-det").html();
	var cont =  $("#child-det").parent();

	cont.append('<div>'+html+'</div>');

	return false;

});

$('#searchproduk').autocomplete({
        source:  "/product/searchjson" ,
        minlength:3,
        autofocus:true,
        select:function(event,ui){
        	console.log(ui);
          $("#searchproduk").val(ui.item.value);
          $("#idproduk").val(ui.item.id);
        }
  });