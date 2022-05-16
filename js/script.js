"use strict";

// Called by pressing the edit button - displays the edit form
function editContact(event) {
    // Get the row and display or hide the edit form
    let row = event.target.parentNode;
    let editForm = document.getElementById("editForm");

    if (editForm.style.display == "none") {
        editForm.style.display = "block";
    }
    else {
        editForm.style.display = "none";
    }

    //Get the contactID
    let contactID = event.target.getAttribute("id");
    //Set the contactID in edit form
    document.getElementById("contactID").value = contactID;

    // Get old contact's information
    let firstName = document.getElementById(contactID + " firstName").innerHTML.split(" ")[2];
    let lastName = document.getElementById(contactID + " lastName").innerHTML.split(" ")[2];
    let email = document.getElementById(contactID + " email").innerHTML.split(" ")[1];
    let phone = document.getElementById(contactID + " phone").innerHTML.split(" ")[1];
    let address = document.getElementById(contactID + " address").innerHTML.split(" ")[1];
    let city = document.getElementById(contactID + " city").innerHTML.split(" ")[1]; 
    let group = document.getElementById(contactID + " group").innerHTML.split(" ")[1]; 

    // Put old information in the fields
    document.getElementById("firstName2").value = firstName;
    document.getElementById("lastName2").value = lastName;
    document.getElementById("email2").value = email;
    document.getElementById("phoneNumber2").value = phone;
    document.getElementById("address2").value = address;
    document.getElementById("city2").value = city;
    document.getElementById("group2").value = group;

    // Scrolls to the edit form (in mobile mode)
    editForm.scrollIntoView({behavior: "smooth"});

}


// Called by clicking a contact in the contact table to display its information
function displayInformationTable(event, informationTableID) {
    let row = event.target.parentNode;
    let informationTable = document.getElementById(informationTableID);

    if (informationTable.style.display == "none") {
        informationTable.style.display = "block";
    }
    else {
        informationTable.style.display = "none";
    }
}


// Open form for adding new contact
function openForm() {
    if (document.getElementById("myForm").style.display == "none") {
        document.getElementById("myForm").style.display = "block";
    }
    else {
        document.getElementById("myForm").style.display = "none";
    }

    // Focus on first name input
    document.getElementById("firstName").focus();

    // Scroll to element in mobile mode
    document.getElementById("myForm").scrollIntoView({behavior: "smooth"});

}
  
function closeForm() {
    document.getElementById("myForm").style.display = "none";
}


function closeEditForm() {
    document.getElementById("editForm").style.display = "none";
}


// Make the searchbar work with pressing enter
function enterFunctionality() {
    let searchBar = document.getElementById("searchBar");
    searchBar.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("searchButton").click();
        }
    });

}
