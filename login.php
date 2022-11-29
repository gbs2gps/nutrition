
<?php include('../'); ?>
<html>

<head>
    <title>Nutralytics</title>
    <link rel="stylesheet" href="admin.css">
</head>

        <div class="logo-dark">Welcome to Nutralytics</div>
         
        <input class="dark-light" type="checkbox" id="dark-light" name="dark-light"/>
            <label for="dark-light"></label>
            <div class="sec-center"> 	
            <form action="" method="POST" class= "logo-light2">
                    Password: 
                    <input type="text" name="Password" placeholder="Enter Password">
                    <br>
                    
                    Daily Calories Goal: 
                    <input type="text" name="Calories_Goal" placeholder="Enter Daily Calories Goal">
                    <br>
                    <a href="base.php">
                    <input type="submit" name="submit" value="Login" class="btn_primary">
</a>
                </form>

                    </div>
                </input>
            </div>
                
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