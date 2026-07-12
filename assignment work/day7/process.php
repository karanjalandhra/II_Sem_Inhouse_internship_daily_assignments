<?php

$errors = [];

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$branch = trim($_POST['branch']);
$phone = trim($_POST['phone']);
$gender = $_POST['gender'] ?? "";
$course = trim($_POST['course']);
$address = trim($_POST['address']);

if(empty($name))
{
    $errors[]="Name is required.";
}
elseif(!preg_match("/^[a-zA-Z ]+$/",$name))
{
    $errors[]="Name should contain only letters.";
}

if(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
    $errors[]="Please enter a valid Email.";
}

if(!is_numeric($phone) || strlen($phone)!=10)
{
    $errors[]="Phone number must be exactly 10 digits.";
}

if(empty($gender))
{
    $errors[]="Please select Gender.";
}

if(strlen($address)<10)
{
    $errors[]="Address should be at least 10 characters.";
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<?php

if(count($errors)>0)
{

echo '<div class="alert alert-danger">';
echo '<h4>Errors Found</h4>';
echo '<ul>';

foreach($errors as $error)
{
echo "<li>$error</li>";
}

echo '</ul>';
echo '<a href="index.php" class="btn btn-danger">Go Back</a>';
echo '</div>';

}

else
{

?>

<div class="card shadow">

<div class="card-header bg-success text-white">

<h2>Registration Successful</h2>

</div>

<div class="card-body">

<h3>Welcome, <?php echo $name; ?> 🎉</h3>

<table class="table table-bordered mt-4">

<tr>

<th>Name</th>

<td><?php echo $name; ?></td>

</tr>

<tr>

<th>Email</th>

<td><?php echo $email; ?></td>

</tr>

<tr>

<th>Branch</th>

<td><?php echo $branch; ?></td>

</tr>

<tr>

<th>Phone</th>

<td><?php echo $phone; ?></td>

</tr>

<tr>

<th>Gender</th>

<td><?php echo $gender; ?></td>

</tr>

<tr>

<th>Course</th>

<td><?php echo $course; ?></td>

</tr>

<tr>

<th>Address</th>

<td><?php echo $address; ?></td>

</tr>

<tr>

<th>Photo</th>

<td>Photo uploaded successfully (UI Only)</td>

</tr>

</table>

<a href="index.php" class="btn btn-primary">

Register Another Student

</a>

</div>

</div>

<?php

}

?>

</div>

</body>

</html>