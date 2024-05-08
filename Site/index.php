<html>
    <head>
        <title>Smart Locker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="./Assets/lock-48.ico">
        <link rel="stylesheet" href="./Assets/index.css">
        <link rel="stylesheet" href="./Assets/fontawesome/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body id="menu">
        <?php include "./Components/App/navbar.php" ?>
        <div class='console-container'><span id='text'></span><div class='console-underscore' id='console'>&#95;</div></div>
        <?php include "./Components/App/footer.php"?>
    </body>
    <script>
        consoleText(['Bem-vindo!', 'Sempre seguro!', 'Smart Locker']);

        function consoleText(words) {
            let visible = true,
            con = document.getElementById('console'),
            letterCount = 1,
            x = 1,
            waiting = false,
            target = document.getElementById('text')

            target.setAttribute('style', 'color: #000')

            window.setInterval(() => {
                if (letterCount === 0 && waiting === false) {
                    waiting = true;
                    target.innerHTML = words[0].substring(0, letterCount)

                    window.setTimeout(() => {
                        let usedWord = words.shift();
                        words.push(usedWord);

                        x = 1;

                        target.setAttribute('style', 'color: #000')
                        letterCount += x;

                        waiting = false;
                    }, 1000)
                } else if (letterCount === words[0].length + 1 && waiting === false) {
                    waiting = true;

                    window.setTimeout(() => {
                        x = -1;
                        letterCount += x;
                        waiting = false;
                    }, 1000)
                } else if (waiting === false) {
                    target.innerHTML = words[0].substring(0, letterCount)
                    letterCount += x;
                }
            }, 120)

            window.setInterval(() => {
                if (visible === true) {
                con.className = 'console-underscore hidden'
                visible = false;

                } else {
                con.className = 'console-underscore'

                visible = true;
                }
            }, 400)
        }
    </script>
</html>