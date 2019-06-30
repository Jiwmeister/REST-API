<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>To Do App</h1>
    <form  method="POST">
    <input type="text" name="todo" placeholder="type todo">
    <input type="submit" value="save" name="save">
    </form>

    <!-- insert todo with post request-->
    <?php
    if(isset($_POST["save"])){
        $todo = $_POST["todo"];
        $params = ["todo" => $todo];
        $curl= curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://modul9.test/api.php");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $result = curl_exec($curl);
        curl_close($curl);
    }
    ?>
    <!-- show todo with get request -->
    <div>
    <?php
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, "http://modul9.test/api.php");
    $result = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($result, true);

    if (isset($result["error"])) {
        echo $result["error"];
    }else{
        foreach ($result as $row) {
            echo $row["id"] . ". " . "todo : " . $row["todo"] . " <a href='delete.php?id=" . $row["id"] .
             "'>Delete</a>" . " <a href='edit.php?id=" . $row["id"] .
             "'>Edit</a>" . " <a href='detail.php?id=" . $row["id"] .
             "'>Detail</a>" . "<br/>";
        }
    }
    ?>
    </div>
</body>
</html>