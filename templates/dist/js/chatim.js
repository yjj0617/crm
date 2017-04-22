var conn;

function creatsocket(uid){
	conn = new WebSocket('ws://crm.cw2009.com:8021');
	conn.onopen = function(e) {
	    console.log("已连接");
	    if(conn.readyState==1){
		     //握手成功后对服务器发送信息
		   conn.send('{"type":"creatsoc","formUid":'+uid+',"utype":"staff"}');
		}
	};

	conn.onmessage = function(e) {
	    console.log(e.data);
	    var d = $.parseJSON(e.data);
	    if(d.type!='creatsoc' && d.type != 'status' && d.type != 'review'){
	    	showmsg(d.formName+'发来'+d.Title,d.msgText);

	    	var cl = $('#chatlog');
	    	if(cl){
		    	if(d.targetUid == 0){
					$('#chatlog').prepend('<dd class="blue"><div><span class="text-color-red">[群发]</span><span class="text-color-blue">'+d.formName+'</span>：'+d.msgText+'<br /><span class="text-color-gray">'+d.sendTime+'</span></div></dd>');
				}else{
					$('#chatlog').prepend('<dd class="blue"><div><span class="text-color-blue">'+d.formName+'</span>@我：'+d.msgText+'<br /><span class="text-color-gray">'+d.sendTime+'</span></div></dd>');
				}
			}
			var mp3uri = encodeURI("http://tts.baidu.com/text2audio?lan=zh&ie=UTF-8&spd=2&text="+ d.formName+"发来"+d.Title+"："+d.msgText);
			var mp3tpl;
			mp3tpl +="<audio autoplay='autoplay'><source src='"+mp3uri+"' type='audio/mp3'></audio>";
			$("body").append(mp3tpl);

			
	    }else if(d.type === 'review'){
	    	try{ 
				if(onlinestaff && typeof(onlinestaff) == "function"){ 
					onlinestaff(); 
				} 
			}catch(e){} 
	    }
	};
	conn.onclose = function () {
		conn.close();
		conn = new WebSocket('ws://crm.cw2009.com:8021');
		conn.onopen = function(e) {
		    console.log("已重新连接");
		    if(conn.readyState==1){
			     //握手成功后对服务器发送信息
			    conn.send('{"type":"creatsoc","formUid":'+uid+',"utype":"staff"}');

			}
		};
	};
	conn.onerror = function () {
		conn.close();
	    conn = new WebSocket('ws://crm.cw2009.com:8021');
		conn.onopen = function(e) {
		    console.log("已重新连接");
		    if(conn.readyState==1){
			     //握手成功后对服务器发送信息
			    conn.send('{"type":"creatsoc","formUid":'+uid+',"utype":"staff"}');
			}
		};
	};

}

function showmsg(title,txt){
	var options = {
		body:txt,
		dir:'auto',
		icon:'/fav128.ico'
		};
	if(!("Notification" in window)){
	    alert('不支持！');
	}else if(Notification.permission === 'granted'){
		var go = new Notification(title,options);
	}else if(Notification.permission !== 'denied'){
		Notification.requestPermission(function(permission){
			if(permission ==='granted'){
	    		var go = new Notification(title,options);
	    	}
		});
	}
}


