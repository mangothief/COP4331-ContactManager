var urlBase = 'http://cookiebook.team/API/';
var urlExtension = '.php';

function updateInfo()
{
    var first = document.getElementById("first").value;
    var last = document.getElementById("last").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;

    var updateJSON = '{"firstName" : "' + first + '", "lastName" : "' + last + '", "phone" : "' + phone + '", "email" : "' + email + '", "userId" : "' + user_ID + '"}'
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
    var userId = window.sessionStorage.getItem("user_id");

    var jsonPayload = '{"firstName" : "' + first + '", "lastName" : "' + last + '", "phone" : "' + phone + '", "email" : "' + email + '", "userId" : "' + user_ID + '"}'
    var url = urlBase + '/addContact' + urlExtension;

    var request = new XMLHttpRequest();
    request.open("POST", url, false);
    request.setRequestHeader("Content-type", "application/json; charset=UTF-8");

    try
    {
        xhr.send(jsonPayload);
    }

    catch(err)
    {
        alert(err.message);
    }
}

/*
function addRow() 
{
    var first = document.getElementsById("first");
    var last = document.getElementsById("last");
    var phone = document.getElementsById("phone");
    var email = document.getElementsById("email");
    var table = document.getElementsById("cookieTable");
 
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
 
    row.insertCell(0).innerHTML= '<input type="button" value = "Delete" onClick="Javascript:deleteRow(this)">';
    row.insertCell(1).innerHTML= first.value;
    row.insertCell(2).innerHTML= last.value;
    row.insertCell(3).innerHTML= phone.value;
    row.insertCell(4).innerHTML= email.value;
}
 */
function deleteRow(obj) 
{
    var index = obj.parentNode.parentNode.rowIndex;
    var table = document.getElementById("cookieTable");
    table.deleteRow(index);
}

function closeWindow()
{
    document.getElementById("addWindow").style.display = "none";
}

function openWindow()
{
    document.getElementById("addWindow").style.display = "block";   
}

async function addRow(dataRow) {
    const myTable = document.getElementById("cookieTable").getElementsByTagName("tbody")[0];
    const row = document.createElement("tr");
    const columnKeys = ["first", "last", "phone", "email"];
    // loop through dataRow and add to row
    for (const columnKey of columnKeys) {
      const rowCell = document.createElement("td");
      rowCell.innerText = dataRow[columnKey];
      row.appendChild(rowCell);
    }
}
