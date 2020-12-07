<!DOCTYPE html>
<html>
    <head>
        <title>Easy Shortener</title>
        <link rel="stylesheet" href="styles/main.css">
        <script src="/scripts/main.js"></script>
    </head>
    <body>
        <div id="main_div">
            <h1>easy shortener</h1>
            <div id="form">
                <input id="url_input" type="text" name="name" placeholder="shorten your link"  onkeydown="if (event.keyCode==13) link_short();" required>
                <input type="button" value="GO" onclick="link_short()">
            </div>
        </div>
        <div id="error">
            <p id="error_text"></p>
        </div>
        <div id="result">
            <h2>Your shorten link :</h2>
            <a id="result_link" href=""></a>
            <button onclick="copy_clipboard()">Copy to clipboard</button>
        </div>
    </body>
    <footer>
        <p>Made by Lucas.P</p>
    </footer>
</html>