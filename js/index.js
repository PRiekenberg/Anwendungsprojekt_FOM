function set_h1(){
  var headline = document.querySelector('h1');
  headline.textContent = "JavaScript funktioniert!";
}
function set_first_cookie(){
	var a = new Date();
	a = new Date(a.getTime() +1000*60*60*24*365);
	document.cookie = 'meincookie=meinwert; expires='+ 
                  a.toGMTString()+';'; 
}
function get_cookie(){
	set_first_cookie();
  	var cookieList = (document.cookie) ? document.cookie.split(';') : [];
  	var cookieValues = {};
	if (cookieList.length < 1){
		document.cookie = 'counter=0;'; 
	}
		
	else{
 	 	for (var i = 0, n = cookieList.length; i != n; ++i) {
    			var cookie = cookieList[i];
    			var f = cookie.indexOf('=');
    			if (f >= 0) {
      				var cookieName = cookie.substring(0, f);
      				var cookieValue = cookie.substring(f + 1);
	
	    			console.log ("cookieName + " + cookieName + " cookieValue " + cookieValue);
    
      				if (!cookieValues.hasOwnProperty(cookieName)) {
        				cookieValues[cookieName] = cookieValue;
      				}
    			}
  		}
	}
}

