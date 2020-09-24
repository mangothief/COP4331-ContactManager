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

function createTable(jsonData) {

    
    var col = [];
    for (var i = 2; i < jsonData.length; i++) {
        for (var key in jsonData[i]) {
            if (col.indexOf(key) === -1) {
                col.push(key);
            }
        }
    }
    col.push(" ");

    
    var table = document.createElement("tbody");
    var tr = table.insertRow(-1);                 

    for (var i = 2; i < col.length; i++) 
    {
        var th = document.createElement("th");    
        th.innerHTML = col[i];
        tr.appendChild(th);
    }

   
    for (var i = 0; i < jsonData.length; i++) 
    {
        tr = table.insertRow(-1);
        for (var j = 2; j < col.length; j++) {
            var tabCell = tr.insertCell(-1);
            if(j == col.length - 1)
            {
                tabCell.innerHTML = '<button button type="button" class="btn btn-lg btn-success btn-space" data-toggle="modal" data-target="#editForm" id = "' + jsonData[i][col[0]] + '" onclick="editClick(this.id)" ><span class="glyphicon glyphicon-star" aria-hidden="true"></span>Edit</button>';
            }
            else
            {
                tabCell.innerHTML = jsonData[i][col[j]];
            }
        }
    }

    var divContainer = document.getElementById("cookieTable");
    divContainer.innerHTML = "";
    divContainer.appendChild(table);
}

function searchContacts()
{

    var searchQuery = document.getElementById("search").value;
    var jsonPayload = '{"search" : "' + searchQuery + '", "userId" : ' + userId + '}';
	var url = urlBase + '/searchContacts' + urlExtension;

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.send(jsonPayload);

		var jsonObject = JSON.parse( xhr.responseText );

      // Setup Table
      createTable(jsonObject.results);

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
