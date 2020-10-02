var urlBase = 'http://cookiebook.team/API';
var urlExtension = '.php';

var userID = 0;
var email = "";
var currentId;
var currentData;

function updateInfo()
{
    var first = document.getElementById("first").value;
    var last = document.getElementById("last").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var cookie = document.getElementById("cookie").value;

    var updateJSON = '{"firstname" : "' + first + '", "lastname" : "' + last + '", "phonenumber" : "' + phone + '", "email" : "' + email + '", "userid" : "' + user_ID + '", "favoritecookie" : "' + cookie + '"}'
    var request = new XMLHttpRequest();
    request.open("POST", url, false);
    request.setRequestHeader("Content-type", "application/json; charset=UTF-8");

    try
    {
        request.send(updateJSON);

        var jsonObject = JSON.parse(request.responseText);
        error = jsonObject.error;

        if(error == "Record Not Found")
        {
            return false;
        }

        if(error =="")
        {
            alert("contact added");
            return false;
        }

    }
    catch(err)
    {
        alert(err.message);
        return false;
    }
}

function addContact()
{
    var first = document.getElementById("first").value;
    var last = document.getElementById("last").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var cookie = document.getElementById("cookie").value;
    var userId = window.sessionStorage.getItem("userId");

    var jsonPayload = '{"firstname" : "' + first + '", "lastname" : "' + last + '", "phonenumber" : "' + phone + '", "email" : "' + email + '", "userid" : "' + userId + '", "favoritecookie" : "' + cookie + '"}'
    var url = urlBase + '/addContact' + urlExtension;

    var request = new XMLHttpRequest();
    request.open("POST", url, false);
    request.setRequestHeader("Content-type", "application/json; charset=UTF-8");

    if(first && last && phone && email && cookie)
    {
         try
        {
            request.send(jsonPayload);
        }

        catch(err)
        {
            alert(err.message);
        }
    }
    else
    {
        document.getElementById("addContact").innerHTML = "Please fill out fields";
    }
   
}

function addRow()
{
    const myTable = document.getElementById("cookieTable");

    const row = myTable.insertRow(1);
    row.style.textAlign = "center";

    const cell1 = row.insertCell(0);
    const cell2 = row.insertCell(1);
    const cell3 = row.insertCell(2);
    const cell4 = row.insertCell(3);
    const cell5 = row.insertCell(4);
    const cell6 = row.insertCell(5);
    const cell7 = row.insertCell(6);

    const firstName = document.getElementById("first").value;
    const lastName = document.getElementById("last").value;
    const phoneNumber = document.getElementById("phone").value;
    const email = document.getElementById("email").value;
    const cookie = document.getElementById("cookie").value;
    console.log(firstName);

    cell1.innerHTML = firstName;
    cell2.innerHTML = lastName;
    cell3.innerHTML = phoneNumber;
    cell4.innerHTML = email;
    cell5.innerHTML = cookie;
    cell6.innerHTML = '<button type="edit";class="btn btnEdit" onclick="openWindow1();updateInfo()">Edit</button>';
    cell7.innerHTML = '<button type="delete";class="btn btnDelete" onclick="deleteRow(this);">Delete</button>';
}


function closeWindow()
{
    document.getElementById("addWindow").style.display = "none";
}

function openWindow()
{
    document.getElementById("addWindow").style.display = "block";   
}
function openWindow1()
{
    document.getElementById("updateWindow").style.display = "block";   
}
function closeWindow1()
{
    document.getElementById("updateWindow").style.display = "none";
}

function deleteContact()
{   
    var url = urlBase + '/DeleteContact.' + urlExtension;
    var jsonPayload = '{ID" : "' + id + '"}';
    var request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/json; charset=UTF-8");
    request.send(jsonPayload);

    try
    {
        request.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200)
            {
                var jsonObject = JSON.parse(request.responseText);
                document.getElementById("").innerHTML = " Cookies Eaten!";
            }
        }

    }
    catch(err)
    {
        document.getElementById("").innerHTML = err.message;
    }
}

function reset()
{
    document.getElementById("first").value = "";
    document.getElementById("last").value = "";
    document.getElementById("phone").value = "";
    document.getElementById("email").value = "";
    document.getElementById("cookie").value = "";
}
