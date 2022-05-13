function set_h1(){
  var headline = document.querySelector('h1');
  headline.textContent = "JavaScript funktioniert!";
}
function update_cookie(new_value){
	var a = new Date();
	a = new Date(a.getTime() +1000*60*60*24*365);
	var counter_value = "counter="+new_value+";";
	document.cookie = counter_value +" expires="+ a.toGMTString()+";"; 
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
				
			if (cookieName == "counter" || cookieName == " counter"){
				var new_value = parseInt(cookieValue) + 1;
				update_cookie(new_value);
				found = true;
			}
    		}
  	}
	if (found == false){
		update_cookie(1);
	}
	location.reload();
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
				
				if (cookieName == "counter" || cookieName == " counter"){
					var value = parseInt(cookieValue) + 1;
					document.getElementById('counter').innerHTML = value;
				}
    			}
  		}
	
}


function selectCheck(that) {
    if (that.value == "question") {
        document.getElementById("questioncontent").style.display = "block";
		document.getElementById("answercontent").style.display = "none";
		document.getElementById("anserstate").style.display = "none";
		document.getElementById("answerpoints").style.display = "none";
		document.getElementById("phase").style.display = "block";
		document.getElementById("scenarioid").style.display = "block";
		document.getElementById("username").style.display = "none";
		document.getElementById("password").style.display = "none";
    } if (that.value == "answer"){
        document.getElementById("questioncontent").style.display = "none";
		document.getElementById("answercontent").style.display = "block";
		document.getElementById("anserstate").style.display = "block";
		document.getElementById("answerpoints").style.display = "block";
		document.getElementById("phase").style.display = "block";
		document.getElementById("scenarioid").style.display = "block";
		document.getElementById("username").style.display = "none";
		document.getElementById("password").style.display = "none";
    } if (that.value == "user"){
        document.getElementById("questioncontent").style.display = "none";
		document.getElementById("answercontent").style.display = "none";
		document.getElementById("anserstate").style.display = "none";
		document.getElementById("answerpoints").style.display = "none";
		document.getElementById("phase").style.display = "none";
		document.getElementById("scenarioid").style.display = "none";
		document.getElementById("username").style.display = "block";
		document.getElementById("password").style.display = "block";
    }
}
