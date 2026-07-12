<?php
include "db.php";

$message = "";

if(isset($_POST['save']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $branch = $_POST['branch'];
    $cgpa = $_POST['cgpa'];
    $status = $_POST['status'];

    // Validation
    if($name=="" || $email=="" || $branch=="" || $cgpa=="")
    {
        $message = "<div class='alert alert-danger'>All fields are required.</div>";
    }
    elseif($cgpa < 0 || $cgpa > 10)
    {
        $message = "<div class='alert alert-danger'>CGPA must be between 0 and 10.</div>";
    }
    else
    {
        $photo = "";

        if(isset($_FILES['photo']) && $_FILES['photo']['error']==0)
        {
            $photo = time()."_".basename($_FILES["photo"]["name"]);
            $target = "uploads/".$photo;
            move_uploaded_file($_FILES["photo"]["tmp_name"], $target);
        }

        $stmt = mysqli_prepare($conn,
        "INSERT INTO students(name,email,branch,cgpa,photo,status)
         VALUES(?,?,?,?,?,?)");

        mysqli_stmt_bind_param($stmt,
        "ssssss",
        $name,
        $email,
        $branch,
        $cgpa,
        $photo,
        $status);

        if(mysqli_stmt_execute($stmt))
        {
            header("Location: index.php?success=Student Added Successfully");
            exit();
        }
        else
        {
            $message = "<div class='alert alert-danger'>Error while saving data.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Add Student</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>

body{
    background:#f4f6f9;
}

.card{
    border-radius:15px;
    box-shadow:0px 0px 15px rgba(0,0,0,.15);
}

h2{
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card">

<div class="card-header bg-primary text-white">

<h2>Add New Student</h2>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label class="form-label">Student Name</label>
<input
type="text"
name="name"
class="form-control"
placeholder="Enter Student Name"
required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input
type="email"
name="email"
class="form-control"
placeholder="Enter Email"
required>
</div>

<div class="mb-3">
<label class="form-label">Branch</label>

<select name="branch" class="form-select" required>

<option value="">Select Branch</option>

<option>Computer Science</option>

<option>Mechanical</option>

<option>Civil</option>

<option>Electrical</option>

<option>Electronics</option>

</select>

</div>

<div class="mb-3">
<label class="form-label">CGPA</label>

<input
type="number"
step="0.01"
min="0"
max="10"
name="cgpa"
class="form-control"
placeholder="Enter CGPA"
required>

</div>

<div class="mb-3">

<label class="form-label">Profile Photo</label>

<input
type="file"
name="photo"
class="form-control"
accept="image/*">

</div>

<div class="mb-3">

<label class="form-label">Status</label>

<select
name="status"
class="form-select">

<option value="Active">Active</option>

<option value="Inactive">Inactive</option>

</select>

</div>

<div class="d-grid gap-2">

<button
type="submit"
name="save"
class="btn btn-success">

Save Student

</button>

<a
href="index.php"
class="btn btn-secondary">

View Students

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>