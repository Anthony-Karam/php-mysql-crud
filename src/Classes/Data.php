<?php

namespace App\Classes;

use App\Classes\Connection;
use PDO;
use PDOException;

session_start();

class Data
{


    public function insertArticle(string $title, string $overview, string $content, $date, $user_id)
    {
        $db = new Connection();
        $conn = $db->connect();
        try {
            $querry = "INSERT INTO articles (title,overview,content,date,user_id) VALUES ('$title','$overview','$content','$date',$user_id)";
            $conn->exec($querry);
            header("Location:../../article.php");
        } catch (PDOException $e) {

            echo $querry . "<br>" . $e->getMessage();
        }

        $conn = null;
    }

    public function getSingleArticle($id)
    {
        $db = new Connection();
        $conn = $db->connect();
        try {
            $sql = "SELECT * FROM articles WHERE id=$id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $array = json_decode(json_encode($stmt->fetchAll(PDO::FETCH_OBJ)), true);

            return  $array;
        } catch (PDOException $e) {

            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function exportProductDatabase($result)
    {
        $timestamp = time();
        $filename = 'Export_excel_' . $timestamp . '.xls';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $isPrintHeader = false;
        foreach ($result as $row) {
            if (!$isPrintHeader) {
                echo implode("\n", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\n", array_values($row)) . "\n"  . "\n";
        }
        exit();
    }




    public function getAllArticles($id, $setLimit)
    {
        $db = new Connection();
        $conn = $db->connect();
        $limit = ($setLimit - 1) * 10;
        try {
            $sql = "SELECT * FROM articles WHERE user_id=$id  LIMIT $limit,10";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $array = json_decode(json_encode($stmt->fetchAll(PDO::FETCH_OBJ)), true);

            return  $array;
        } catch (PDOException $e) {

            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function getTotalNumber($id)
    {
        $db = new Connection();
        $conn = $db->connect();
        // $id = $_SESSION['id'];
        try {
            $sql = "SELECT COUNT(*) FROM articles WHERE user_id=$id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $row_count = $stmt->fetchColumn();
            return $row_count;
        } catch (PDOException $e) {
            echo $sql . "
    " . $e->getMessage();
        }

        $conn = null;
    }

    public function deleteArticle($articleId)
    {
        $db = new Connection();
        $conn = $db->connect();
        try {
            $sql = "DELETE FROM articles WHERE id= $articleId";

            /*use exec() because no results are returned*/
            $conn->exec($sql);
            echo "Record deleted successfully";
            header("Location:../../article.php");
            exit();
        } catch (PDOException $e) {
            echo $sql . "
    " . $e->getMessage();
        }

        $conn = null;
    }


    public function updateArticle($articleId, $title, $overview, $content, $date)
    {
        $db = new Connection();
        $conn = $db->connect();
        try {


            $sql = "UPDATE articles set title='$title' ,overview='$overview',content='$content',date='$date' WHERE id=$articleId";
            $conn->exec($sql);
            /*use exec() because no results are returned*/
            echo "Record Updated successfully";
            header("Location:../../article.php");

            exit();
        } catch (PDOException $e) {
            echo $sql . "
    " . $e->getMessage();
        }

        $conn = null;
    }
}
