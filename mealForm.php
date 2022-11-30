<head>
    <title>Nutralytics</title>
    <link rel="stylesheet" href="admin.css">
</head>

        <div class="logo-dark">All Meals</div>
        <input class="dark-light" type="checkbox" id="dark-light" name="dark-light"/>
            <label for="dark-light"></label>
            <div class="sec-center"> 	
                <input class="dropdown" type="checkbox" id="dropdown" name="dropdown"/>
                    <label class="for-dropdown" for="dropdown">  Dropdown Menu <i class="uil uil-arrow-down"></i></label>
                    <div class="section-dropdown"> 
                        <a href="index.php">Profile <i class="uil uil-arrow-right"></i></a>
                        <input class="dropdown-sub" type="checkbox" id="dropdown-sub" name="dropdown-sub"/>
                            <a href="meals.php">Meal <i class="uil uil-arrow-right"></i></a> 
                            <label class="for-dropdown-sub" for="dropdown-sub">All Meals<i class="uil uil-plus"></i></label> <br>
                            <label class="for-dropdown-sub" for="dropdown-sub">Your Meals<i class="uil uil-plus"></i></label>
                        </input>
                        <a href="recipes.php">Recipes <i class="uil uil-arrow-right"></i></a> 
                        <a href="ingredients.php">Ingredients <i class="uil uil-arrow-right"></i></a> 
                    </div>
                </input>
            </div>
<?php
require("connect-db.php");   
require("mealMethod.php");
// include("connect-db.php");
session_start();
if( empty($_SESSION['MealID']) ) {
     $_SESSION['MealID'] = null;
}
$list_of_meals = getMeals();
$meal_print = null;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if ($_POST['btnAction'] =='Add') 
  {
      $MealID = addMeal($_POST['MealName'],$_POST['Calories'],$_POST['Serving_Size']);
      addAdds($_SESSION['UserID'],$MealID[0]);
      $list_of_meals = getMeals();
  }
  else if ($_POST['btnAction'] == 'Update')
  {
     $_SESSION['MealID'] = $_POST['meal_to_update'];
     $meal_print = getMealByID($_POST['meal_to_update']);
  }
  else if ($_POST['btnAction'] == 'Confirm update')
  {
     updateMeal($_SESSION['MealID'],$_POST['MealName'],$_POST['Calories'],$_POST['Serving_Size']);
     $_SESSION['MealID'] = null;
     $list_of_meals = getMeals();
  }
  else if ($_POST['btnAction'] == 'Delete')
  {
     deleteMeal($_POST['meal_to_delete']);
     $list_of_meals = getMeals();
  }
  else if($_POST['btnAction'] == 'Eats')
  {
    $Eat_Name = getMealNameByID($_POST['meal_to_eat']);
    $Calories = getMealCaloriesByID($_POST['meal_to_eat']);
    $EatID = addEaten($Eat_Name,$Calories);
    addEats($_SESSION['UserID'],$EatID[0]);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">      
  <title>DB interfacing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>
<div class="container">
  <h1>Meals</h1>  

<form name="mainForm" action="mealForm.php" method="post">
  <div class="row mb-3 mx-3">
    Meal:
    <input type="text" class="form-control" name="MealName" required
    />          
  </div>  
  <div class="row mb-3 mx-3">
    Calories:
    <input type="text" class="form-control" name="Calories" required
    />          
  </div>  
  <div class="row mb-3 mx-3">
    Serving Size:
    <input type="text" class="form-control" name="Serving_Size" required
    />          
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark" 
           title="Insert a Meal" />
    <input type="submit" value="Confirm update" name="btnAction" class="btn btn-primary" 
           title="Update a Meal" />  
  </div>  

</form>       
<h3>List of Meals</h3>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="30%"><b>Meal ID</b></th>
    <th width="30%"><b>Meal Name</b></th>
    <th width="30%"><b>Calories</b></th>
    <th width="30%"><b>Serving Size</b></th>
        <th><b>Update?</b></th>
    <th><b>Delete?</b></th>
    <th><b>Eat?</b></th>
  </tr>
  </thead>
<?php foreach ($list_of_meals as $meal_info): ?>
  <tr>
     <td><?php echo $meal_info['MealID']; ?></td>
     <td><?php echo $meal_info['MealName']; ?></td>
     <td><?php echo $meal_info['Calories']; ?></td>
     <td><?php echo $meal_info['Serving_Size']; ?></td>
     <td>
             <form action="mealForm.php" method="post">
          <input type="submit" value="Update" name="btnAction" class="btn btn-primary" 
                title="Click to update this meal" />
          <input type="hidden" name="meal_to_update" 
                value="<?php echo $meal_info['MealID']; ?>"
          />                
        </form>
	     </td>
	          <td>
             <form action="mealForm.php" method="post">
          <input type="submit" value="Delete" name="btnAction" class="btn btn-primary" 
                title="Click to delete this meal" />
          <input type="hidden" name="meal_to_delete" 
                value="<?php echo $meal_info['MealID']; ?>"
          />                
        </form>
	     </td>
       <td>
             <form action="mealForm.php" method="post">
          <input type="submit" value="Eats" name="btnAction" class="btn btn-primary" 
                title="Click to eat this meal" />
          <input type="hidden" name="meal_to_eat" 
                value="<?php echo $meal_info['MealID']; ?>"
          />                
        </form>
	     </td>
  </tr>
<?php endforeach; ?>
</table>
</div>
