<?php 
include_once("auth.php"); 
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
        if (isset($_POST['oldPassword'])&&isset($_POST['newPassword'])&&isset($_POST['Password'])){
            if($_POST['newPassword']==$_POST['Password']){
                if(password_verify($_POST['oldPassword'], $_SESSION['Password'])){
                    
                    $data = new data;
                    $response = $data->passUpdate($_POST['Password'],$_SESSION['Id']);
                    if($response==true){
                        unset($_POST);
                        echo "<div>
                                <p>Your Password has been changed, please <a href='logout.php'>Login</a> again.</p>
                            </div>";
                        
                    }else echo "<div>
                                    <p>Some Error Found. Please <a href='changePassword.php'>Try Again</a></p>
                                </div>";
                }else echo"<div>
                            <p>Old Password not match, Please <a href='changePassword.php'>Try Again</a></p>
                        </div>";
            }else echo "<div>
                            <p>Two New passwords are not the same, Please <a href='changePassword.php'>Try Again</a></p>
                        </div>";
        }else{
?>        
      <div class='registrtionform'>
     <div>
            <h2>Change Password</h2>
        </div>
        <div >
       
            <form method="POST">
            <span class="formelementc">

                    <input placeholder="Old Password" class='formelement' type="password" name="oldPassword" id="oldPassword" class="create" required="required">
                </span>
                <span class="formelementc">
         
                    <input placeholder="New Password" class='formelement' type="password" name="newPassword" id="newPassword" class="create" required="required">
                </span>
                <span class="formelementc">
      
                    <input placeholder="Retype New Password" class='formelement' type="password" name="Password" id="Password" class="create" required="required">
                </span>
                
                <span class="formelementc">
                    <button class='formelement' type="submit" class="btn btn-info">Change</button>
                </span>

            </form>
        </div>
        </div>
    

<?php require 'footer.php'; } ?>

</body>

</html>