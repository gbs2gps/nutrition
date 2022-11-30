<head>
    <title>Nutrilitics</title>
    <link rel="stylesheet" href="admin.css">
</head>

<input class="dark-light" type="checkbox" id="dark-light" name="dark-light"/>
  	<label for="dark-light"></label>

  	<div class="light-back"></div> 


  	<div class="sec-center"> 	
	  	<input class="dropdown" type="checkbox" id="dropdown" name="dropdown"/>
	  	<label class="for-dropdown" for="dropdown">Nutrilitics Menu <i class="uil uil-arrow-down"></i></label>
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
require("recipeMethod.php");
// include("connect-db.php");
session_start();
if( empty($_SESSION['recipeID']) ) {
     $_SESSION['recipeID'] = null;
}
$list_of_recipes = getRecipes();
$recipe_print = null;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if ($_POST['btnAction'] =='Add') 
  {
      addRecipe($_POST['Recipe_Directions']);
      $list_of_recipes = getRecipes();
  }
  else if ($_POST['btnAction'] == 'Update')
  {
     $_SESSION['recipeID'] = $_POST['recipe_to_update'];
     getRecipeByID($_POST['recipe_to_update']);
  }
  else if ($_POST['btnAction'] == 'Confirm update')
  {
     updateRecipe($_SESSION['recipeID'],$_POST['Recipe_Directions']);
     $_SESSION['recipeID'] = null;
     $list_of_recipes = getRecipes();
  }
  else if ($_POST['btnAction'] == 'Delete')
  {
     deleteRecipe($_POST['recipe_to_delete']);
     $list_of_recipes = getRecipes();
  }
  else if ($_POST['btnAction'] == 'Search')
  {
     $recipe_print = getRecipeByID($_POST['RecipeID']);
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
  

<form name="mainForm" action="simpleform.php" method="post">
  <div class="row mb-3 mx-3">
    Recipe Direction:
    <input type="text" class="form-control" name="Recipe_Directions" required
    />            
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark" 
           title="Insert a Recipe" />
    <input type="submit" value="Confirm update" name="btnAction" class="btn btn-primary" 
           title="Update a Recipe" />  
  </div>  

</form>
<form name="mainsForm" action="simpleform.php" method="post">
  <div class="row mb-3 mx-3">
    RecipeID:
    <input type="text" class="form-control" name="RecipeID" required
    />            
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Search" name="btnAction" class="btn btn-dark" 
           title="Search" /> 
  </div>  

</form>
<?php echo $recipe_print['RecipeID'];?>
<?php echo $recipe_print['Recipe_Directions'];?>
<h3>List of recipes</h3>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="30%"><b>Recipe ID</b></th>
    <th width="30%"><b>Recipe Directions</b></th>
        <th><b>Update?</b></th>
    <th><b>Delete?</b></th>
  </tr>
  </thead>
<?php foreach ($list_of_recipes as $recipe_info): ?>
  <tr>
     <td><?php echo $recipe_info['RecipeID']; ?></td>
     <td><?php echo $recipe_info['Recipe_Directions']; ?></td>
     <td>
             <form action="simpleform.php" method="post">
          <input type="submit" value="Update" name="btnAction" class="btn btn-primary" 
                title="Click to update this recipe" />
          <input type="hidden" name="recipe_to_update" 
                value="<?php echo $recipe_info['RecipeID']; ?>"
          />                
        </form>
	     </td>
	          <td>
             <form action="simpleform.php" method="post">
          <input type="submit" value="Delete" name="btnAction" class="btn btn-primary" 
                title="Click to delete this recipe" />
          <input type="hidden" name="recipe_to_delete" 
                value="<?php echo $recipe_info['RecipeID']; ?>"
          />                
        </form>
	     </td>
  </tr>
<?php endforeach; ?>
</table>
</div>   
