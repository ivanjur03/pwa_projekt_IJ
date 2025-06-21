<?php
include 'connection.php';

$picture = $_FILES['pphoto']['name'];
$title = $_POST['title'];
$about = $_POST['about'];
$content = $_POST['content'];
$category = $_POST['category'];
$date = date('d.m.Y.');

if(isset($_POST['archive'])){
    $archive = 1;
}else{
    $archive = 0;
}

$target_dir = 'img/'.$picture;
move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

$query = "INSERT INTO Vijesti (datum, naslov, sadrzaj, tekst, slika, kategorija, arhiva) VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

$result = mysqli_query($dbc, $query) or die('Error querying database.');

// Get the ID of the newly inserted article
$article_id = mysqli_insert_id($dbc);

mysqli_close($dbc);

// Redirect to the article page
header("Location: clanak.php?id=" . $article_id);
exit();
?>