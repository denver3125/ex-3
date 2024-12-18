<?php

$notesFilePath = 'notes.txt';


function displayNotes($filePath) {
    if (file_exists($filePath)) {
        $notes = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($notes) {
            echo "<ul>";
            foreach ($notes as $index => $note) {
                echo "<li>" . htmlspecialchars($note) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No notes found.</p>";
        }
    } else {
        echo "<p>Notes file does not exist.</p>";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_note']) && !empty($_POST['note'])) {
        $newNote = trim($_POST['note']);
        file_put_contents($notesFilePath, $newNote . PHP_EOL, FILE_APPEND);
    } elseif (isset($_POST['delete_notes'])) {
        file_put_contents($notesFilePath, '');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeon Notes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Galeon Notes</h1>

        
        <form method="post" action="">
            <label for="note">New Note:</label>
            <input type="text" id="note" name="note" required>
            <button type="submit" name="add_note">Add Note</button>
        </form>

        
        <form method="post" action="">
            <button type="submit" name="delete_notes">Delete All Notes</button>
        </form>

        
        <h2>Notes:</h2>
        <?php displayNotes($notesFilePath); ?>
    </div>
</body>
</html>
