<?php
include "db.php";

if(!isset($_GET['id']))
{
    header("Location:index.php");
    exit();
}

$id = intval($_GET['id']);

$result = mysqli_query($conn,"SELECT * FROM students WHERE id='$id'");

if(mysqli_num_rows($result)==0)
{
    header("Location:index.php");
    exit();
}

$student = mysqli_fetch_assoc($result);

$message = "";

if(isset($_POST['update']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $branch = $_POST['branch'];
    $cgpa = $_POST['cgpa'];
    $status = $_POST['status'];

    $photo = $student['photo'];

    // Upload new image
    if(isset($_FILES['photo']) && $_FILES['photo']['error']==0)
    {
        if($photo!="" && file_exists("uploads/".$photo))
        {
            unlink("uploads/".$photo);
        }

        $photo = time()."_".basename($_FILES['photo']['name']);

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            "uploads/".$photo
        );
    }

    if($name=="" || $email=="" || $branch=="")
    {
        $message="<div class='alert alert-danger'>
        Please fill all fields.
        </div>";
    }
    else
    {

        $stmt=mysqli_prepare($conn,"
        UPDATE students
        SET
        name=?,
        email=?,
        branch=?,
        cgpa=?,
        photo=?,
        status=?
        WHERE id=?");

        mysqli_stmt_bind_param(
        $stmt,
        "ssssssi",
        $name,
        $email,
        $branch,
        $cgpa,
        $photo,
        $status,
        $id
        );

        if(mysqli_stmt_execute($stmt))
        {
            header("Location:index.php?success=Student Updated Successfully");
            exit();
        }
        else
        {
            $message="<div class='alert alert-danger'>
            Update Failed
            </div>";
        }

    }

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Edit Student</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>

body{

background:#f5f7fb;

}

.card{

margin-top:40px;

border-radius:15px;

box-shadow:0px 0px 15px rgba(0,0,0,.15);

}

img{

width:120px;

height:120px;

border-radius:50%;

object-fit:cover;

border:3px solid #0d6efd;

}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card">

<div class="card-header bg-primary text-white">

<h3>Edit Student</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form
method="POST"
enctype="multipart/form-data">

<div class="text-center mb-4">

<?php

if($student['photo']!="" && file_exists("uploads/".$student['photo']))
{

?>

<img
src="uploads/<?php echo $student['photo']; ?>">

<?php

}
else
{

?>

<img
src="https://via.placeholder.com/120">

<?php

}

?>

</div>

<div class="mb-3">

<label>

Student Name

</label>

<input
type="text"
name="name"
class="form-control"
value="<?php echo htmlspecialchars($student['name']); ?>"
required>

</div>

<div class="mb-3">

<label>

Email

</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo htmlspecialchars($student['email']); ?>"
required>

</div>

<div class="mb-3">

<label>

Branch

</label>

<select
name="branch"
class="form-select">
<option value="Computer Science"
<?php if($student['branch']=="Computer Science") echo "selected"; ?>>
Computer Science
</option>

<option value="Mechanical"
<?php if($student['branch']=="Mechanical") echo "selected"; ?>>
Mechanical
</option>

<option value="Civil"
<?php if($student['branch']=="Civil") echo "selected"; ?>>
Civil
</option>

<option value="Electrical"
<?php if($student['branch']=="Electrical") echo "selected"; ?>>
Electrical
</option>

<option value="Electronics"
<?php if($student['branch']=="Electronics") echo "selected"; ?>>
Electronics
</option>

</select>

</div>

<div class="mb-3">

<label>

CGPA

</label>

<input
type="number"
name="cgpa"
step="0.01"
min="0"
max="10"
class="form-control"
value="<?php echo $student['cgpa']; ?>"
required>

</div>

<div class="mb-3">

<label>

Status

</label>

<select
name="status"
class="form-select">

<option value="Active"
<?php if($student['status']=="Active") echo "selected"; ?>>
Active
</option>

<option value="Inactive"
<?php if($student['status']=="Inactive") echo "selected"; ?>>
Inactive
</option>

</select>

</div>

<div class="mb-3">

<label>

Change Profile Photo

</label>

<input
type="file"
name="photo"
class="form-control"
accept="image/*">

</div>

<div class="d-grid gap-2">

<button
type="submit"
name="update"
class="btn btn-success">

Update Student

</button>

<a
href="index.php"
class="btn btn-secondary">

Back

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>