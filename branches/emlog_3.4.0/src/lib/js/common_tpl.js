function focusEle(ele){
	try {document.getElementById(ele).focus();}
	catch(e){}
}
function displayToggle(ele) {
	var ele = document.getElementById(ele);
	ele.style.display = ele.style.display == 'none' ? '' : 'none' ;
}
function hideEle(ele) {
	document.getElementById(ele).style.display == 'none';
}
function showEle(ele){
	document.getElementById(ele).style.display == '';
}
function updateEle(ele,content){
	document.getElementById(ele).innerHTML = content;
}
function timestamp(){
	return new Date().getTime();
}
function showhidediv(id){
	displayToggle(id);
	var input_id=arguments[1];
	if(input_id){focusEle(input_id);}
}
function keyw(){
	if (document.keyform.keyword.value==""){
		alert("请输入要搜索的关键字");
		document.keyform.keyword.focus();
		return false;
	}
}
function checkEmail (str){
	isEmail1=/^\w+([\.\-]\w+)*\@\w+([\.\-]\w+)*\.\w+$/;
	return (isEmail1.test(str));
}
function checkform(){
	if (document.commentform.comname.value==""){
		alert("名字不能为空");
		document.commentform.comname.focus();
		return false;
	}
	if(document.commentform.comname.value.length>16){
		alert("名字太长");
		document.commentform.comname.focus();
		return false;
	}
	if(document.commentform.comment.value.length==""){
		alert("评论内容不能为空");
		document.commentform.comment.focus();
		return false;
	}
	if(document.commentform.comment.value.length>2000){
		alert("评论内容太长");
		document.commentform.comment.focus();
		return false;
	}
	if(document.commentform.commail.value!=""){
		if(!checkEmail(document.commentform.commail.value)){
			alert("邮件地址格式错误！");
			document.commentform.commail.focus();
			return false;
		}
	}
}
function isdel (id,type,url){
	if(type == 'twitter'){
		var msg = "你确定要删除吗？";
		if(confirm(msg)){sendinfo(url+'twitter.php?action=del&twid='+id,'twitter')}
		else {return;}
	}
}
var XMLHttp = {  
	_objPool: [],
	_getInstance: function () {
		for (var i = 0; i < this._objPool.length; i ++) {
			if (this._objPool[i].readyState == 0 || this._objPool[i].readyState == 4) {
				return this._objPool[i];
			}
		}
		this._objPool[this._objPool.length] = this._createObj();
		return this._objPool[this._objPool.length - 1];
	},
	_createObj: function(){
		if (window.XMLHttpRequest){
			var objXMLHttp = new XMLHttpRequest();
		} else {
			var MSXML = ['MSXML2.XMLHTTP.5.0', 'MSXML2.XMLHTTP.4.0', 'MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP', 'Microsoft.XMLHTTP'];
			for(var n = 0; n < MSXML.length; n ++){
				try{
					var objXMLHttp = new ActiveXObject(MSXML[n]);
					break;
				}catch(e){}
			}
		}
		if (objXMLHttp.readyState == null){
			objXMLHttp.readyState = 0;
			objXMLHttp.addEventListener('load',function(){
				objXMLHttp.readyState = 4;
				if (typeof objXMLHttp.onreadystatechange == "function") {  
					objXMLHttp.onreadystatechange();
				}
			}, false);
		}
		return objXMLHttp;
	},
	sendReq: function(method, url, data, callback){
		var objXMLHttp = this._getInstance();
		with(objXMLHttp){
			try {
				if (url.indexOf("?") > 0) {
					url += "&randnum=" + Math.random();
				} else {
					url += "?randnum=" + Math.random();
				}
				open(method, url, true);
				setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				send(data);
				onreadystatechange = function () {  
					if (objXMLHttp.readyState == 4 && (objXMLHttp.status == 200 || objXMLHttp.status == 304)) {  
						callback(objXMLHttp);
					}
				}
			} catch(e) {
				alert('emria:error');
			}
		}
	}
};
function sendinfo(url,node){
	updateEle(node,"<div><span style=\"background-color:#FFFFE5; color:#666666;\">加载中...</span></div>");
	XMLHttp.sendReq('GET',url,'',function(obj){updateEle(node,obj.responseText);});
}
function postinfo(url,post_id,node){
	updateEle(node,"<div><span style=\"background-color:#FFFFE5; color:#666666;\">处理中...</span></div>");
	var pdata = document.getElementById(post_id).value;
	var data = post_id+"="+encodeURIComponent(pdata);
	XMLHttp.sendReq('POST',url,data,function(obj){updateEle(node,obj.responseText);});
}