<?php
function addRecipe($RecipeID,$Recipe_Directions)
{
    global $db;
    $query = "INSERT INTO Recipe VALUES (:RecipeID,:Recipe_Directions)";  
    try {
        $statement = $db->prepare($query);
	$statement->bindValue(':RecipeID', $RecipeID);
        $statement->bindValue(':Recipe_Directions', $Recipe_Directions);
        $statement->execute();
        $statement->closeCursor();

        // if ($statement->rowCount() == 0)
        //     echo "Failed to add a friend <br/>";
    }
    catch (PDOException $e) 
    {
        // echo $e->getMessage();
        // if there is a specific SQL-related error message
        //    echo "generic message (don't reveal SQL-specific message)";

        if (str_contains($e->getMessage(), "Duplicate"))
		   echo "Failed to add a friend <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

function getRecipes()
{
    global $db; 
    $query = "SELECT * FROM recipe";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();   // fetch()
    $statement->closeCursor();
    return $result;
}


?>