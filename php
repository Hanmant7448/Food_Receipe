<?php
$servername = "localhost";
$username = "root";  // Change to your MySQL username
$password = "";      // Change to your MySQL password
$dbname = "food_recipes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
include('db.php');

$sql = "SELECT * FROM recipes ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Recipes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Food Recipes</h1>
        <a href="submit.php" class="add-recipe">Add New Recipe</a>
    </header>

    <div class="recipe-list">
        <?php while($row = $result->fetch_assoc()) { ?>
            <div class="recipe">
                <h2><?php echo $row['title']; ?></h2>
                <p><strong>Ingredients:</strong> <?php echo $row['ingredients']; ?></p>
                <p><strong>Instructions:</strong> <?php echo $row['instructions']; ?></p>
            </div>
        <?php } ?>
    </div>

</body>
</html>

<?php
$conn->close();
?>

<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    $sql = "INSERT INTO recipes (title, ingredients, instructions) VALUES ('$title', '$ingredients', '$instructions')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    $sql = "INSERT INTO recipes (title, ingredients, instructions) VALUES ('$title', '$ingredients', '$instructions')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Recipe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Add New Recipe</h1>
    </header>

    <form action="submit.php" method="POST" class="recipe-form">
        <label for="title">Recipe Title</label>
        <input type="text" id="title" name="title" required>

        <label for="ingredients">Ingredients</label>
        <textarea id="ingredients" name="ingredients" required></textarea>

        <label for="instructions">Instructions</label>
        <textarea id="instructions" name="instructions" required></textarea>

        <button type="submit">Submit Recipe</button>
    </form>

</body>
</html>

<?php
$conn->close();
?>
