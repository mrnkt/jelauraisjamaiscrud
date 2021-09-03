<?php

require $_SERVER['DOCUMENT_ROOT'] . '/crud-main/Autoloader.php';

class CarController{
    public function __construct()
    {
        Autoloader::register();
        $this->carDao = new Car;
    }

    public function displayCars(){
        $cars = $this->carDao->findAll();
        $tableHTML = '
        <table class="table table-hover">
						<thead>
							<tr>
							<th scope="col">Immatriculation</th>
							<th scope="col">Couleur</th>
							<th scope="col">Marque</th>
							<th scope="col">Modèle</th>
							<th scope="col"></th>
							</tr>
						</thead>
						<tbody>';
        foreach($cars as $car){
            $tableHTML .= '<tr class="table-default" id="car'.$car->getId().'">';
            $tableHTML .= '<td>'.$car->getPlate().'</td>';
            $tableHTML .= '<td>'.$car->getColor().'</td>';
            $tableHTML .= '<td>'.$car->getBrand().'</td>';
            $tableHTML .= '<td>'.$car->getModel().'</td>';
            $tableHTML .= '<td><img src="image/delete.svg" alt="trash-icon"
                onclick="deleteCar('.$car->getId().')"></td>';
            $tableHTML .= '</tr>';
        }
        $tableHTML .= '</tbody>
        </table>';
        
        return ["status" => "OK", "result" => $tableHTML];

    }

    public function insertCar()
    {
        $id = $this->carDao->insertCar();
        return ["status" => "OK","id"=>$id,"plate" => $_POST["plaque"], "color" =>$_POST["couleur"], "brand" =>$_POST["marque"], "model" =>$_POST["modele"] ];
        
    }


    public function deleteCar($id)
    {
        return ["status" => ($this->carDao->deleteCar($id))? "OK" : "KO"];
    }
}


