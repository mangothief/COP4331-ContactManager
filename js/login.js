var userID = 0;
var firstName = "";
var lastName = "";
var url = "http://206.189.193.36//API/Login.php";

function doLogin()
{
    var usernameInput = document.getElementById("inputUsername").value;
    var passwordInput = document.getElementById("inputPassword").value;

    var jsonPayload = JSON.stringify({username : usernameInput, password : passwordInput});

    var xhr = new XMLHttpRequest();

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");

    /*
    xhr.send(jsonPayload);
    xhr.onreadystatechange = function()
    {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200)
        {
            alert(xhr.responseText);
        }
    }
    */
    xhr.send(jsonPayload);

    xhr.onload = function() {
        alert(`Loaded: ${xhr.status} ${xhr.response}`);
    };
    xhr.onerror = function() { // only triggers if the request couldn't be made at all
        alert(`Network Error`);
    };

    xhr.onprogress = function(event) { // triggers periodically
        // event.loaded - how many bytes downloaded
        // event.lengthComputable = true if the server sent Content-Length header
        // event.total - total number of bytes (if lengthComputable)
        alert(`Received ${event.loaded} of ${event.total}`);
    };

    alert("xhr stuff done");
    try
	{



        //xhr.onreadystatechange = alert(xhr.responseType);
        var jsonObject = JSON.parse(xhr.response);
        alert(jsonObject);
        
        
		
		userId = jsonObject.id;
		
		if( userId < 1 )
		{
            alert("login fail!");
			//document.getElementById("loginResult").innerHTML = "User/Password combination incorrect";
			return;
        }
        
        alert("login fail!");
        return;

        /*
		firstName = jsonObject.firstName;
		lastName = jsonObject.lastName;

		saveCookie();
	
        window.location.href = "color.html";
        */
        
	}
	catch(err)
	{
        alert("error: " + err.message);
		//document.getElementById("loginResult").innerHTML = err.message;
    }
}