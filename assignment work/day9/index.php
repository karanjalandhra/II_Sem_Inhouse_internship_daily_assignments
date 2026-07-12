<?php
include("db_connect.php");

$message = "";

if(isset($_POST['register']))
{

$name = $_POST['name'];
$email = $_POST['email'];
$branch = $_POST['branch'];
$course = $_POST['course'];
$cgpa = $_POST['cgpa'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$address = $_POST['address'];
$photo = $_POST['photo'];

$check = mysqli_query($conn,"SELECT * FROM students WHERE email='$email'");

if(mysqli_num_rows($check)>0)
{
$message = "<div class='alert alert-warning'>Email already registered.</div>";
}
else
{

$sql="INSERT INTO students
(name,email,branch,course,cgpa,phone,city,address,photo)

VALUES

('$name','$email','$branch','$course','$cgpa','$phone','$city','$address','$photo')";

if(mysqli_query($conn,$sql))
{

$count=mysqli_query($conn,"SELECT * FROM students");

$total=mysqli_num_rows($count);

$message="<div class='alert alert-success'>
Student Registered Successfully <br>
You are Student #$total
</div>";

}
}

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Student Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="text-center mb-4">Student Registration Form</h2>

<?php echo $message; ?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Name</label>

<input type="text" name="name" class="form-control" required>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input type="email" name="email" class="form-control" required>

</div>

<div class="col-md-6 mb-3">

<label>Branch</label>

<input type="text" name="branch" class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Course</label>

<input type="text" name="course" class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>CGPA</label>

<input type="number" step="0.01" name="cgpa" class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Phone</label>

<input type="text" name="phone" class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>City</label>

<input type="text" name="city" class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Photo Filename</label>

<input type="text" name="photo" class="form-control">

</div>

<div class="col-12 mb-3">

<label>Address</label>

<textarea name="address" class="form-control"></textarea>

</div>

<div class="text-center">

<button class="btn btn-primary" name="register">

Register Student

</button>

<a href="students.php" class="btn btn-success">

View Students

</a>

</div>

</div>

</form>

</div>

</body>

</html>