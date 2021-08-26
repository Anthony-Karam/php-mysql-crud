<?php

use App\Classes\Data;

session_start();
require_once 'vendor/autoload.php';

$username = $_SESSION['username'];
$id = $_SESSION['id'];

$article = new Data();
$number_of_results = $article->getTotalNumber($id);

if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
$result = $article->getAllArticles($id, $page);
$results_per_page = 10;
$number_of_pages = ceil($number_of_results / $results_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="article.css">
  <title>Document</title>
</head>

<body>
  <h1>Welcome <?php echo $username ?></h1>
  <!-- <h1><?php echo $pagination ?></h1> -->
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
      <?php foreach ($result as $ref) {
        $articleId = $ref['id'];
        $title = $ref['title'];
        $overview = $ref['overview'];
        $content = $ref['content'];
        $date = $ref['date'];

        if (isset($_POST['delete'])) {
          $article->deleteArticle($articleId);
        }
        if (isset($_POST['export'])) {
          $article->exportProductDatabase($result);
        }
      ?>

        <form action="article.php" method="post">

          <td><?php echo $title; ?></td>
          <td><?php echo $overview; ?></td>
          <td><?php echo $content; ?></td>
          <td><?php echo $date; ?></td>

          <td><button type="submit" value="Edit" name="edit"><a href="edit.php?articleId=<?php echo $articleId; ?>">Edit</button></td>
          <!-- <td><input type="submit" value="Edit" name="edit"></td> -->
          <td><input type="submit" value="Delete" name="delete"></td>
        </form>
    </tr>
  <?php

      }
  ?>

  </tr>

  </table>
  <?php

  for ($page = 1; $page <= $number_of_pages; $page++) {
    echo ' <a  href ="article.php?page=' . $page . '"style="color:red; display:inline-block">'  . $page . '</a>';
  }
  ?>
  <form action="article.php" method="post">
    <td><input type="submit" value="Export" name="export" style="width: 10%; margin:1em 40em; height:2em"></td>
  </form>
  <button style="width: 10%; margin:5em 40em; height:2em"><a href="./addArticle.php">Add New Article</a></button>

</body>

</html>