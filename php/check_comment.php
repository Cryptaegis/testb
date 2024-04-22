<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Régularisation Commentaire</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
</head>

<body class=" ac-admin titre-admin">
<a href="admin.php">
    <img class="logo-arcadia background" src="../images/arcadia_logo.png" alt="Arcadia logo">
  </a>
  <br>
  <br>


    <?php
    require('connexion.php');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT * FROM comments WHERE validate = 0";
    $result = mysqli_query($conn, $query);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //add button validate and delete
    echo "<h1>Commentaires non traité</h1>";
    foreach ($comments as $comment) {
        echo '<div class="border-form">';
        echo "<h2>{$comment['username']}</h2>\n";
        echo "<p>{$comment['comment']}</p>\n";
        echo "<a href='check_comment.php?validate={$comment['id']}' class='form-btn'>Validate</a>\n";
        echo "<a href='check_comment.php?delete={$comment['id']}' class='form-btn'>Delete</a>\n";
        echo '</div>';
    }

    // if click, comment valide and send to accueil.php 
    if (isset($_GET['validate'])) {
        $id = $_GET['validate'];
        $query = "UPDATE comments SET validate = 1 WHERE id = $id";
        mysqli_query($conn, $query);
        header('location: accueil.php');
    }
    //if, button delete
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE id = $id";
        mysqli_query($conn, $query);
        echo "Supprimer félicitation!";
    }
    ?>


    <?php include "_partial/navbar-regul.php"; ?>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>