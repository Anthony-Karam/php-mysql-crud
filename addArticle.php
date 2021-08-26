<?php

use App\Classes\Data;

session_start();

require_once 'vendor/autoload.php';

$id = $_SESSION['id'];

$article = new Data();
// print_r($result);
$title = $_POST['title'];
$overview = $_POST['overview'];
$content = $_POST['content'];
$date = $_POST['date'];

if (!empty($title) && !empty($overview) && !empty($content) && !empty($date)) {

  $article->insertArticle($title, $overview, $content, $date, $id);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <form action="" method="post">
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Overview</th>
          <th>Content</th>
          <th>Date</th>
        </tr>
      </thead>


      <tr>


        <td><input type="text" name="title" id="title"></td>

        <td><input type="text" name="overview" id="overview"></td>
        <td><input type="text" name="content" id="content"></td>
        <td><input type="date" name="date" id="date"></td>

      </tr>
    </table>


    <input type="submit" name="save" value="Save">
  </form>

</body>

</html>