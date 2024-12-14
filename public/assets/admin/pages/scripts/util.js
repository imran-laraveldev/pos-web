	function submitForm(){ 
		//selectAllOptions("selected_screens");	
		//selectAllOptions("supplier_id");
		sub= true;
		if(window.validation){
			if(!validation()){
				sub=false;
			}	
		}
		
		if(sub){
			change_date_format(cal_params);
			document.getElementById('mainForm').submit();
		}
	}

	function add(){
		
		var str_loc = window.location;
		var arr = str_loc.toString();
		var start = arr.indexOf('display')-1;
		var end = arr.length;
		//alert(start+' , '+end);
		if(start > 0){
			arr = arr.substring(0,start);
		}
		var start1 = arr.indexOf('#');
		if(start1 > 0){
			arr = arr.substring(0,start1);
		}
		
		window.location = arr + '/add';
	}

	function edit(ctrl, method){

		
			v = null;				
			count = document.getElementById('count').value;		
			for(i=1;i<=count;i++){
				if(document.getElementById('selected_id_'+i)){
					c = document.getElementById('selected_id_'+i);
					if(c.checked){
						v = document.getElementById('selected_id_'+i).value;
						break;
					}
				}
			}
			
		if(v!=null){
			if( method != null) {
				url = '/confms/'+ctrl+'/printhtml/'+v ;
				//alert(url);
				window.open(url,'_blank');
				//callAJAX(url , 1);
			}else{
				var str_loc = window.location;
				var arr = str_loc.toString();
				var start = arr.indexOf('display')-1;
				var end = arr.length;
				//alert(start+' , '+end);
				if(start > 0){
					arr = arr.substring(0,start);
				}
				var start1 = arr.indexOf('#');
				if(start1 > 0){
					arr = arr.substring(0,start1);
				}
				//var url = arr + '/edit/' + v;
				window.location = arr + '/edit/' + v;
				//callAJAX(url , 1);
			}
		}else{
			alert('Please select a record to take this action!');
		}
	}

	function del(){
		var v = '';
		count = document.getElementById('count').value;		
		for(i=1; i<=count; i++){
			if(document.getElementById('selected_id_'+i)){
				c = document.getElementById('selected_id_'+i);
				if(c.checked){
					v += document.getElementById('selected_id_'+i).value;
					v+=",";
				}
			}
		}
		
		if(v!=''){
			v = v.substring(0, v.length-1);
			var str_loc = window.location;
			var arr = str_loc.toString();
			var start = arr.indexOf('display')-1;
			var end = arr.length;
			//alert(start+' , '+end);
			if(start > 0){
				arr = arr.substring(0,start);
			}
			var start1 = arr.indexOf('#');
			if(start1 > 0){
				arr = arr.substring(0,start1);
			}
			if(confirm("Are you sure to delete selected record?")){
				window.location = arr + '/delete?selected_id=' + v;
			}
		}else{
			alert('Please select a record to delete!');
		}
	}
	
	function isNumber(code)
	{
	    if( (code >=48 && code <= 57) )
	    {
	        return true;
	    }
	    else
	    {
	        return false;            
	    }            
	}

	function isSkip(key)
	{
	    if(key ==0 || key == 8)
	        return true;
	    else
	        return false;
	}
	function keyPressAllowFloatOnly(e,me) 
	{
	    var key = window.event ? window.event.keyCode : e.which;
		//var newme = me.value;
		
	    //var prefixLengthCheck = ((me.value.substring(0,(me.value.indexOf('.')<0)?me.value.length:me.value.indexOf('.')).length<pre ));
	    	
		//var prefixLengthCheck = newme.substring(0,(newme.indexOf('.')<0)?newme.length:newme.indexOf('.')).length<=pre;
	    //var postfixLengthCheck = newme.substring((newme.indexOf('.')<0)?newme.length:newme.indexOf('.'),newme.length).length<=post;
		
	    if((isNumber(key) || (key == 46 && me.value.indexOf('.')<0)) || isSkip(key) )    
	    {
	        return true;
	    }
	    else
	    {
	        if(window.event)window.event.returnValue = false;
	        if(e.preventDefault)e.preventDefault();
	        return false;
	    }
	}
	function keyPressAllowIntOnly(e) 
	{
	    var key = window.event ? window.event.keyCode : e.which;
	    if(isNumber(key) || isSkip(key))
	    {
	        return true;
	    }
	    else
	    {
	        if(window.event)window.event.returnValue = false;
	        if(e.preventDefault)e.preventDefault();
	        return false;
	    }
	}
	function keyPressAllowCommaSepIntOnly(e){
		var key = window.event? window.event.keyCode : e.which;
		if(key == 44){
			return true;
		}
		if(keyPressAllowIntOnly(e)){
			return true;
		}
		return false;
	}

	function keyPressAllowLowerCapsAlphaOnly(e) 
	{
	    var key = window.event ? window.event.keyCode : e.which;
		
	    if( (key >= 97  && key <= 122) || isSkip(key))    
	    {
	        return true;
	    }
	    else
	    {
	        if(window.event)window.event.returnValue = false;
	        if(e.preventDefault)e.preventDefault();
	        return false;
	    }
	}

	function keyPressAllowIntOnlyWithEnterKey(e) 
	{
	    var key = window.event ? window.event.keyCode : e.which;
	    if(key == 13 || key == 3){// allowing enter key
	    	return true;
	    }
	    if(isNumber(key) || isSkip(key))
	    {
	        return true;
	    }
	    else
	    {
	        if(window.event)window.event.returnValue = false;
	        if(e.preventDefault)e.preventDefault();
	        return false;
	    }
	}
	
	function roundVal(val){
		
		return  Math.round(val*Math.pow(10,2))/Math.pow(10,2);
	}
	
	function roundNumber(val, n){
		
		return  Math.round(val*Math.pow(10,n))/Math.pow(10,n);
	}