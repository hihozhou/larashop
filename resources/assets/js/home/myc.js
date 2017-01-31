var myc = (function(){
	//判断手机号码是否正确
	function regularPhoneNumber(str) {
		var s = str.replace(/\s|\-/g, '');
		if(s.indexOf("+86") == 0) {
			s = s.substr(3);
		}
		var d = /^1\d{10}$/g;
		if(d.test(s)) {
			return s;
		} else {
			return null;
		}
	}
	//定时器
	function repeat(f, t, c) {
		var count = 0;
		return setTimeout(function() {
			if (f(++count) === false) return;
			else if (c && count >= c) return;
			else setTimeout(arguments.callee, t);
		}, t);
	}

	//弹出框
	function alert(obj,callback){				
		var msg = obj.msg || '';
		if(obj.buttons){			
			var buttons = obj.buttons;								
		}else{
			var buttons = ['确定'];
		}
		if(document.getElementById("alertbackground")){
			document.getElementById("alertbackground").style.display = 'block';
			document.getElementById("alertContainer").style.display = 'block';
		}else{
			var html = '<div id="alertbackground" style="position: fixed;left: 0;top: 0px;width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);z-index:9999999;font-size:14px;"></div><div id="alertContainer" style="position: fixed;left: 50%;top: 50%;-webkit-transform: translateX(-50%) translateY(-50%);-moz-transform: translateX(-50%) translateY(-50%);-ms-transform: translateX(-50%) translateY(-50%);-o-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);width: 300px;height: auto;z-index: 9999999;background-color: #fff;text-align: center;border-radius: 7px;font-size:14px;"><div id="alertMsg"  style="padding: 20px 10px;word-break:break-all;word-wrap:break-word;font-size:14px;"></div><div id="alertBtnContainer" style="position: relative;height: 40px;line-height: 40px;border-top: 1px solid #e1e1e1;font-size:14px;"></div></div>';
			document.body.insertAdjacentHTML('beforeEnd', html);
		}
		
		document.getElementById("alertMsg").innerHTML = msg;		
		
		
		var btnStyle = '<div style="position: absolute;left: 0;width: 100%;">'+ buttons[0];
		document.getElementById("alertBtnContainer").innerHTML = btnStyle;
	
		var divs = document.getElementById("alertBtnContainer").querySelectorAll('div');
		for(var i = 0; i < divs.length; i++){
			divs[i].addEventListener('click',function(){
				if(callback && typeof(callback) == 'function'){
					callback();
					alertHide();
				}else{
					alertHide();
				}
			},false);
		}
		document.getElementById("alertbackground").addEventListener('click',function(){
			event.stopPropagation();
			event.preventDefault();
			alertHide();
		},false);

		function alertHide(){
			document.getElementById("alertbackground").style.display = 'none';
			document.getElementById("alertContainer").style.display = 'none';
		}
	}
	//弹出带两个或三个按钮的confirm对话框
	function confirm(obj,callback){				
		var title = obj.title || '淘美';
		var msg = obj.msg || '';
		if(obj.buttons){
			if(obj.buttons.length == 1){					
				var buttons = [obj.buttons[0], '取消'];
			}else{
				var buttons = obj.buttons;
			}					
		}else{
			var buttons = ['确定', '取消'];
		}
		if(document.getElementById("confirmbackground")){
			document.getElementById("confirmbackground").style.display = 'block';
			document.getElementById("confirmContainer").style.display = 'block';
		}else{
			var html = '<div id="confirmbackground" style="position: fixed;left: 0;top: 0px;width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);z-index:9999999;font-size:14px;"></div><div id="confirmContainer" style="position: fixed;left: 50%;top: 50%;-webkit-transform: translateX(-50%) translateY(-50%);-moz-transform: translateX(-50%) translateY(-50%);-ms-transform: translateX(-50%) translateY(-50%);-o-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);width: 300px;height: auto;z-index: 9999999;background-color: #fff;text-align: center;border-radius: 7px;font-size:14px;"><div id="confirmMsg"  style="min-height: 50px;padding: 10px;word-break:break-all;word-wrap:break-word;font-size:14px;"></div><div id="confirmBtnContainer" style="position: relative;height: 41px;line-height: 40px;border-top: 1px solid #e1e1e1;font-size:14px;"></div></div>';
			document.body.insertAdjacentHTML('beforeEnd', html);
		}
		
//		document.getElementById("confirmTitle").innerHTML = title;			
		document.getElementById("confirmMsg").innerHTML = msg;		
		
		if(buttons.length <= 2){
			var btnStyle = '<div style="position: absolute;left: 0;width: 50%;border-right: 1px solid #e1e1e1;font-size:14px;">'+ buttons[0] +'</div><div style="position: absolute;right: 0;width: 50%;font-size:14px;">'+ buttons[1] +'</div>';
			document.getElementById("confirmBtnContainer").innerHTML = btnStyle;
		}else{
			var btnStyle = '<div style="position: absolute;left: 0;width: 33.3%;border-right: 1px solid #e1e1e1;font-size:14px;">'+ buttons[0] +'</div><div style="position: absolute;left:33.3%;width: 33.3%;border-right: 1px solid #e1e1e1;font-size:14px;">'+ buttons[1] +'</div><div style="position: absolute;right: 0;width: 33.3%;font-size:14px;">' + buttons[2] + '</div>';
			document.getElementById("confirmBtnContainer").innerHTML = btnStyle;
		}
		var divs = document.getElementById("confirmBtnContainer").querySelectorAll('div');
		for(var i = 0; i < divs.length; i++){
			divs[i].setAttribute('index',i);
			divs[i].addEventListener('click',function(){
				var index = ~~this.getAttribute('index') + 1;
				if(callback && typeof(callback) == 'function'){
					callback({buttonIndex : index});
					confirmHide();
				}
			},false);
		}
		document.getElementById("confirmbackground").addEventListener('click',function(){
			confirmHide();
		},false);
		document.getElementById("confirmbackground").addEventListener('click',function(){
			event.stopPropagation();
			event.preventDefault();
		},false);
		function confirmHide(){
			document.getElementById("confirmbackground").style.display = 'none';
			document.getElementById("confirmContainer").style.display = 'none';
		}
	}
	
	//吐丝
	var toastTimer = null;
	function toast(obj){
		if(document.getElementById("toastContainer")){
			document.body.removeChild(document.getElementById("toastContainer"));
		}					
		if(obj.location == 'top'){
			var duration = 'top:20px;';
			var translate = '-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);transform: translateX(-50%);';
		}else if(obj.location == 'middle'){
			var duration = 'top:50%;';
			var translate = '-webkit-transform: translateX(-50%) translateY(-50%);-moz-transform: translateX(-50%) translateY(-50%);-ms-transform: translateX(-50%) translateY(-50%);-o-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);';
		}else if(obj.location == 'bottom'){
			var duration = 'bottom:20%;';
			var translate = '-webkit-transform: translateX(-50%) translateY(-50%);-moz-transform: translateX(-50%) translateY(-50%);-ms-transform: translateX(-50%) translateY(-50%);-o-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);';
		}else{
			var duration = 'top:50%;';
			var translate = '-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);transform: translateX(-50%);';
		}
		var seed = (obj.duration / 1000) || 2;
		var location = '-webkit-animation: toastFrames 1s '+ seed +'s forwards;-moz-animation: toastFrames 1s'+ seed +'s forwards;-ms-animation: toastFrames 1s '+ seed +'s forwards;-o-animation: toastFrames 1s forwards'+ seed +'s;animation: toastFrames 1s ' + seed + 's forwards;';
		
		var style = '<style>@-webkit-keyframes toastFrames{from{opacity: 1;}to{opacity: 0;display:none;}}@-moz-keyframes toastFrames{from{opacity: 1;}to{opacity: 0;display:none;}}@-o-keyframes toastFrames{from{opacity: 1;}to{opacity: 0;display:none;}}@-ms-keyframes toastFrames{from{opacity: 1;}to{opacity: 0;display:none;}}</style>';
		
		var html = style + '<div id="toastContainer" style="position: fixed;'+ duration +'left: 50%;font-size:14px;	width: 100%;z-index: 9999999;text-align: center;'+ translate + location +'"><span style="display: inline-block;	max-width: 80%;padding: 10px 20px;border-radius: 7px;word-break:break-all;word-wrap:break-word;background-color: rgba(0,0,0,0.5);color: #fff;" id="toastText"></span></div>';
		
		document.body.insertAdjacentHTML('beforeEnd', html);
		document.getElementById("toastText").innerText = obj.msg;	
		document.getElementById("toastContainer").addEventListener('touchmove',function(){
			event.stopPropagation();
			event.preventDefault();
		},false);
		if(toastTimer){
			clearTimeout(toastTimer);
		}
		var timeout = parseInt((seed+1)*1000); 
		toastTimer = setTimeout(function(){			
			if(document.getElementById("toastContainer")){
				document.body.removeChild(document.getElementById("toastContainer"));
			}
		},timeout);
	}
	//显示进度图层
	function showProgress(obj){
		if(obj){
			var rgba = obj.rgba || 0.3;
		}else{
			var rgba = 0.3;
		}
		
		if(document.getElementById("showProgressContainer")){
			document.getElementById("showProgressBackground").style.display = 'block';
			document.getElementById("showProgressContainer").style.display = 'block';
			document.getElementById("showProgressBackground").removeEventListener("touchstart",showProgressTouch);
			document.getElementById("showProgressBackground").removeEventListener("touchmove",showProgressTouch);
		}else{
			var html = '<div id="showProgressBackground" style="position: fixed;width: 100%;height: 100%;left: 0;top: 0;background-color: rgba(0,0,0,'+ rgba +');z-index:999999;font-size:14px;"></div><div id="showProgressContainer" style="position: fixed;left: 50%;top: 50%;-webkit-transform:  translateX(-50%) translateY(-50%);-moz-transform:  translateX(-50%) translateY(-50%);-ms-transform:  translateX(-50%) translateY(-50%);-o-transform:  translateX(-50%) translateY(-50%);transform:  translateX(-50%) translateY(-50%);background-color: rgba(0,0,0,1);color: #fff;padding: 15px;border-radius: 5px;text-align: center;min-height: 85px;min-width: 85px;z-index:999999;font-size:14px;"><div class="showProgressLoading"></div><div id="showProgressTitle" style="padding: 5px 0;color:#fff;font-size:14px;"></div><div id="showProgressText" style="color:#fff;font-size:14px;"></div></div>';
			
			document.body.insertAdjacentHTML('beforeEnd', html);
		}
		if(obj){
			var title = obj.title || '努力加载中...';
			var text = obj.text || '请稍候...';
			var modal = obj.modal || true;
		}else{
			var title = '努力加载中...';
			var text = '请稍候...';
			var modal = true;
		}
		document.getElementById("showProgressTitle").innerHTML = title;
		document.getElementById("showProgressText").innerHTML = text;
		
		if(modal){
			document.getElementById("showProgressBackground").addEventListener('touchstart',showProgressTouch,false);
			document.getElementById("showProgressBackground").addEventListener('touchmove',showProgressTouch,false);
		}	
	}
	function showProgressTouch(){
		event.stopPropagation();
		event.preventDefault();
	}
	//隐藏进度图层
	function hideProgress(){
		if(document.getElementById("showProgressContainer")){
			document.getElementById("showProgressBackground").style.display = 'none';
			document.getElementById("showProgressContainer").style.display = 'none';
		}
	}
	function getTime(time) {
	    if (time) {
	        var yy = time.getYear() + 1900;
	        var MM = time.getMonth() + 1;
	        var dd = time.getDate();
	        var HH = time.getHours();
	        var mm = time.getMinutes();
	        var ss = time.getSeconds();
	
	        return yy + "-" + bl(MM) + "-" + bl(dd);
//	        return yy + "-" + bl(MM) + "-" + bl(dd) + " " + bl(HH) + ":" + bl(mm) + ":" + bl(ss);
	    }
	    else {
	        time = new Date();
	        var yy = time.getYear() + 1900;
	        var MM = time.getMonth() + 1;
	        var dd = time.getDate();
	        var HH = time.getHours();
	        var mm = time.getMinutes();
	        var ss = time.getSeconds();
	
	        return yy + "-" + bl(MM) + "-" + bl(dd);
//	        return yy + "-" + bl(MM) + "-" + bl(dd) + " " + bl(HH) + ":" + bl(mm) + ":" + bl(ss);
	    }
	}
	function bl(s) {
	    return s < 10 ? '0' + s: s;
	}
	
	return {
		alert: alert,
		confirm : confirm,
		toast : toast,
		showProgress : showProgress,
		hideProgress : hideProgress,
		repeat : repeat,
		getTime : getTime,
		regularPhoneNumber:regularPhoneNumber
	};
})();