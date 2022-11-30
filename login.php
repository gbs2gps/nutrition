
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
                    Password: 
                    <input type="text" name="Password" placeholder="Enter Password">
                    <br>
                    
                    Daily Calories Goal: 
                    <input type="text" name="Calories_Goal" placeholder="Enter Daily Calories Goal">
                    <br>
</div>
<br>
                    <input type="submit" name="submit" value="Login" class="button-submit">

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