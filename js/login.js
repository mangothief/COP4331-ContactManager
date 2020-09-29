var userID = 0;
var firstName = "";
var lastName = "";
var url = "http://www.cookiebook.team/API/Login.php";

function doLogin()
{
    var usernameInput = document.getElementById("inputUsername").value;
    var passwordInput = document.getElementById("inputPassword").value;

    var jsonPayload = JSON.stringify({username : usernameInput, password : passwordInput});

    var xhr = new XMLHttpRequest();

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
    xhr.send(jsonPayload);

    xhr.onload = function() {
        //alert(`Loaded: ${xhr.status} ${xhr.response}`);
        if(xhr.status == 500)
        {
            document.getElementById("loginResult").innerHTML = `500 internal server error`;
        } 
        else if(xhr.status == 200)
        {
            //alert(`Response is \"${xhr.response}\"`);
            var jsonObject = JSON.parse(xhr.response);
            userID = jsonObject.userid;
            //alert(`id is \"${userID}\"`);
            if(userID)
            {
                document.getElementById("loginResult").innerHTML = `Login Success!`;
            }
            else
            {
                document.getElementById("loginResult").innerHTML = `${jsonObject.error}`;
            }
        }
        else
        {
            document.getElementById("loginResult").innerHTML = `Unspecified error: error code ${xhr.status}`;
        }
    };
    xhr.onerror = function() { // only triggers if the request couldn't be made at all
        document.getElementById("loginResult").innerHTML = `Network Error`;
    };

    //Only needed for network testing
    /*
    xhr.onprogress = function(event) { // triggers periodically
        // event.loaded - how many bytes downloaded
        // event.lengthComputable = true if the server sent Content-Length header
        // event.total - total number of bytes (if lengthComputable)
        alert(`Received ${event.loaded} of ${event.total}`);
    };
    */

    //alert("Finished xhr");
};

function doRegister()
{
    var usernameInput = document.getElementById("inputUsername").value;
    var passwordInput = document.getElementById("inputPassword").value;
    var confirmPasswordInput = document.getElementById("inputConfirmPassword").value;

    if(passwordInput != confirmPasswordInput)
    {
        document.getElementById("loginResult").innerHTML = `Passwords do not match`;
        return;
    }

    var jsonPayload = JSON.stringify({username : usernameInput, password : passwordInput});

    var xhr = new XMLHttpRequest();

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
    xhr.send(jsonPayload);

    xhr.onload = function() {
        //alert(`Loaded: ${xhr.status} ${xhr.response}`);
        if(xhr.status == 500)
        {
            document.getElementById("loginResult").innerHTML = `500 internal server error`;
        } 
        else if(xhr.status == 200)
        {
            //alert(`Response is \"${xhr.response}\"`);
            var jsonObject = JSON.parse(xhr.response);
            userID = jsonObject.userid;
            //alert(`id is \"${userID}\"`);
            if(typeof jsonObject.error == 'undefined')
            {
                showLogin();
                document.getElementById("loginResult").innerHTML = `${jsonObject.error}`;
            }
            else
            {
                document.getElementById("loginResult").innerHTML = `${jsonObject.error}`;
            }
        }
        else
        {
            document.getElementById("loginResult").innerHTML = `Unspecified error: error code ${xhr.status}`;
        }
    };
    xhr.onerror = function() { // only triggers if the request couldn't be made at all
        document.getElementById("loginResult").innerHTML = `Network Error`;
    };

    //Only needed for network testing
    /*
    xhr.onprogress = function(event) { // triggers periodically
        // event.loaded - how many bytes downloaded
        // event.lengthComputable = true if the server sent Content-Length header
        // event.total - total number of bytes (if lengthComputable)
        alert(`Received ${event.loaded} of ${event.total}`);
    };
    */

    //alert("Finished xhr");
};

function showRegister()
{
    /*
    var element = document.getElementById("titleName");
    element.innerHTML = "WOW"
    */
    document.getElementById("mainForm").innerHTML =
    `
    <form class="form-container" id="mainForm">
    <p id="titleName">Register</p>

      <div class="form-group">
        <label for="inputEmailLabel">Username</label>
        <input type="text" class="form-control" id="inputUsername">
      </div>
      <div class="form-group">
        <label for="inputPasswordLabel">Password</label>
        <input type="password" class="form-control" id="inputPassword">
      </div>
      <div class="form-group">
      <label for="inputConfirmPasswordLabel">Confirm Password</label>
      <input type="password" class="form-control" id="inputConfirmPassword">
      <a onclick="showLogin()"><small id="newAccount" class="form-text text-muted">New user? Register</small></a>
      </div>

      <div class="container">
        <button type="button" onclick="doRegister()" class="btn btn-primary btn-block submit-btn">Submit</button>
      </div>
      <span id="loginResult"></span>
    `
};

function showLogin()
{
    document.getElementById("mainForm").innerHTML =
    `
    <form class="form-container" id="mainForm">
    <p id="titleName">Login</p>
      <div class="form-group">
        <label for="inputEmailLabel">Username</label>
        <input type="text" class="form-control" id="inputUsername">
      </div>
      <div class="form-group">
        <label for="inputPasswordLabel">Password</label>
        <input type="password" class="form-control" id="inputPassword">
        <a onclick="showRegister()"><small id="newAccount" class="form-text text-muted">New user? Register</small></a>
      </div>
      <div class="container">
        <button type="button" onclick="doLogin()" class="btn btn-primary btn-block submit-btn">Submit</button>
      </div>
      <span id="loginResult"></span>
  </form>
    `
};