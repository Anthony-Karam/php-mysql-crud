<?php
namespace App\Classes;
use App\Classes\Connection;
use PDO;
use PDOException;

class Data{


    public function insertData(string $title,string $overview,string $content,$date){
        $db = new Connection();
    $conn = $db->connect();
    try {
        $querry = "INSERT INTO articles (title,overview,content,date) VALUES ('$title','$overview','$content','$date')";
        
        $conn->exec($querry);

        echo "New record created successfully";
        
        }
    catch(PDOException $e)
        {
    
            echo $querry . "<br>" . $e->getMessage();
        }
    
    $conn = null;
}

public function getData(){
    $db = new Connection();
    $conn = $db->connect();
    
    try{
        $sql="SELECT * FROM articles";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $array=json_decode(json_encode($stmt->fetchAll(PDO::FETCH_OBJ)),true);

  
       return  $array;

    }
   catch(PDOException $e)
        {
    
            echo $sql . "<br>" . $e->getMessage();
        }
}
}