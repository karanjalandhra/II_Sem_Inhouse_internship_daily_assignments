<?php

include "db.php";

// Check if ID is provided
if(!isset($_GET['id']))
{
    header("Location:index.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch student information
$stmt = mysqli_prepare($conn,"SELECT name, photo FROM students WHERE id=?");
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)==0)
{
    header("Location:index.php");
    exit();
}

$student = mysqli_fetch_assoc($result);

$name = $student['name'];
$photo = $student['photo'];

// Delete photo from uploads folder
if($photo != "" && file_exists("uploads/".$photo))
{
    unlink("uploads/".$photo);
}

// Delete student record
$stmt = mysqli_prepare($conn,"DELETE FROM students WHERE id=?");
mysqli_stmt_bind_param($stmt,"i",$id);

if(mysqli_stmt_execute($stmt))
{
    header("Location:index.php?success=".urlencode($name." deleted successfully."));
    exit();
}
else
{
    header("Location:index.php?success=".urlencode("Unable to delete student."));
    exit();
}

?>