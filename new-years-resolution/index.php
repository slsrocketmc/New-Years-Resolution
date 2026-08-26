<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NYR</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon-temp/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-temp/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-temp/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon-temp/site.webmanifest">
    <script>
        function toggleMenu() {
            const menu = document.getElementById("dropdown-menu");
            menu.classList.toggle("show");
        }
    </script>
</head>

<body>
    <div class="content">
        <div class="control widget">
            <button type="button" aria-label="New" class="button menu-toggle" onclick="toggleMenu()">

                <img src="assets/new.svg" alt="New" width="30vw">
            </button>
            <nav id="dropdown-menu" class="hidden-menu">
                <form action="process.php" method="post" target="_blank" class="input-form">
                    <input type="color" name="coloru" id="colour">
                    <input type="text" name="title" id="title">
                    <input type="text" name="description" id="description">
                    <input type="date" name="date" id="date">
                    <div class="complete-form">
                        <input type="reset" value="Reset">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </nav>
        </div>
        <div class="list widget">

            <?php
            newCard();
            newCard();
            newCard();
            newCard();
            newCard();
            ?>

            <div class="card">
                <div class="colour">
                    <div class="course"></div>
                </div>
                <div class="title"></div>
                <div class="description"></div>
                <div class="dueDate"></div>
            </div>
        </div>
        <div class="list widget"></div>
        <div class="list widget"></div>
    </div>
</body>

</html>

<?php

function newCard()
{
    echo '
        <div class="card">
            <div class="colour"></div>
            <div class="title"></div>
            <div class="description"></div>
            <div class="dueDate"></div>
        </div>
    
    ';
}

?>