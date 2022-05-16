<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
    <title>Contact book</title>
</head>
<body onload="enterFunctionality()">

    <header>
        <h1>The Contact Book</h1>
    </header>

    <nav>
        <p>
            <form action="<?= BASE_URL . "login" ?>" method="post">
                <label style="color: white;">Username: <input type="text" name="username" autocomplete="off" required /></label>
                <br/>
                <label style="color: white;">Password: <input type="password" name="password" required /></label>
                <?php if (!empty($errorMessage)): ?>
                    <p class="important"><?= $errorMessage ?></p>
                <?php endif; ?>
                <br>
                <input type="submit" class="likeButton" name="loginButton" value="Log-in" />
                <input type="submit" class="likeButton" name="registerButton" value="Register" />
            </form>
        </p>
    </nav>

    <article class="col-12">
        <table id="contactsTable" class="main">
            <caption>Public contacts</caption>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                <?php $informationTableID = $contact['firstName'] . $contact['lastName'] . 'InformationTable'; ?>
                <td class="main" onclick="displayInformationTable(event, '<?php echo($informationTableID); ?>')">
                    <?= $contact["firstName"] ?> <?= $contact["lastName"] ?>
                </td>
                <tr><td><table id="<?php echo($contact["firstName"] . $contact["lastName"] . "InformationTable"); ?>" style="display:none;">
                    <tr><td class="informationTableData">First name: <?= $contact["firstName"] ?></td></tr>
                    <tr><td class="informationTableData">Last name: <?= $contact["lastName"] ?></td></tr>
                    <tr><td class="informationTableData">Email: <?= $contact["email"] ?></td></tr>
                    <tr><td class="informationTableData">Phone: <?= $contact["phone"] ?></td></tr>
                    <tr><td class="informationTableData">Address: <?= $contact["address"] ?></td></tr>
                    <tr><td class="informationTableData">City: <?= $contact["city"] ?></td></tr>
                    <tr><td class="informationTableData">Group: <?= $contact["groupName"] ?></td></tr>
                </table></td></tr>                
                </tr>
            <?php endforeach; ?>
        </table>
        <h6>'</h6>
    </article>

    <div class="form-popup col-6" id="myForm">
        <form action="empty" class="form-container">
          <h3>Enter the contact's information</h3>

          <label for="firstName"><b>First name</b></label>
          <input type="text" name="firstName" id="firstName">
          
          <label for="lastName"><b>Last name</b></label>
          <input type="text" name="lastName" id="lastName">
      
          <label for="email"><b>Email</b></label>
          <input type="text" name="email" id="email">

          <label for="phoneNumber"><b>Phone number</b></label>
          <input type="text" name="phoneNumber" id="phoneNumber">
          
          <label for="address"><b>Address</b></label>
          <input type="text" name="address" id="address">

          <label for="city"><b>City</b></label>
          <input type="text" name="city" id="city">

          <label for="group"><b>Group</b></label>
          <input type="text" name="group" id="group">
      
          <button type="button" class="btn" id="saveButton" onclick="addContact()">Save</button>
          <button type="button" class="btn cancel" id="cancelButton" onclick="closeForm()">Cancel</button>
        </form>
    </div>

    <div class="form-popup col-6" id="editForm">
        <form action="empty" class="form-container">
          <h3>Edit the contact's information</h3>

          <label for="firstName2"><b>First name</b></label>
          <input type="text" name="firstName2" id="firstName2">
          
          <label for="lastName2"><b>Last name</b></label>
          <input type="text" name="lastName2" id="lastName2">
      
          <label for="email2"><b>Email</b></label>
          <input type="text" name="email2" id="email2">

          <label for="phoneNumber2"><b>Phone number</b></label>
          <input type="text" name="phoneNumber2" id="phoneNumber2">
          
          <label for="address2"><b>Address</b></label>
          <input type="text" name="address2" id="address2">

          <label for="city2"><b>City</b></label>
          <input type="text" name="city2" id="city2">

          <label for="group2"><b>Group</b></label>
          <input type="text" name="group2" id="group2">
      
          <button type="button" class="btn" id="saveButton2" onclick="saveEditedContact()">Save</button>
          <button type="button" class="btn cancel" id="cancelButton2" onclick="closeEditForm()">Cancel</button>
        </form>
    </div>

    <footer class="col-12">
            <p style="color: white;">The Contact Book</p>
    </footer>

    
    <script src="<?= JS_URL . "script.js" ?>"></script>
</body>
</html>