<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NYR</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles/card.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon-temp/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-temp/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-temp/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon-temp/site.webmanifest">
    <link rel="stylesheet" href="https://use.typekit.net/sbw7qon.css">
    <?php
    function newCard($course, $title, $description, $date) {
        echo <<<EOT
        <li class="card">
            <div class="cardTitleBar">
                <h1>$course</h1>
            </div>
            <div class="cardContent">
                <h2>$title</h2>
                <br>
                <p>$date</p>
                <br>
                <p>$description</p>
            </div>
        </li>
        EOT;
    }

    $db = new PDO('sqlite:database.db');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputCourse = $_POST['course'];
        $inputTitle = $_POST['title'];
        $inputDescription = $_POST['description'];
        $inputDueDate = $_POST['dueDate'];

        $query = $db->prepare('INSERT INTO list VALUES (:c, :t, :d, :dD, 0);');
        $query->execute([':c'=>$inputCourse, ':t'=>$inputTitle, ':d'=>$inputDescription,':dD'=>$inputDueDate]);
    }

    $query = $db->prepare('SELECT * FROM list');
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $db = null;
    ?>
</head>
<body>
    <main>
        <section class="widget tall">
            <ul class="list">
                <li class="card">
                    <div class="cardTitleBar">
                        <h1>Example Course</h1>
                    </div>
                    <div class="cardContent">
                        <h2>Example Title</h2>
                        <br>
                        <p>4242-42-42</p>
                        <br>
                        <p>Example Description, lorem ipsum dolor sit amet consectetuer adipiscing elit sed diam nonummy nibh</p>
                    </div>
                </li>
                <?php
                foreach ($result as $row) {
                    list($year, $month, $day) = explode('-', $row['dueDate']);
                    if ((mktime(0, 0, 0, $month, $day, $year) < time()) && $row['status'] === 0) {
                        newCard($row['course'], $row['title'], $row['description'], $row['dueDate']);
                    }
                }
                ?>
            </ul>
        </section>
        <section class="widget tall">
            <ul>
                <?php
                foreach ($result as $row) {
                    list($year, $month, $day) = explode('-', $row['dueDate']);
                    if ((mktime(0, 0, 0, $month, $day, $year) >= time()) && $row['status'] === 0) {
                        newCard($row['course'], $row['title'], $row['description'], $row['dueDate']);
                    }
                }
                ?>
            </ul>
        </section>
        <section class="widget">
            <ul>
                <?php
                foreach ($result as $row) {
                    list($year, $month, $day) = explode('-', $row['dueDate']);
                    if ($row['status'] === 1) {
                        newCard($row['course'], $row['title'], $row['description'], $row['dueDate']);
                    }
                }
                ?>
            </ul>
        </section>
        <section class="widget">
            <form action=""></form>
        </section>
    </main>
</body>
</html>