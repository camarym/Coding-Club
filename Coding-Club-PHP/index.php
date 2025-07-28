<?php
    $userMsg = '';
    $recordRows = "";
    $createFlag = null; 
    $orig_firstName = "";
    $orig_lastName = "";
    $orig_phone = "";
    $orig_email = "";
    $orig_contact = 
    $createUpdateButton = 'Create';
     
    include 'global_php_files/open_coding_club_db_connection.php';
    
    $pk = "";
    if($_GET['pk']) $pk = $_GET['pk'];
    
    $pk_update= "";
    if($_GET['pk_update']) $pk_update = $_GET['pk_update'];

    $firstName = "";
    if($_GET['firstName']) $firstName = $_GET['firstName'];

    if($pk !== ""){
        $createUpdateButton = 'Update';
        //$createFlag = false;
    }

    else if($firstName !== ""){
        $createFlag = true;
    }

    $formButton = "";
    if($_GET['formButton']) $formButton = $_GET['formButton'];

    $orig_firstName = "";
    if($_GET['orig_firstName']) $orig_firstName = $_GET['orig_firstName'];
    
    $lastName = "";
    if($_GET['lastName']) $lastName = $_GET['lastName'];

    $orig_lastName = "";
    if($_GET['orig_lastName']) $orig_lastName = $_GET['orig_lastName'];

    $phoneflag = "";
    if($_GET['phone']) $phoneflag = $_GET['phone'];

    $orig_phone = "";
    if($_GET['orig_phone']) $orig_phone = $_GET['orig_phone'];
    
    $email = "";
    if($_GET['email']) $email = $_GET['email'];
    
    $orig_email = "";
    if($_GET['orig_email']) $orig_email = $_GET['orig_email'];

    $skillLevel="";
    if($_GET['skillLevel']) $skillLevel = $_GET['skillLevel'];
    
    $orig_email = "";
    if($_GET['orig_email']) $orig_email = $_GET['orig_email'];

    $contact="";
    if($_GET['contact']) $contact = $_GET['contact'];
    
    $objective="";
    if($_GET['objective']) $objective = $_GET['objective'];

    if($orig_firstName !== $firstName) echo '- ' . $orig_firstName . ' - !== - ' .  $firstName . ' - first name changed<br>';


    if($bool_connected) {
        
        if($createUpdateButton === "Create" && $createFlag === true) {

            $insertSQL = 'INSERT INTO coding_club ';
            $insertSQL .= "(first_name, last_name, phone, email, skill_level, contact, objective) ";
            $insertSQL .= "VALUES ('$firstName','$lastName', '$phone', '$email', '$skillLevel', '$contact', '$objective')";
            //echo '<br><br>' . $insertSQL . '<br><br>';
        
            if(mysqli_query($conn, $insertSQL)) {
                    $userMsg = 'Record Created';
            } 
            else {
                $userMsg = 'ERROR' . mysqli_error($conn);
            }

       }
        else if($pk !== ""){

            if($pk_update !== ""){
        
                $bool_makeUpdate = false;

                $createUpdateButton = 'Update';

                $updateSql = "UPDATE coding_club ";
                $updateSql .= "SET ";

                if($firstName !== $orig_firstName){
                    $updateSql .= "first_name = '$firstName' ";
                    $bool_makeUpdate = true;
                }
                
                if($lastName !== $orig_lastName){
                    $updateSql .= "last_name = '$lastName' ";
                    $bool_makeUpdate = true;
                }

                if($phone !== $orig_phone){
                    $updateSql .= "phone = '$phone' ";
                    $bool_makeUpdate = true;
                }

                if($email !== $orig_email){
                    $updateSql .= "email = '$email' ";
                    $bool_makeUpdate = true;
                }

                $updateSql .= " WHERE pk=" . $pk;
                echo $updateSql;

                if($bool_makeUpdate){

                    if(mysqli_query($conn, $updateSql)){
                        $userMsg .= "Record updated successfully";
                    }
                    else{
                        $userMsg .= "Error updating record: " . myqli_error(mysql: $conn);
                    }

                }
                else{
                    $userMsg .= "No information was changed, so no update was needed.";
                }

            }

            $sqlQueryUpdate = "SELECT * FROM coding_club WHERE pk='$pk'";
            $sqlResultUpdate = mysqli_query($conn,$sqlQueryUpdate);
            
            $novice = "";
            $beginner = "";
            $intermediate = "";
            $expert = "";
            $phoneContact = "";
            $emailContact = "";

            while($row = mysqli_fetch_assoc($sqlResultUpdate)){
        
                $firstName = $row['first_name'];                
                $lastName = $row['last_name'];
                $phone = $row['phone'];
                $email = $row['email'];
                $contact = $row['contact'];

                if($contact === "PhoneContact"){
                    $phoneContact = "checked";
                }
                else if($contact === "EmailContact"){
                    $emailContact = "checked";
                }

                $skillLevel = $row['skill_level'];

                if($skillLevel === "Novice"){
                    $novice = "checked";                
                }
                else if($skillLevel === "Beginner"){
                    $beginner = "checked";                
                }
                else if($skillLevel === "Intermediate"){
                    $intermediate = "checked";                
                }
                else if($skillLevel === "Expert"){
                    $expert = "checked";                
                }

                echo "skill level " . $skillLevel; 

                $objective = $row['objective'];
                
            }
         }
    }


 

    $sqlQuery = "SELECT * FROM coding_club ORDER BY first_name";
    $sqlResult = mysqli_query($conn,$sqlQuery);
    while($row = mysqli_fetch_assoc($sqlResult)){

        $recordRows .= '<tr>';
        $recordRows .= '<td><a href="index.php?pk=' . $row['pk'] . '">' . $row['first_name'] .  '</a></td>';
        $recordRows .= '<td>' . $row['last_name'] .  '</td>';
        $recordRows .= '<td>' . $row['phone'] .  '</td>';
        $recordRows .= '<td>' . $row['email'] .  '</td>';
        $recordRows .= '<td>' . $row['skill_level'] .  '</td>';
        $recordRows .= '<td>' . $row['contact'] .  '</td>'; 
        $recordRows .= '<td>' . $row['objective'] .  '</td>';
        $recordRows .= '</tr>';
    }

    $createUpdate = '<input type="submit" name="formButton" value="' . $createUpdateButton . '">';



    include 'global_php_files/close_coding_club_db_connection';

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Free Coding Club</title>
        <link rel="stylesheet" href="css/main.css">
        <script src="js/main.js"></script>
        
        <style>
        .required {
            color: red; /* Sets the color of the asterisk to red */
            margin-left: 4px; /* Optional: adds space between the label and asterisk */
            font-weight: bold; /* Optional: makes the asterisk bold */
        }
    </style>
    
    </head>
    <body>

        <h1>Free Coding Club</h1>
        <p><?php echo $userMsg; ?></p>

        <h2>Submit the information below to join our free coding club.</h2>

        <p><span class="required">*</span>Indicates a required field.</p>

        <form id="registrationForm" action="index.php" onsubmit="return validateForm()" method="get">
            <input type="hidden" name="pk_update" value="<?php echo $pk; ?>">
            <input type="hidden" name="pk" value="<?php echo $pk; ?>">
            
            <label for="firstName">First Name:<span class="required">*</span></label><br>
            <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required><br><br>
            <input type="hidden" name="orig_firstName" value="<?php echo $firstName; ?>">
 
            <label for="lastName">Last Name:<span class="required">*</label><br>
            <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required><br><br>
            <input type="hidden" name="orig_lastName" value="<?php echo $lastName; ?>">

            <label for="phone">Phone Number:<span class="required">*</label><br>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required><br><br>
            <input type="hidden" name="orig_phone" value="<?php echo $phone; ?>">
            
            <label for="email">Email Address:<span class="required">*</label><br>
            <input type="text" id="email" name="email"  value="<?php echo $email; ?>"><br><br>
            <input type="hidden" name="orig_email" value="<?php echo $email; ?>">

         <fieldset>
            <legend style="font-weight:bold">What is your skill level?<span class="required">*</span></legend>
                    <label><input type="radio" class="radio" id="skillNovice" name="skillLevel" value="Novice" <?php echo $novice; ?> >Novice</label>
                    <!-- <input type="hidden" name="skillLevel" value="<?php echo $novice; ?>"> -->
            <br>
                    <label><input type="radio" class="radio" id="skillBeginner" name="skillLevel" value="Beginner" <?php echo $beginner; ?>>Beginner</label>
                    <input type="hidden" name="skillLevel" value="<?php echo $beginner; ?>">
            <br> 
                    <label><input type="radio" class="radio" id="skillIntermediate" name="skillLevel" value="Intermediate" <?php echo $intermediate; ?>>Intermediate</label>
                    <!-- <input type="hidden" name="skillLevel" value="<?php echo $intermediate; ?>"> -->
            <br>        
                    <label><input type="radio" class="radio" id="skillExpert" name="skillLevel" value="Expert" <?php echo $expert; ?>>Expert</label>
                    <!-- <input type="hidden" name="skillLevel" value="<?php echo $expert; ?>"> -->
        </fieldset>
        <br>

        <fieldset>
            <legend style="font-weight:bold">What are the best contact methods?</legend>
            <label><input type="checkbox" id="phoneContact" name="contact" value="PhoneContact" <?php echo $phoneContact; ?>>Phone</label>
            <input type="hidden" name="orig_phoneContact" value="<?php echo $phoneContact; ?>">

            <label><input type="checkbox" id="emailContact" name="contact" value="EmailContact" <?php echo $emailContact; ?>>Email</label>
            <input type="hidden" name="orig_emailContact" value="<?php echo $emailContact; ?>">
        </fieldset>
            <br>

        <label for="objective">What is your objective for this class?<span class="required">*</label><br>
            <textarea id="objective" name="objective" rows="5" cols="100" required><?php echo $objective; ?></textarea><br><br>
            <input type="hidden" name="objective" value="<?php echo $objective; ?>">

            <br>

   <?php echo $createUpdate; ?>

    </form>


    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Skill Level</th>
            <th>Contact Method</th>
            <th>Objective</th>
        </tr>
        <?php echo $recordRows; ?>
    </table>
</body>

</html>

