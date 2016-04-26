function _getElementById(id){
  var item = null;

  if (document.getElementById){
    item = document.getElementById(id);
  } else if (document.all){
    item = document.all[id];
  } else if (document.layers){
    item = document.layers[id];
  }

  return item;
}


function show_bbsclinent(){
	//showdiv="showsqury";
//alert(showdiv);
	JsHttpRequest.query(
		"query.php",
		{
			   "tas": 'show_bbsclinent' //show_save_max_1
		},
		function (result, errors) {

			  if (result) {
			    erdiv=document.getElementById('test');
			    out_macc= result['out_macc'];
			    out_nick= result['out_nick'];
			    out_url= result['out_url'];
			    //erdiv.innerHTML=out_macc;
			    arr_out_macc = out_macc.split(';');
			    arr_out_nick = out_nick.split(';');
			    arr_out_url = out_url.split(';');

			    //alert(arr_out_macc.length);
			    //alert(arr_out_nick.length);
			    n=0
			    // arr_out_nick.length
				while (n <= arr_out_nick.length) {
					try{
					erdiv=document.getElementById(arr_out_macc[n]);
					erdiv.innerHTML=arr_out_nick[n]+"\\"+arr_out_url[n];
					//alert(arr_out_url[n]);
					}
					catch(er){
					//	alert("ошибка");
					}

					//alert(arr_out_macc[n]);
					n++
				}

			  	//erdiv.innerHTML=result[arr_out_nick[14]];

			  }else {
			  erdiv=document.getElementById('test');
			  erdiv.innerHTML="error \""+errors+"\"";
			  }

		},true
	);

}
