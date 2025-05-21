# flask-test

This is a simple Flask application that outputs an HTML page with "Hello World!".

Run it with:

```
python app.py
```

## Menu script

An interactive menu is provided in `menu.py` to access the index page and manage notes:

```
python menu.py
```

## Notes application

A small CLI notepad backed by SQLite is provided in `notes.py`.

### Adding a note

```
python notes.py add "Your note text"
```

### Listing notes

```
python notes.py list
```
