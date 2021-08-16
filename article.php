<?php

use App\Classes\Data;
require_once 'vendor/autoload.php';
$article= new Data();
$result = $article->getData();
// print_r($result);
if(isset($_POST['date']))
{

  $title=$_POST['title'];
  $overview=$_POST['overview'];
  $content=$_POST['content'];
  $date=$_POST['date'];
  

  $article->insertData($title,$overview,$content,$date);
  
}
// foreach($result->fetchAll() as $k=>$v) {
//   echo $v;
// return $v;}
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
  
  <?php foreach($result as $ref){
    $title=$ref['title'];
    $overview=$ref['overview'];
    $content=$ref['content'];
    $date=$ref['date'];
    echo "<tr>
    <th>$title</th>
    <th>$overview</th>
    <th>$content</th>
    <th>$date</th>

   
  </tr>";
  } ?>

 </tr> 
  
  <tr> 
  
     <td><input type="text" name="title" id="title"></td>
     <td><input type="text" name="overview" id="overview"></td>
     <td><input type="text" name="content" id="content"></td>
     <td><input type="date" name="date" id="date"></td>
    </tr> 
  </table>
  <input type="submit" name="save" value="submit">
</form>
</body>
</body>
</html>