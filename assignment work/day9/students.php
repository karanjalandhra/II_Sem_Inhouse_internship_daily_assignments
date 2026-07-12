<?php
include("db_connect.php");

$result=mysqli_query($conn,"SELECT * FROM students");

$total=mysqli_num_rows($result);

?>

<!DOCTYPE html>

<html>

<head>

<title>Students</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="text-center">

Registered Students

</h2>

<table class="table table-bordered table-hover">

<tr class="table-dark">

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Branch</th>
<th>Course</th>
<th>CGPA</th>
<th>Phone</th>
<th>City</th>
<th>Photo</th>
<th>Address</th>
<th>Date</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

$class="";

if($row['cgpa']>8)
{
$class="table-success";
}

?>

<tr class="<?php echo $class;?>">

<td><?php echo $row['id'];?></td>

<td><?php echo $row['name'];?></td>

<td><?php echo $row['email'];?></td>

<td><?php echo $row['branch'];?></td>

<td><?php echo $row['course'];?></td>

<td><?php echo $row['cgpa'];?></td>

<td><?php echo $row['phone'];?></td>

<td><?php echo $row['city'];?></td>

<td><?php echo $row['photo'];?></td>

<td><?php echo $row['address'];?></td>

<td><?php echo $row['date_registered'];?></td>

</tr>

<?php
}
?>

</table>

<div class="alert alert-info">

Total Students : <?php echo $total; ?>

</div>

</div>

</body>

</html>