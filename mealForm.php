<head>
    <title>Nutrilytics</title>
    <link rel="stylesheet" href="admin.css">
</head>

<input class="dark-light" type="checkbox" id="dark-light" name="dark-light"/>
  	<label for="dark-light"></label>

  	<div class="light-back"></div> 


  	<div class="sec-center"> 	
	  	<input class="dropdown" type="checkbox" id="dropdown" name="dropdown"/>
	  	<label class="for-dropdown" for="dropdown">Nutrilytics Menu <i class="uil uil-arrow-down"></i></label>

      <div class="section-dropdown"> 
  			<a href="index.php">Home</a>
		  	<input class="dropdown-sub" type="checkbox" id="dropdown-sub" name="dropdown-sub"/>
		  	<label class="for-dropdown-sub" for="dropdown-sub">Meals</label>
	  		<div class="section-dropdown-sub"> 
	  			<a href="mealForm.php">All Meals</a>
	  			<a href="your_meals.php">Your Meals</a>
	  		</div>
  			<a href="recipeForm.php">Recipes</a>
  			<a href="ingredients.php">Ingredients</a>
			<a href="#">Logout</a>

  		</div>
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
      addMeal($_POST['MealName'],$_POST['Calories'],$_POST['Serving_Size']);
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
}
?>
<!DOCTYPE html>
<html>
<head>
<div class=container-4>
  <h2>Add or Update a Meal</h2>  

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
    <input type="submit" value="Add" name="btnAction" class="button-orange2" 
           title="Insert a Meal" />
    <input type="submit" value="Confirm update" name="btnAction" class="button-orange2" 
           title="Update a Meal" />  
  </div>  

  <br>  
  <h2>List of All Meals</h2>  

  
</form>       
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <tr style="background-color:#fff">
 
    
    <tr>
    <th>
  <div class="stuff">
  Meal ID
  </div>
</th>

<th>
  <div class="stuff">
  Meal Name
  </div>
</th>

<th>
  <div class="stuff">
  Calories
  </div>
</th>

<th>
  <div class="stuff">
  Serving Size?
  </div>
</th>
<th>
  <div class="stuff">
    Delete?
  </div>
</th>

<th>
  <div class="stuff">
    Update?
  </div>
</th>


  </tr>
  </tr>
  </thead>
  <br>
<?php foreach ($list_of_meals as $meal_info): ?>
  <tr>
     <td><?php echo $meal_info['MealID']; ?></td>
     <td><?php echo $meal_info['MealName']; ?></td>
     <td><?php echo $meal_info['Calories']; ?></td>
     <td><?php echo $meal_info['Serving_Size']; ?></td>
     <td>
     <br>  

             <form action="mealForm.php" method="post">
          <input type="submit" value="Update" name="btnAction" class="button-orange" 
                title="Click to update this meal" />
          <input type="hidden" name="meal_to_update" 
                value="<?php echo $meal_info['MealID']; ?>"
          />                
        </form>
	     </td>
	          <td>
            <br>

             <form action="mealForm.php" method="post">
          <input type="submit" value="Delete" name="btnAction" class="button-orange" 
                title="Click to delete this meal" />
          <input type="hidden" name="meal_to_delete" 
                value="<?php echo $meal_info['MealID']; ?>"
          />                
        </form>
	     </td>
  </tr>
<?php endforeach; ?>
</table>
</div>