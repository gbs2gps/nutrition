
<?php include('../'); ?>
<html>

<head>
    <title>Nutralytics</title>
    <link rel="stylesheet" href="admin.css">
</head>

        <div class="logo-dark">Welcome to Nutralytics</div>
         
        <input class="dark-light" type="checkbox" id="dark-light" name="dark-light"/>
            <label for="dark-light"></label>
	
            <form action="index.php" method="POST" class= "logo-light2">
                <div class="insert-info">
                    User ID: 
                    <input type="text" name="UserID" placeholder="Enter User ID">
                    <br>
                    
                    Password: 
                    <input type="text" name="Password" placeholder="Enter Password">
                    <br>
</div>
<br>
                    <input type="submit" name="submit" value="Login" class="button-submit">

                </form>

                    </div>
                </input>
            </div>

           
            <form action="createAccount.php" method="POST" class= "logo-light2">
            <input type="submit" name="submit" value="Create Account" class="button-submit">
</form>


                
</div>
            
                
           
   
</body>

</html>

<?php

    if(isset($_POST['submit'])){
        $Password = $_POST['Password'];
        $Calories_Goal = $_POST['Calories_Goal'];
        $sql = "SELECT * FROM Users WHERE Password='$Password' AND Calories_Goal='$Calories_Goal'";
        $res = mysqli_query($conn, $sql);
    }

?>