# php-test

This is a simple PHP application that outputs an HTML page with "Hello World!".

Run it with: `php index.php`

## Menu script

An interactive menu is provided in `menu.php` to access the index page and manage notes:

```
php menu.php
```

## Notes application

A small CLI notepad backed by SQLite is provided in `notes.php`.

### Adding a note

```
php notes.php add "Your note text"
```

### Listing notes

```
php notes.php list
```
