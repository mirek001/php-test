from app import get_index_html
from notes import add_note, list_notes


def main_menu() -> str:
    print("Main Menu")
    print("1. Show index page")
    print("2. Notes")
    print("3. Exit")
    return input("Select an option: ")


def notes_menu() -> str:
    print("Notes Menu")
    print("1. Add note")
    print("2. List notes")
    print("3. Back")
    return input("Select an option: ")


def main() -> None:
    while True:
        choice = main_menu()
        if choice == '1':
            print(get_index_html())
        elif choice == '2':
            while True:
                n_choice = notes_menu()
                if n_choice == '1':
                    note = input("Enter note: ").strip()
                    if note:
                        add_note(note)
                elif n_choice == '2':
                    list_notes()
                else:
                    break
        elif choice == '3':
            break
        else:
            print("Invalid option")


if __name__ == '__main__':
    main()
