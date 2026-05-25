	function GetXmlHttpObject(){
		var xmlHttp=null;

		try {xmlHttp=new XMLHttpRequest();} // Firefox, Opera 8.0+, Safari
  		catch (e){
			try {xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");} // Internet Explorer
			catch (e){
				try {xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");} // Internet Explorer 5.5
	  			catch (e) {xmlHttp=null;}
	  		}
	  	}

		if (xmlHttp==null) {alert ("Your browser does not support AJAX!");}
	  	return xmlHttp;
	}

	//------------------------------------------------------------------------------------------------

	var fld = "";
	var mtd = "";

	function ajax(fn,q,m,f,msg){
		if (q=="") return;
		xmlHttp=GetXmlHttpObject(); if (xmlHttp==null) {return;}

		mtd = m;
		fld = f;

		if (mtd=="span") {gebi(fld).innerHTML=msg;}

		var url="__ajax.php";
		url=url+"?fn="+fn;
		url=url+"&m="+m;
		url=url+"&f="+f;
		url=url+"&q="+q;
		url=url+"&seed="+Math.random();
		xmlHttp.onreadystatechange=ajaxResponse;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}

	function ajaxResponse()  {
		if (xmlHttp.readyState==4) {
			if (mtd=="eval") {eval(xmlHttp.responseText);}
			if (mtd=="span") {gebi(fld).innerHTML=xmlHttp.responseText;}
			if (mtd=="field") {gebi(fld).value=xmlHttp.responseText;}
		}
	}