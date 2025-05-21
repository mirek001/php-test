<?php

$dbFile = __DIR__ . '/notes.db';
$db = new SQLite3($dbFile);

// Ensure the notes table exists
$db->exec("CREATE TABLE IF NOT EXISTS notes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

function addNote(SQLite3 $db, string $note): void
{
    $stmt = $db->prepare('INSERT INTO notes(content) VALUES (:content)');
    $stmt->bindValue(':content', $note, SQLITE3_TEXT);
    $stmt->execute();
    echo "Note added.\n";
}

function listNotes(SQLite3 $db): void
{
    $results = $db->query('SELECT id, content, created_at FROM notes ORDER BY id ASC');
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        echo sprintf("%d | %s | %s\n", $row['id'], $row['created_at'], $row['content']);
    }
}

function showHelp(): void
{
    echo "Usage:\n";
    echo "  php notes.php add \"your note\"   Add a new note\n";
    echo "  php notes.php list                List all notes\n";
}

function handleCommand(SQLite3 $db, array $argv): int
{
    $script = array_shift($argv); // remove script name
    $command = $argv[0] ?? null;

    if ($command === 'add') {
        $note = $argv[1] ?? '';
        if ($note === '') {
            echo "No note provided.\n";
            showHelp();
            return 1;
        }
        addNote($db, $note);
    } elseif ($command === 'list') {
        listNotes($db);
    } else {
        showHelp();
        return 1;
    }

    return 0;
}

if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    exit(handleCommand($db, $_SERVER['argv']));
}
