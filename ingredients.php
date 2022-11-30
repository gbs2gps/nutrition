<head>
    <title>Nutralytics</title>
    <link rel="stylesheet" href="admin.css">
</head>

        <div class="logo-dark">Ingredients</div>
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
require("ingredientMethod.php");
// include("connect-db.php");
session_start();
if( empty($_SESSION['IngredientID']) ) {
     $_SESSION['IngredientID'] = null;
}
$list_of_ingredient = getIngredient();
$ingredient_print = null;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if ($_POST['btnAction'] =='Add') 
  {
      addIngredient($_POST['Ingredient_Name']);
      $list_of_ingredient = getIngredient();
  }
  else if ($_POST['btnAction'] == 'Update')
  {
     $_SESSION['IngredientID'] = $_POST['ingredient_to_update'];
     getIngredientByID($_POST['ingredient_to_update']);
  }
  else if ($_POST['btnAction'] == 'Confirm update')
  {
     updateIngredient($_SESSION['IngredientID'],$_POST['Ingredient_Name']);
     $_SESSION['rIngredientID'] = null;
     $list_of_ingredient = getIngredient();
  }
  else if ($_POST['btnAction'] == 'Delete')
  {
     deleteIngredient($_POST['ingredient_to_delete']);
     $list_of_ingredient = getIngredient();
  }
  else if ($_POST['btnAction'] == 'Search')
  {
     $ingredient_print = getIngredientByID($_POST['IngredientID']);
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
  

<form name="mainForm" action="ingredients.php" method="post">
  <div class="row mb-3 mx-3">
    Ingredient Name:
    <input type="text" class="form-control" name="Ingredient_Name" required
    />            
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark" 
           title="Insert a Ingredient" />
    <input type="submit" value="Confirm update" name="btnAction" class="btn btn-primary" 
           title="Update a Ingredient" />  
  </div>  

</form>
<form name="mainsForm" action="ingredients.php" method="post">
  <div class="row mb-3 mx-3">
    IngredientID:
    <input type="text" class="form-control" name="IngredientID" required
    />            
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Search" name="btnAction" class="btn btn-dark" 
           title="Search" /> 
  </div>  

</form>
<?php echo $ingredient_print['IngredientID'];?> <br>
<?php echo $ingredient_print['Ingredient_Name'];?>
<h3>List of Ingredients</h3>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <tr style="background-color:#091745">
    <th width="30%"><b>IngredientID</b></th>
    <th width="30%"><b>Ingredient Name</b></th>
        <th><b>Update?</b></th>
    <th><b>Delete?</b></th>
  </tr>
  </thead>
<?php foreach ($list_of_ingredient as $Ingredient_info): ?>
  <tr>
     <td><?php echo $Ingredient_info['IngredientID']; ?></td>
     <td><?php echo $Ingredient_info['Ingredient_Name']; ?></td>
     <td>
             <form action="ingredients.php" method="post">
          <input type="submit" value="Update" name="btnAction" class="btn btn-primary" 
                title="Click to update this Ingredient" />
          <input type="hidden" name="ingredient_to_update" 
                value="<?php echo $Ingredient_info['IngredientID']; ?>"
          />                
        </form>
	     </td>
	          <td>
             <form action="ingredients.php" method="post">
          <input type="submit" value="Delete" name="btnAction" class="btn btn-primary" 
                title="Click to delete this Ingredient" />
          <input type="hidden" name="ingredient_to_delete" 
                value="<?php echo $Ingredient_info['IngredientID']; ?>"
          />                
        </form>
	     </td>
  </tr>
<?php endforeach; ?>
</table>
</div>   
