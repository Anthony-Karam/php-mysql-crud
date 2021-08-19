<?php

use App\Classes\Data;

require_once 'vendor/autoload.php';
$articleId = $_GET['articleId'];


$update = new Data();
$result = $update->getSingleData($articleId);

$title = $_POST['title'];
$overview = $_POST['overview'];
$content = $_POST['content'];
$date = $_POST['date'];
echo $title;
if (isset($_POST['update'])) {

    $update->updateArticle($articleId, $title, $overview, $content, $date,);
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
                <?php foreach ($result as $ref) {
                    $articleId = $ref['id'];
                    $title = $ref['title'];
                    $overview = $ref['overview'];
                    $content = $ref['content'];
                    $date = $ref['date'];
                ?>
            </tr>
            <tr>
                <td><input type="text" name="title" id="title" value="<?php echo $title; ?>"></td>
                <td><input type="text" name="overview" id="title" value="<?php echo $overview; ?>"></td>
                <td><input type="text" name="content" id="title" value="<?php echo $content; ?>"></td>
                <td><input type="text" name="date" id="title" value="<?php echo $date; ?>"></td>
            </tr>
            <input type="submit" name="update" value="Update">
    </form>

    </table>
<?php
                }
?>




</body>

</html>