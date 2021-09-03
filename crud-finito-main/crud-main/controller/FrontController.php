<?php
require $_SERVER['DOCUMENT_ROOT'] . "/crud-main/controller/CarController.php";

$result = "";
$controller = new CarController;

header('Content-type:application/json;charset=utf-8');

if (isset($_GET['function']) && !empty($_GET['function'])){
    switch($_GET['function']){
        case "displayCars": 
            $result = $controller->displayCars();
            break;   

        case "insertCar": 
            $result = $controller->insertCar();
            break; 

        case "deleteCar": 
            $result = $controller->deleteCar($_GET["id"]);
            break;
    }
    
}
// echo $result;
echo json_encode($result);