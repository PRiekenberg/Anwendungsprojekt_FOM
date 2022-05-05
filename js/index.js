function set_h1(){
  var headline = document.querySelector('h1');
  headline.textContent = "JavaScript funktioniert!";
}
function update_cookie(new_value){
	var a = new Date();
	a = new Date(a.getTime() +1000*60*60*24*365);
	var counter_value = 'counter='+new_value+';';
	document.cookie = counter_value +' expires='+ a.toGMTString()+';'; 
}
function increment_counter(){
	var found = new Boolean;
	found = false;
	var cookieList = (document.cookie) ? document.cookie.split(';') : [];
  	var cookieValues = {};
	for (var i = 0, n = cookieList.length; i != n; ++i) {
    		var cookie = cookieList[i];
    		var f = cookie.indexOf('=');
    		if (f >= 0) {
      			var cookieName = cookie.substring(0, f);
      			var cookieValue = cookie.substring(f + 1);
				
			if (cookieName == "counter"){
				var new_value = parseInt(cookieValue) + 1;
				update_cookie(new_value);
				found = true;
			}
    		}
  	}
	if (found == false){
		update_cookie(1);
	}
}

function read_counter_cookie(){
	var cookieList = (document.cookie) ? document.cookie.split(';') : [];
  	var cookieValues = {};
	for (var i = 0, n = cookieList.length; i != n; ++i) {
    			var cookie = cookieList[i];
    			var f = cookie.indexOf('=');
    			if (f >= 0) {
      				var cookieName = cookie.substring(0, f);
      				var cookieValue = cookie.substring(f + 1);
				
				if (cookieName == "counter"){
					var value = parseInt(cookieValue) + 1;
					var counter = document.getElementByID('counter');
					counter.textContent = value;
				}
    			}
  		}
	
}
