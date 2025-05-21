import os
import sqlite3

DB_FILE = os.path.join(os.path.dirname(__file__), 'notes.db')


def get_connection():
    conn = sqlite3.connect(DB_FILE)
    conn.execute(
        """
        CREATE TABLE IF NOT EXISTS notes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            content TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
        """
    )
    return conn


def add_note(note: str, conn: sqlite3.Connection | None = None) -> None:
    close = False
    if conn is None:
        conn = get_connection()
        close = True
    conn.execute("INSERT INTO notes(content) VALUES (?)", (note,))
    conn.commit()
    if close:
        conn.close()
    print("Note added.")


def list_notes(conn: sqlite3.Connection | None = None) -> None:
    close = False
    if conn is None:
        conn = get_connection()
        close = True
    for row in conn.execute("SELECT id, content, created_at FROM notes ORDER BY id ASC"):
        print(f"{row[0]} | {row[2]} | {row[1]}")
    if close:
        conn.close()


def show_help() -> None:
    print("Usage:")
    print("  python notes.py add \"your note\"   Add a new note")
    print("  python notes.py list                 List all notes")


def handle_command(argv: list[str]) -> int:
    if not argv:
        show_help()
        return 1
    command = argv[0]
    if command == 'add':
        note = argv[1] if len(argv) > 1 else ''
        if not note:
            print("No note provided.")
            show_help()
            return 1
        add_note(note)
    elif command == 'list':
        list_notes()
    else:
        show_help()
        return 1
    return 0


if __name__ == '__main__':
    import sys

    exit(handle_command(sys.argv[1:]))
