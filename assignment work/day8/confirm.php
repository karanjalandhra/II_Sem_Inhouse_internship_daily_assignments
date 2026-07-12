<?php

include("header.php");

function grade($cgpa)
{

if($cgpa>=9)
{

return array("Excellent","success");

}

elseif($cgpa>=8)
{

return array("Very Good","primary");

}

elseif($cgpa>=7)
{

return array("Good","warning");

}

else
{

return array("Keep Improving","danger");

}

}

$name=$_POST['name'];
$email=$_POST['email'];
$cgpa=$_POST['cgpa'];
$branch=$_POST['branch'];
$college=$_POST['college'];
$gender=$_POST['gender'];
$course=$_POST['course'];
$address=$_POST['address'];

if(empty($name)||empty($email)||empty($cgpa)||empty($branch)||empty($college))
{

echo "<div class='container mt-5'>
<div class='alert alert-danger'>
Please fill all required fields.
</div>
</div>";

include("footer.php");

exit();

}

$result=grade($cgpa);

$message=$result[0];
$color=$result[1];

?>

<div class="container mt-5">

<div class="card shadow">

<div class="header">

<h2>

Registration Successful

</h2>

</div>

<div class="card-body text-center">

<img src="https://via.placeholder.com/120">

<h3 class="mt-3">

<?php echo $name; ?>

</h3>

<p>

<?php echo date("l, d F Y"); ?>

</p>

<span class="badge bg-<?php echo $color; ?>">

<?php echo $message; ?>

</span>

<hr>

<p><b>Email :</b> <?php echo $email; ?></p>

<p><b>CGPA :</b> <?php echo $cgpa; ?></p>

<p><b>Branch :</b> <?php echo $branch; ?></p>

<p><b>College :</b> <?php echo $college; ?></p>

<p><b>Gender :</b> <?php echo $gender; ?></p>

<p><b>Course :</b> <?php echo $course; ?></p>

<p><b>Address :</b> <?php echo $address; ?></p>

<a href="index.php"
class="btn btn-success">

Register Another Student

</a>

</div>

</div>

</div>

<?php include("footer.php"); ?>