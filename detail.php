<?php
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, "http://modul9.test/api.php?id=".$_GET['id']); 
    $result = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($result, true);

    if (isset($result["error"])) {
        echo $result["error"];
    }else{
        switch ($row["completed"]){
            case "1":
            $complete = "Completed";
            break;
    
            default:
            $complete = "Not Complete";
            break;
        }

        foreach ($result as $row) {
            echo $row["id"] . ". " . "todo : " . $row["todo"] .  "<br> Status : " . $complete;
        }
    }
    echo "<br>";
    echo "<a href='index.php'>Back</a>";
    ?>