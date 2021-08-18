<?php

namespace App\Classes;

use App\Classes\Connection;
use PDOException;


class User

{

  public function strongPassword($password)
  {
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
      echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    } else {
      return true;
    }
  }

  public function store(string $username, string $email, string $password)
  {

    $db = new Connection();
    $conn = $db->connect();
    try {

      $ifExists = "SELECT username, email FROM users WHERE username=:username OR email=:email";
      $stmt = $conn->prepare($ifExists);
      $stmt->execute(['username' => $username, 'email' => $email]);
      $user = $stmt->fetch();
      if (!empty($user)) {
        echo 'username or email exists';
      } else {
        $querry = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
        $conn->exec($querry);
        header("Location:../../article.php");
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }



  public function login(string $username, string $password)
  {
    session_start();
    $db = new Connection();
    $conn = $db->connect();

    try {

      if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $querry = "SELECT email, password,id FROM users WHERE email= :username AND password= :password ";
        // use exec() because no results are returned
        $stmt = $conn->prepare($querry);
        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = $stmt->fetch();
        if (!empty($user)) {
          $_SESSION['id'] = $user['id'];
          header("Location:../../article.php");
          // exit();
        }
      } else {
        $querry = "SELECT username, password,id FROM users WHERE username= :username AND password= :password ";
        // use exec() because no results are returned
        $stmt = $conn->prepare($querry);
        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = $stmt->fetch();
        if (!empty($user)) {
          $_SESSION['id'] = $user['id'];
          header("Location:../../article.php");
          // exit();
        }
      }

      // echo "New record created successfully";
    } catch (PDOException $e) {
      echo $querry . "<br>" . $e->getMessage();
    }
  }
}
