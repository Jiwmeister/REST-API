<?php
require 'db.php';

//setting header
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");

//checking request method
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id']) && !isset($_GET['complete'])) {
            getOneTodo($conn, $_GET['id']);
        }else {
            getTodos($conn);
        }
        break;
        case 'POST':
            if (isset($_GET['id']) 
                && isset($_POST['todo']) 
                && isset ($_POST['complete'])) {
                updateTodo($conn, $_GET['id'], $_POST['todo'], $_POST['complete']);
            }else {
                addTodo($conn, $_POST['todo']);
            }
            break;
            case 'DELETE':
                deleteTodo($conn, $_GET['id']);
                break;
}

//function to showing all todo
function getTodos($conn){
    $sql = "SELECT * FROM todos";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }else {
        echo json_encode(["error"=>"Data not found!"]);
    }
}

//function to showing all todo
function getOneTodo($conn, $id){
    $sql = "SELECT * FROM todos WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }else {
        echo json_encode(["error"=>"Data not found!"]);
    }
}

function addTodo($conn, $todo){
    $sql = "INSERT INTO todos(todo) VALUES('$todo')";
    $result = $conn->query($sql);
    if ($result) {
        echo json_encode(["success" =>"Success add To Do!"]);
    }else{
        echo json_encode(["error"=> mysqli_error($conn)]);
    }
}

function updateTodo($conn, $id, $todo, $complete){
    switch ($complete){
        case "true":
        $complete = "1";
        break;

        default:
        $complete = "0";
        break;
    }
    $sql = "UPDATE todos SET todo='$todo', completed=$complete WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result) {
        echo json_encode(["success" =>"Success edit To Do!"]);
    }else{
        echo json_encode(["error"=>mysqli_error($conn)]);
    }
}

function deleteTodo($conn, $id){
    $sql = "DELETE FROM todos WHERE id='$id' ";
    $result = $conn->query($sql);
    if ($result) {
        echo json_encode(["success" =>"Success delete To Do!"]);
    }else{
        echo json_encode(["error"=>mysqli_error($conn)]);
    }
}

/*function completeTodo($conn, $id, $complete){
  
    if($complete == 'false'){
        $complete = "0";
    }else{
        $complete = "1";
    }

    $sql = "UPDATE todos SET completed=$complete WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result) {
        echo json_encode(["success" =>"Success update To Do!"]);
    }else{
        echo json_encode(["error"=>mysqli_error($conn)]);
    }
}*/