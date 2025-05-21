<?php
$dbFile = __DIR__ . '/notes.db';
$db = new SQLite3($dbFile);

// Ensure the notes table exists
$db->exec("CREATE TABLE IF NOT EXISTS notes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

$argv = $_SERVER['argv'];
$script = array_shift($argv);
$command = isset($argv[0]) ? $argv[0] : null;

function showHelp()
{
    echo "Usage:\n";
    echo "  php notes.php add \"your note\"   Add a new note\n";
    echo "  php notes.php list                List all notes\n";
}

if ($command === 'add') {
    $note = isset($argv[1]) ? $argv[1] : '';
    if ($note === '') {
        echo "No note provided.\n";
        showHelp();
        exit(1);
    }
    $stmt = $db->prepare('INSERT INTO notes(content) VALUES (:content)');
    $stmt->bindValue(':content', $note, SQLITE3_TEXT);
    $stmt->execute();
    echo "Note added.\n";
} elseif ($command === 'list') {
    $results = $db->query('SELECT id, content, created_at FROM notes ORDER BY id ASC');
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        echo sprintf("%d | %s | %s\n", $row['id'], $row['created_at'], $row['content']);
    }
} else {
    showHelp();
    exit(1);
}
