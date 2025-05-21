from flask import Flask

app = Flask(__name__)

INDEX_HTML = """<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Hello</title>
</head>
<body>
    <h1>Hello World!</h1>
</body>
</html>
"""

@app.route('/')
def index():
    return INDEX_HTML


def get_index_html() -> str:
    """Return the HTML for the index page."""
    return INDEX_HTML


if __name__ == '__main__':
    app.run()
