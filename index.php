<?php
include("config.php");
include("reactions.php");

$getReactions = Reactions::getReactions();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postArray = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'message' => $_POST['message'],
    ];

    $setReaction = Reactions::setReaction($postArray);

    if (isset($setReaction['error']) && $setReaction['error'] != '') {
        echo "<p>Fout: " . htmlspecialchars($setReaction['error']) . "</p>";
    } else {
        echo "<p>Reactie succesvol toegevoegd!</p>";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youtube Remake</title>
</head>
<body>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?si=twI61ZGDECBr4ums" 
            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
            encrypted-media; gyroscope; picture-in-picture; web-share" 
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
    </iframe>

    <h2>Laat een reactie achter</h2>
    <form action="" method="POST">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Reactie:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Plaats Reactie</button>
    </form>

    <h3>Reacties:</h3>
    <?php
    if (!empty($getReactions)) {
        echo "<ul>";
        foreach ($getReactions as $reaction) {
            echo "<li>";
            echo "<strong>" . htmlspecialchars($reaction['name']) . "</strong>: ";
            echo htmlspecialchars($reaction['message']);
            echo " <em>(" . htmlspecialchars($reaction['email']) . ")</em>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Geen reacties gevonden.</p>";
    }
    ?>

</body>
</html>
<?php
$con->close();
?>
