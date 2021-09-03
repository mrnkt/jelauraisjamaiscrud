<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/crud-main/models/DAO/Car.dao.php");

/**
 * Class Car
 */
class Car extends CarDAO
{

    public function findAll()
    {
        $sql = "SELECT * FROM voiture";
        return $this->getSelfObjects($sql);
    }



    public function findById($id)
    {
        $request = "SELECT * FROM voiture WHERE id= :id";
        $sth = $this->db->prepare($request);
        $sth->bindParam(':id', $id);
        return $this->getSelfObjectsPreparedStatement($sth);
    }


    public function insertCar()
    {
        $plate = $_POST['plaque'];
        $color = $_POST['couleur'];
        $brand = $_POST['marque'];
        $model = $_POST['modele'];
        // var_dump($_POST);
        $sql = "INSERT INTO `voiture`(`plaque`, `couleur`, `marque`, `modele`) VALUES (:plate, :color, :brand, :model)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':plate', $plate);
        $sth->bindParam(':color', $color);
        $sth->bindParam(':brand', $brand);
        $sth->bindParam(':model', $model);
        // var_dump($sth);
        // return $this->getSelfObjectsPreparedStatement($sth);
        $sth->execute();
        return $this->db->lastInsertId();
    }

    public function deleteCar($id)
    {
        $sql = "DELETE FROM voiture WHERE id = :id";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':id', $id);
        return $sth->execute();
    }
}
