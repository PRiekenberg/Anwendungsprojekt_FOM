
var myHeading = document.querySelector('h1');
myHeading.textContent = "JavaScript funktioniert!";

function set_h1(){
  var headline = document.querySelector('h1');
  headline.textContent = "Kann ich nur bestätigen!";
}
function get_cookie(){
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
