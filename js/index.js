function set_h1(){
  var headline = document.querySelector('h1');
  headline.textContent = "JavaScript funktioniert!";
}
function set_first_cookie(){
	var a = new Date();
	a = new Date(a.getTime() +1000*60*60*24*365);
	document.cookie = 'counter=0; expires='+ a.toGMTString()+';'; 
}
function update_cookie(new_value){
	var a = new Date();
	a = new Date(a.getTime() +1000*60*60*24*365);
	var counter_value = 'counter='+new_value+';';
	document.cookie = counter_value +' expires='+ a.toGMTString()+';'; 
}
function increment_counter(){
	var cookieList = (document.cookie) ? document.cookie.split(';') : [];
  	var cookieValues = {};
	if (cookieList.length < 1){
		set_first_cookie(); 
	}
	else{
		for (var i = 0, n = cookieList.length; i != n; ++i) {
    			var cookie = cookieList[i];
    			var f = cookie.indexOf('=');
    			if (f >= 0) {
      				var cookieName = cookie.substring(0, f);
      				var cookieValue = cookie.substring(f + 1);
				
				if cookieName = "counter"{
					var new_value = parseInt(cookieValue) + 1;
					update_cookie(new_value);
				}
    			}
  		}
	}
}
