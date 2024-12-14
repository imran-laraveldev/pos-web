
	var _dynControl;
	var _showLoader = true;
	var _showErrConsole = false;
	var _http_request = false;
	function makeRequest(url, parameters) 
	{
		_http_request = false;
		if (window.XMLHttpRequest) 
		{ 
			_http_request = new XMLHttpRequest();
			if (_http_request.overrideMimeType) 
			{
				_http_request.overrideMimeType('text/html');
			}
		} 
		else if (window.ActiveXObject) 
		{ 
			try 
			{
				_http_request = new ActiveXObject("Msxml2.XMLHTTP");
			} 
			catch (e) 
			{
				try 
				{
				_http_request = new ActiveXObject("Microsoft.XMLHTTP");
				} 		
				catch (e) {}
			}
		}
		if (!_http_request) 
		{
			alert('Cannot create XMLHTTP instance');
			return false;
		}
		_http_request.onreadystatechange = displayContents;
		_http_request.open('POST', url, true);
		_http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//_http_request.setRequestHeader("Content-length", parameters.length);
		//_http_request.setRequestHeader("Connection", "close");
		_http_request.send(parameters);
	}

	function displayContents() 
	{
		if (_http_request.readyState == 4) 
		{
			
			if (_http_request.status == 200) 
			{
				
				//if(_showErrConsole==true)				
				if(_showLoader==true)
				{
					
					 try{
						 document.getElementById('imgLoader').style.display='none';
						 document.getElementById('mainPageBody').style.opacity=1;
						 document.getElementById('mainPageBody').style.filter="alpha(opacity=100)";
				    }catch(e){}
				}
				result = _http_request.responseText;
				
				if(_showErrConsole==true)
				{
					//document.getElementById('errConsole').innerHTML = '<font color=red><b>Error Console:</b></font><br>'+result;
				}
				
				if(_dynControl!='' && result!='')
				{
					document.getElementById(_dynControl).innerHTML = result;
				}
				
				try 
				{
					afterAjax();
				} 		
				catch (e) {}
				
				//result = _http_request.responseText;
				//alert(result);
				//document.getElementById('errConsole').innerHTML = result;            
			} 
			else 
			{
				//alert('There was a problem with the request.');
			}
		}
	}

	function get(target,postStr,dynCont,loader,obj) 
	{
		_showErrConsole=false;
		if(dynCont!='')
		{
			_dynControl=dynCont;
		}
		else
		{
			_dynControl='';
		}
		_showLoader=loader;
		if(loader==true)
		{
			try{
				document.getElementById('imgLoader').style.display='inline';
				document.getElementById('mainPageBody').style.opacity=.30;
				document.getElementById('mainPageBody').style.filter="alpha(opacity=50)";
		    }catch(e){}
		}
		
		var pathAdj='';
		if(postStr.indexOf("[[")>0)
		{
			startInd=postStr.indexOf("[[")+2;
			endInd=postStr.indexOf("]]");
			pathAdj=postStr.substring(startInd,endInd);
		}
		var postStr = postStr+"&";
		
		if(obj!='')
		{
			var obj = document.getElementById(obj);
			for (i=0; i<obj.elements.length; i++) 
			{
				if (obj.elements[i].type == "text") 
				{
					postStr += obj.elements[i].name + "=" + obj.elements[i].value + "&";//changed against issue 8392 using escape function to convert special char(&,# etc) into escape sequence--Fakhra Ashraf05222007
				}
				else if (obj.elements[i].type == "file") 
				{
					postStr += obj.elements[i].name + "=" + escape(obj.elements[i].value) + "&";
				}
				else if (obj.elements[i].type == "hidden") 
				{
					postStr += obj.elements[i].name + "=" + escape(obj.elements[i].value) + "&";
				}
				else if (obj.elements[i].type == "checkbox") 
				{
					if (obj.elements[i].checked) 
					{
						postStr += obj.elements[i].name + "=" + obj.elements[i].value + "&";
					} 
				}
				else if (obj.elements[i].type == "radio") 
				{
					if (obj.elements[i].checked) 
					{
						postStr += obj.elements[i].name + "=" + obj.elements[i].value + "&";
					}
				}
				else if (obj.elements[i].type == "select-one") 
				{
					var sel = obj.elements[i];
					if(sel.selectedIndex<0)
					{
						postStr += sel.name + "=&";
					}
					else
					{
						postStr += sel.name + "=" + escape(sel.options[sel.selectedIndex].value) + "&";
					}
				}
				else if (obj.elements[i].type == "textarea") 
				{
					postStr += obj.elements[i].name + "=" +escape(obj.elements[i].value) + "&";
				}
			}
		}
		//alert(postStr);	
		makeRequest(target,postStr);
	}
	
	//// Followingsections need to be removed latter
	var _url;
	var _data;
	var _dynCont;
	
	function loadDynData(url,data,dynCont)
	{
		_url=url;
		_data=data;
		_dynCont=dynCont;
		loadData();
	}
	function loadData()
	{
		if(window.XMLHttpRequest)
		{
			//used for netscape firefox and other browsers of this genere
			request = new XMLHttpRequest();
		}
		else if (window.ActiveXObject) 
		{
			//used for internet explorer // we are not supporting this for now as its not fully compatable with that
			request = new ActiveXObject("Microsoft.XMLHTTP");
		}
		if (request) 
		{
			d=new Date();  //as it always uses cache so u must include timestamp with url
			request.onreadystatechange = pageLoaded;
			
			//sending data with get method  // will be working with posts latter
			request.open("get", _url+"?"+_data+"&"+ d.toString(), true);
			request.send("");
		}
		
	}
	
	//this function will be called when requested pages starts executing
	function pageLoaded()
	{
		if (request.readyState == 4) // Request Sent 
		{
			//request.status 200 means page is executed and downloaded completed
			if (request.status == 200)
			{
				//all the data returned from the page is stored in "data" variable
				//now you can use this data either to refresh anypart of this page or to make any decision
				data=request.responseText;

				// we will put data received from server in html object for which request was sent
				document.getElementById(_dynCont).innerHTML=data;
				try
				{
					jSFromAjax(varbol=true,varStr='');
				}
				catch(ex){}
			}
		}
	}
	



