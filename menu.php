<?php
require_once __DIR__ . '/notes.php';

function mainMenu(): void {
    echo "Main Menu\n";
    echo "1. Show index page\n";
    echo "2. Notes\n";
    echo "3. Exit\n";
    echo "Select an option: ";
}

function notesMenu(): void {
    echo "Notes Menu\n";
    echo "1. Add note\n";
    echo "2. List notes\n";
    echo "3. Back\n";
    echo "Select an option: ";
}

while (true) {
    mainMenu();
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case '1':
            // Include index.php to output the HTML
            require __DIR__ . '/index.php';
            break;
        case '2':
            while (true) {
                notesMenu();
                $nChoice = trim(fgets(STDIN));
                if ($nChoice === '1') {
                    echo "Enter note: ";
                    $note = trim(fgets(STDIN));
                    if ($note !== '') {
                        addNote($db, $note);
                    }
                } elseif ($nChoice === '2') {
                    listNotes($db);
                } else {
                    break;
                }
            }
            break;
        case '3':
            exit(0);
        default:
            echo "Invalid option\n";
    }
}
