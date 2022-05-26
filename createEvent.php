<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Document</title>
</head>
<?php include_once("auth.php");  
       require_once "src/data.php";
?>


    <body>

    <?php
     
        if(isset($_POST['submit'])){
            $now = DateTime::createFromFormat('U.u', microtime(true));
            $_POST['eventId']=$now->format("m-d-Y H:i:s.u");
            $_POST['category']="Self";
            $_POST['eventUrl']="#";
            $_POST['imageUrl']="http://event-diary.herokuapp.com/img/logo.png";
            $_POST['Id']=$_SESSION['Id'];
              
            $data = new data;
            $response = $data->InsertEventsDb($_POST);
            if($response=='success'){
                echo '<script>alert("You need to Select a Category")</script>';
                unset($_POST);
                header("Location: index.php");   
            }else {
                echo '<script>alert("Sorry Event not Saved, Check your input or something went wrong, please try again")</script>';
                unset($_POST);
            }
        }else{
?>        
        <main>
        <div class='registrtionform'>
            <div class="">
                <h2>Create Event</h2>
            </div>
         
            <div class="formCEvent"> 
                <form action="" method="post" name="customerReg" id= "cr">           
                <span class='formelementc'><input class='formelement' id="en" name="eventName"  placeholder="Event Name" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="1"></span><br>
                <span class='formelementc'><label class='' for="eDate">Event Date </label><br></span><br>
                    <span class='formelementc'><input class='formelement' type="date" id="ed" name="eventDate" placeholder="Event Date" required tabindex="2"> </span><br>
                    <span class='formelementc'><label class='' for="etime">Event Time</label><br></span><br>
                    
                    <span class='formelementc'><input class='formelement' type="time" id="et" name="eventTime" required tabindex="3"></span><br>
                    <span class='formelementc'><input class='formelement' id="ead" name="address"  placeholder="Address" type="text" required tabindex="4"></span><br>
                    <span class='formelementc'><input class='formelement' id="ect" type="text"  name="city" placeholder="City" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="5"></span><br>
                    <span class='formelementc'><input class='formelement' id="eco" name="country"  placeholder="Country" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required tabindex="6"></span><br>
                    <br>
                    <span class='formelementc'><input class='formelement'  name="submit" id="ceSub" type="submit" value="Submit" tabindex="7"></span><br>
                </form>
            </div>
            </div>
        </main>

<?php require 'footer.php';} ?>
    </body>
</html>
