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

        document.getElementById("addContact").innerHTML = "";

        var jsonPayload = '{"first name" : "' + newFirst + '", "last name" :  "' + newLast + '", "new   Phone" : "' + newPhone + '", "new email" : "' + newEmail + '"}';

        //Rename this with addcontact API
        var url = urlBase;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {

        }
    }
        function search() 
        {
            var input, filter, ul, tr, a, i, txtValue;
            input = document.getElementById("myInput");
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
