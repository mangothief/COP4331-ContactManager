var url = 'http://cookiebook.team/LAMPAPI';
var extension = 'php';

var userID = 0;
var firstName = "";
var lastName = "";

function doLogin()
{
    userId = 0;
    firstName = "";
    lastName = "";

    var login = document.getElementById("loginName").value;
    var password = document.getElementById("loginpassword").value;
    var hash = md5(password);

    document.getElementById("loginresult").innerHTML = "";

    var jsonPayload = '{"login" : "' + login + '", "pasword" : "' + hash + '"}';
    //var jsonPayload = '{"login" : "' + login + '", "pasword" : "' + password + '"}';
    var url = urlBase + '/Login.' + extension;

    var xhr = new XMLHttpRequest();
    xhr.open("Post", url, false);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
    try
    {
        xhr.send(jsonPayload);
        var jsonObject = JSON.parse( xhr.responseText);
        userID = jsonObject.id;
        if(userId < 1)
        {
            document.getElementById("loginResult").innerHTML = "User and or Password is invalid";
            return;
        }

        fisrtName = jsonObject.firstName;
        lastName = jsonObject.lastName;

        saveCookie;
        window.location.href = ""//insert HTML here
    }
    catch(err)
    {
        document.getElementById("loginResult").innerHTML = err.message;
    }
}

function saveCookie()
{
    var minutes = 20;
    var date = new Date();
    date.setTime(date.getTime()+(minutes*60*1000));
    document.cookie = "firstName=" + firstName + ",lastName=" + lastName + ",userId=" + userId + ";expires=" + date.toGMTString();
}

function readCookie()
{
	userId = -1;
	var data = document.cookie;
	var splits = data.split(",");
	for(var i = 0; i < splits.length; i++)
	{
		var thisOne = splits[i].trim();
		var tokens = thisOne.split("=");
		if( tokens[0] == "firstName" )
		{
			firstName = tokens[1];
		}
		else if( tokens[0] == "lastName" )
		{
			lastName = tokens[1];
		}
		else if( tokens[0] == "userId" )
		{
			userId = parseInt( tokens[1].trim() );
		}
	}

	if( userId < 0 )
	{
		window.location.href = "index.html";
	}
	else
	{
		document.getElementById("userName").innerHTML = "Logged in as " + firstName + " " + lastName;
    }
}

function doLogout()
{
    userId = 0;
    firstName = "";
    lastName = "";
    document.cookie = "firstName= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    window.location.href = "index.html";
}
