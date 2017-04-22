function pca(nodeid,prov,city,area){
	//省
	var api = "http://test.cw2009.com/";
	if(prov!=''){
	$(nodeid+' select.prov').html('<option value="'+prov+'" >'+prov+'</option>');}
	if(city!=''){
	$(nodeid+' select.city').html('<option value="'+city+'" >'+city+'</option>');}
	if(area!=''){
	$(nodeid+' select.area').html('<option value="'+area+'" >'+area+'</option>');}

	$.get(api+'prov',function(data,status){
		var list;
		for (var i = 0; i < data.length; i++) {
			$(nodeid+' select.prov').append('<option value="'+data[i]['name']+'" code="'+data[i]['code']+'">'+data[i]['name']+'</option>');
		}
	});

	//市
	$(nodeid+' select.prov').on('change',function(){
		var code = $(nodeid+' select.prov option:selected').attr('code');
		
		$.get(api+'city/'+code,function(data,status){
			$(nodeid+' select.city').html('');
			var list;
			for (var i = 0; i < data.length; i++) {
				$(nodeid+' select.city').append('<option value="'+data[i]['name']+'" code="'+data[i]['code']+'">'+data[i]['name']+'</option>');
			}
			$(nodeid+' select.area').html('');
			$.get(api+'area/'+data[0]['code'],function(data,status){
				$(nodeid+' select.area').html('');
				var list;
				for (var i = 0; i < data.length; i++) {
					$(nodeid+' select.area').append('<option value="'+data[i]['name']+'" code="'+data[i]['code']+'">'+data[i]['name']+'</option>');
				}
			});
		});
		
	});

	//区
	$(nodeid+' select.city').on('change',function(){
		var code = $(nodeid+' select.city option:selected').attr('code');
		
		$.get(api+'area/'+code,function(data,status){
			$(nodeid+' select.area').html('');
			var list;
			for (var i = 0; i < data.length; i++) {
				$(nodeid+' select.area').append('<option value="'+data[i]['name']+'" code="'+data[i]['code']+'">'+data[i]['name']+'</option>');
			}
		});
	});
}

function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
            + " " + date.getHours() + seperator2 + date.getMinutes()
            + seperator2 + date.getSeconds();
    return currentdate;
}