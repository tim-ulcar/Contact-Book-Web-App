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
            <label for="addButton" style="color: white;">Add a contact: </label>
            <button id="addButton" class="open-button" onclick="openForm()"><b>+</b></button>
        </p>
        <p>
            <p style="color: white;">Logged in as <?php echo($_SESSION["user"]["user"]) ?>
                &nbsp;
                <a href="<?= BASE_URL . "logout" ?>" class="button">Logout</a>
            </p>
            
        </p>
    </nav>

    <article class="col-6">
        <table id="contactsTable" class="main">
            <caption>My contacts</caption>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                <?php $informationTableID = $contact['firstName'] . $contact['lastName'] . 'InformationTable'; ?>
                <td class="main" onclick="displayInformationTable(event, '<?php echo($informationTableID); ?>')">
                    <?= $contact["firstName"] ?> <?= $contact["lastName"] ?>
                </td>
                <td><button type="button" id="<?php echo($contact["contactID"]) ?>" onclick="editContact(event)">Edit</button> </td>
                <td><form action="<?= BASE_URL . "delete" ?>" method="post" onSubmit="return confirm('Are you sure you wish to delete <?php echo($contact["firstName"] . " " . $contact["lastName"]); ?>?');">
                    <input type="hidden" name="contactID" value="<?= $contact["contactID"] ?>"  />
                    <button>Delete</button>
                    </form>
                </td>
                <tr><td><table id="<?php echo($contact["firstName"] . $contact["lastName"] . "InformationTable"); ?>" style="display:none;">
                    <tr><td id="<?php echo($contact["contactID"] . " firstName") ?>" class="informationTableData">First name: <?= $contact["firstName"] ?></td></tr>
                    <tr><td id="<?php echo($contact["contactID"] . " lastName") ?>" class="informationTableData">Last name: <?= $contact["lastName"] ?></td></tr>
                    <tr><td id="<?php echo($contact["contactID"] . " email") ?>" class="informationTableData">Email: <?= $contact["email"] ?></td></tr>
                    <tr><td id="<?php echo($contact["contactID"] . " phone") ?>" class="informationTableData">Phone: <?= $contact["phone"] ?></td></tr>
                    <tr><td id="<?php echo($contact["contactID"] . " address") ?>" class="informationTableData">Address: <?= $contact["address"] ?></td></tr>
                    <tr><td id="<?php echo($contact["contactID"] . " city") ?>" class="informationTableData">City: <?= $contact["city"] ?></td></tr>
                    <tr><td id="<?php echo($contact["contactID"] . " group") ?>" class="informationTableData">Group: <?= $contact["groupName"] ?></td></tr>
                </table></td></tr>                
                </tr>
            <?php endforeach; ?>
        </table>
        <h6>'</h6>
    </article>

    <?php
        $noErrors = true;
        foreach ($errors as $error) {
            $noErrors = $noErrors && empty($error);
        }
        $noEditErrors = true;
        foreach ($editerrors as $error) {
            $noEditErrors = $noEditErrors && empty($error);
        }
    ?>

    <div class="form-popup col-6" id="myForm" <?php if (!$noErrors){ echo('style="display:block;"'); } ?>>
    <form action="<?= BASE_URL . "addcontact" ?>" method="post" class="form-container"  >
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

          <input type="hidden" id="user" name="user" value="<?php echo($_SESSION["user"]["user"]) ?>">
      
          <button type="submit" class="btn" id="saveButton" >Save</button>
          <button type="button" class="btn cancel" id="cancelButton" onclick="closeForm()">Cancel</button>
        </form>
        <?php 
            if (!$noErrors):
                foreach ($errors as $error):
        ?>
                    <p class="important"><?= $error ?></p>
        <?php 
                endforeach;
            endif; 
        ?>    
    </div>

    <div class="form-popup col-6" id="editForm" <?php if (!$noEditErrors){ echo('style="display:block;"'); } ?>>
        <form action="<?= BASE_URL . "editcontact" ?>" method="post" class="form-container">
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

          <input type="hidden" id="user2" name="user2" value="<?php echo($_SESSION["user"]["user"]) ?>">
          <input type="hidden" id="contactID" name="contactID" value="">
      
          <button type="submit" class="btn" id="saveButton2" >Save</button>
          <button type="button" class="btn cancel" id="cancelButton2" onclick="closeEditForm()">Cancel</button>
        </form>
        <?php 
            if (!$noEditErrors):
                foreach ($editerrors as $error):
        ?>
                    <p class="important"><?= $error ?></p>
        <?php 
                endforeach;
            endif; 
        ?>
    </div>

    <footer class="col-12">
            <p style="color: white;">The Contact Book</p>
    </footer>

    
    <script src="<?= JS_URL . "script.js" ?>"></script>
</body>
</html>