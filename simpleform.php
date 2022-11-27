<?php
require("connect-db.php");   
require("recipeMethod.php");
// include("connect-db.php");

$list_of_recipes = getRecipes();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
addRecipe($_POST['RecipeID'],$_POST['Recipe_Directions']);
  if ($_POST['btnAction'] =='Add') 
  {
      addRecipe($_POST['RecipeID'],$_POST['Recipe_Directions']);

  }
}
?>
<div class="container">
  <h1>Recipes</h1>  

<form name="mainForm" action="simpleform.php" method="post">
  <div class="row mb-3 mx-3">
    RecipeID:
    <input type="text" class="form-control" name="RecipeID" required
    />            
  </div> 
  <div class="row mb-3 mx-3">
    Recipe Direction:
    <input type="text" class="form-control" name="Recipe_Directions" required
    />            
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark" 
           title="Insert a Recipe" />            
  </div>  

</form>       

<?php var_dump($list_of_recipes); ?>