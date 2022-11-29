<?php
function addMeal($MealName, $Calories, $Serving_Size)
{
    global $db;
    $query = "INSERT INTO Meal(MealName, Calories, Serving_Size) VALUES (:MealName,:Calories,:Serving_Size)";  
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':MealName', $MealName);
        $statement->bindValue(':Calories', $Calories);
        $statement->bindValue(':Serving_Size', $Serving_Size);
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
		   echo "Failed to add a meal <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

function getMeals()
{
    global $db; 
    $query = "SELECT MealID,MealName,Calories,Serving_Size FROM Meal";
    $statement = $db->prepare($query);
     $statement->execute();
    $result = $statement->fetchAll();   // fetch()
    $statement->closeCursor();
    return $result;
}
function getMealByID($MealID)  
{
    global $db;
    $query = "SELECT * FROM Meal where MealID = :MealID";

    $statement = $db->prepare($query);
    $statement->bindValue(':MealID', $MealID);
    $statement->execute();
    $result = $statement->fetch(); 
    $statement->closeCursor();    
    return $result;
}
function updateMeal($MealID, $MealName, $Calories, $Serving_Size)
{
    // get instance of PDO
    // prepare statement
    //  1) prepare 
    //  2) bindValue, execute
    global $db;
    $query = "UPDATE Meal SET MealName=:MealName, Calories=:Calories, Serving_Size=:Serving_Size WHERE MealID=:MealID";
    $statement = $db->prepare($query);
    $statement->bindValue(':MealID', $MealID);
    $statement->bindValue(':MealName', $MealName);
    $statement->bindValue(':Calories', $Calories);
    $statement->bindValue(':Serving_Size', $Serving_Size);
    $statement->execute();
    $statement->closeCursor();

    // $statement->query()
    
}
function deleteMeal($MealID)
{
    global $db;
    $query = "DELETE FROM Meal WHERE MealID=:MealID";
    $statement = $db->prepare($query);
    $statement->bindValue(':MealID', $MealID);
    $statement->execute();
    $statement->closeCursor();
}
?>