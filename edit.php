<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit To Do App</h1>
    <form method="POST">
    <input type="text" name="todo" placeholder="type todo">
    <select name="complete">
        <option value="0">Not Complete</option>
        <option value="1">Completed</option>
    </select>
    <input type="submit" value="edit" name="edit">
    </form>

    <!-- insert todo with post request-->
    <?php
    if(isset($_POST["edit"])){
        $params = [
            "todo" => $_POST["todo"],
            "complete" => $_POST["complete"]
        ];
        $curl= curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://modul9.test/api.php?id=".$_GET["id"]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $result = curl_exec($curl);
        curl_close($curl);

        header("Location: index.php");
    }
    ?>
    </div>
</body>
</html>