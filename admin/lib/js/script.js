//misc
	function gebi(s) {return document.getElementById(s);}
	function givs(s) {var v=document.getElementById(s).innerHTML; while(v.indexOf(',')>-1) {v=v.replace(',','');} return new Number(v);}
	function isNumeric(s) {var vc="0123456789.,"; for (i=0;i<s.length;i++) {if (vc.indexOf(s.charAt(i))==-1) {return false;}} return true;}
	function checkFldNum(s) {return isNumeric(gebi(s).value);}
	function getFldVal(s)  {var f=gebi(s); var v=f.value; while(v.indexOf(',')>-1) {v=v.replace(',','');} return new Number(v);}
	function castIntFld(s) {var f=gebi(s); var v=f.value; while(v.indexOf(',')>-1) {v=v.replace(',','');} if (v=="" || !isNumeric(v) || v<0) {f.value="0";}    else {f.value=addCommas((new Number(v)).toFixed(0));}}
	function castDblFld(s) {var f=gebi(s); var v=f.value; while(v.indexOf(',')>-1) {v=v.replace(',','');} if (v=="" || !isNumeric(v) || v<0) {f.value="0.00";} else {f.value=addCommas((new Number(v)).toFixed(2));}}
	function addCommas(s) {s += ''; x=s.split('.'); x1=x[0]; x2=(x.length>1 ? '.'+x[1]:''); var rgx=/(\d+)(\d{3})/; while (rgx.test(x1)) {x1=x1.replace(rgx,'$1'+','+'$2');} return x1+x2;}
	function randomize(s) {var f=gebi(s); var v=''; for(var i=0;i<f.value.length;i++){v+=String.fromCharCode(Math.floor(Math.random()*26)+97);} f.value=v;}
	function dologin(s) {gebi('hash').value=md5(s+gebi('pwd').value); randomize('pwd');}
	function go(s) {window.location.href=s;}

	function popup(s)      {w=window.open(s,'popup',      'titlebar=no,toolbar=no,scrollbars=yes,resizable=yes,location=no,statusbar=yes,address=no,width=800,height=600'); w.focus();}
	function popupSmall(s) {w=window.open(s,'popup_small','titlebar=no,toolbar=no,scrollbars=yes,resizable=yes,location=no,statusbar=yes,address=no,width=250,height=120'); w.focus();}
	function popupPrint(s) {w=window.open(s,'popup_print','titlebar=no,toolbar=no,scrollbars=yes,resizable=yes,location=no,statusbar=yes,address=no,width=800,height=600'); w.focus(); w.print();}

//search
	function updateFilter() {document.fs.s_crit.value=document.f.s_crit.value; document.fs.s_filter.value=document.f.s_filter.value;}
	function showFull() {document.fs.s_filter.value=''; document.fs.l_pgn.value='1'; document.fs.submit();}

//paging
	function changePage(n) {document.fs.l_pgn.value=n; document.fs.submit();}
	function changePage(n) {document.fs.l_pgn.value=n; document.fs.submit();}
	function addNew() {document.fa.submit();}
	function editRec(id) {document.fe.id.value=id; document.fe.submit();}
	function delRec() {
		if (document.fd.del_id.value=='') {alert('No records selected.');}
		else if(confirm('Confirm delete selected rows?')) {document.fs.del_id.value=document.fd.del_id.value; document.fs.submit();}
	}
	function changeRpp(n) {document.fs.l_pgn.value=1; document.fs.l_rpp.value=n; document.fs.submit();}

//listing
	function writeChk(pfx,outfld){
		var sval = outfld.value;
		if (sval!="") {
			val=sval.split(",");
			for (var i=0;i<val.length;i++){
				gebi(pfx+val[i]).checked=true;
			}
		}
	}
	function rewriteChk(pfx,outfld){
		var sval = "";
		for(i=0; i<document.f.elements.length; i++) {
			var fld = document.f.elements[i];
			if(fld.type=="checkbox" && fld.name.substring(0,pfx.length)==pfx && fld.checked){
				sval+=(","+fld.name.substring(pfx.length));
			}
		}
		if (sval!="") {sval=sval.substring(1);}
		outfld.value=sval;
	}

	function checkAll(pfx,v){
		for(i=0; i<document.f.elements.length; i++) {
			var fld = document.f.elements[i];
			if(fld.type=="checkbox" && fld.name.substring(0,pfx.length)==pfx) {fld.checked=v;}
		}
	}

	function changeSort(o,d) {document.fs.l_ord.value=o; document.fs.l_dir.value=d;	document.fs.submit();}