document
    function doCreate()
    {
        alert("This should connect to newContacts page");
    }

    function doSearch()
    {
        alert("Nope");
    }

    function logout()
    {
        alert("create logout");
    }

    function addContact()
    {
        var newFirst = document.getElementById("newFirst").value;
        var newLast = document.getElementById("newLast").value;
        var newPhone = document.getElementById("newPhone").value;
        var newEmail = document.getElementById("newEmail").value;
        var newAddress = document.getElementById("newAddress").value;

        // TODO: create addContact id in html
        document.getElementById("addContact").innerHTML = "";

        var jsonPayload = '{"userid" : ' + userid + '"first name" : "' + newFirst + '", "last name" :  "' + newLast + '", "new   Phone" : "' + newPhone + '", "new email" : "' + newEmail + '"}';

        //Rename this with AddContact API
        var url = urlBase + "AddContact.php"; 

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {

        }
    }

    function editContact()
    {
        var newFirst = document.getElementById("newFirst").value;
        var newLast = document.getElementById("newLast").value;
        var newPhone = document.getElementById("newPhone").value;
        var newEmail = document.getElementById("newEmail").value;
        var newAddress = document.getElementById("newAddress").value;

        // TODO: create editContact id in html
        document.getElementById("editContact").innerHTML = "";

        var jsonPayload = '{"first name" : "' + newFirst + '", "last name" :  "' + newLast + '", "new   Phone" : "' + newPhone + '", "new email" : "' + newEmail + '"}';

        //Rename this with AddContact API
        var url = urlBase + "AddContact.php"; 

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {

        }
    }

    // waiting
    function deleteContact()
    {
        // TODO: create deleteContact id in html
        document.getElementById("deleteContact").innerHTML = "";

        // WIP need to know json format
        var jsonPayload;

        //Rename this with DeleteContact API
        var url = urlBase + "DeleteContact.php"; 

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {

        }
    }

    // Is this not needed due to api?
    function search() 
    {
        var input, filter, ul, tr, a, i, txtValue;
        input = document.getElementById("myInput"); // should this be "search"?
        filter = input.value.toUpperCase();
        tr = document.getElementById("myUL");
        tr = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    // check w/ backend to see if upper/lowercase matters
    function searchAll()
    {
        var input;
        input = document.getElementById("search");

        // input = input.value.toLowerCase();

        var jsonPayload = '{"search" : "' + input '"}';

        //Rename this with SearchContactByName API
        var url = urlBase + "SearchByAll.php"; 

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {

        }
    }