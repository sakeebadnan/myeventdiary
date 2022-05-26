<?php include_once("auth.php");  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Document</title>
</head>
    <body>

    <?php
        require_once "src/data.php";
        $data = new data;
        if (isset($_POST['FirstName'])&& isset($_POST['LastName'])){
                              
            
            $response = $data->updateUser($_POST);
            if($response==true){
                //unset($_POST);
                echo"<script>
                    alert('Your Profile has been updated, need to login again.');
                </script>";
                unset($_POST);
                header('Location: logout.php');
            }else {
                unset($_POST);
                echo"<script>
                    alert('sorry something went wrong or invalide input. Please try again later.');
                </script>";
                header('Location: editUser.php');
            }
        }elseif (isset($_POST['submit'])){
            $response = $data->delUser($_SESSION['Id']);
            if($response==true){
                
                echo"<script>
                    alert('Your Profile has deleted, Thanks for using Event Diary.');
                </script>";
                unset($_POST);
                header('Location: logout.php');
            }else {
                
                echo"<script>
                    alert('Sorry something went wrong. Please try again later.');
                </script>";
                unset($_POST);
                header('Location: editUser.php');
            }

        }else{
?>        
        <main>
        <div class='registrtionform'>
            <div class="">
                <h2>Edit Profile</h2>
            </div>
            <div class="formEdit">  
                <form action="" id="editCust" method="POST" class="edit">
                    <span class="formelementc">
                        <input placeholder="First Name" class='formelement'  type="text" name="FirstName" id="fname" value=<?php echo $_SESSION['FirstName']; ?> onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="1">
                    </span>
                    <span class="formelementc">
                    
                        <input placeholder="Last Name" class='formelement' type="text" name="LastName" id="lname" value=<?php echo $_SESSION['LastName']; ?> onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="2">
                    </span>
                    <span class="formelementc">
                        
                        <input placeholder="Age"  class='formelement' type="number" name="Age" id="age" value=<?php echo $_SESSION['Age']; ?> required min="1" max="99" tabindex="3">
                    </span>              
                    <span class="formelementc">
                     
                        <input placeholder="Address" class='formelement'  type="text" name="Address" id="address" class="form-control" value=<?php echo ($_SESSION['Address']== NULL) ? 'Null': $_SESSION['Address']; ?> tabindex="4">
                    </span>
                    <span class="formelementc">
                      
                        <input placeholder="City" class='formelement' type="text" name="City" id="city" class="form-control" value=<?php echo ($_SESSION['City']== NULL) ? 'Null': $_SESSION['City']; ?> onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" tabindex="5">
                    </span>
                    <span class="formelementc">
                     
                        <input placeholder="State"  class='formelement'  type="text" name="State" id="state" class="form-control" value=<?php echo ($_SESSION['State']== NULL) ? 'Null': $_SESSION['State']; ?> onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" tabindex="6">
                    </span>
                    <span class="formelementc">
                       
                        <input placeholder="Country" class='formelement' type="text" name="Country" id="country" class="form-control" value=<?php echo ($_SESSION['Country']== NULL) ? 'Null': $_SESSION['Country']; ?> onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" tabindex="7">
                    </span>
                    <span class="formelementc">
                       
                        <input placeholder="Postal Code" class='formelement'  type="text" name="PostalCode" id="postalcode" class="form-control" value=<?php echo ($_SESSION['PostalCode']== NULL) ? 'Null': $_SESSION['PostalCode']; ?>>
                    </span>
                    <span class="formelementc">

                        <input placeholder="Phone" class='formelement' type="phone" name="Phone" id="phone" class="form-control" value=<?php echo ($_SESSION['Phone']== NULL) ? 'Null': $_SESSION['Phone']; ?>>
                    </span>
                    <div class="formelementc">
                        <input  type="hidden"  name="Id" id="Id" value=<?php echo $_SESSION['Id']; ?>>
                    </div>       
                    <span class="formelementc">
                        <button class='formelement' type="submit" class="btn btn-info" id="editCustomer">Edit Customer</button>
                    </span>

                </form>
                <p> OR </p><br>
                <form method="post" action="" >
                <span class="formelementc formunsubscribe">
                    <input class='formelement' type="submit" name="submit" value="Unsubscribe" onclick="return confirm('Are you sure you want to Unsubscribe? You will lose all your saved Events.')" />
                    <br>
        <br>
        </span>

                </form>
            </div>
        </div>
        </main>

<?php require 'footer.php';} ?>
    </body>
</html>
