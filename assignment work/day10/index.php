<?php
include "db.php";

// --------------------
// Success Messages
// --------------------
$success = "";

if(isset($_GET['success']))
{
    $success = $_GET['success'];
}

// --------------------
// Search & Filter
// --------------------
$search = "";
$branch = "";

if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn,$_GET['search']);
}

if(isset($_GET['branch']))
{
    $branch = mysqli_real_escape_string($conn,$_GET['branch']);
}

// --------------------
// Dashboard Statistics
// --------------------

// Total Students
$totalStudent = 0;
$result = mysqli_query($conn,"SELECT COUNT(*) AS total FROM students");
$row = mysqli_fetch_assoc($result);
$totalStudent = $row['total'];

// Average CGPA
$avgCGPA = 0;
$result = mysqli_query($conn,"SELECT AVG(cgpa) AS avgcgpa FROM students");
$row = mysqli_fetch_assoc($result);

if($row['avgcgpa']!="")
{
    $avgCGPA = number_format($row['avgcgpa'],2);
}

// Active Students
$activeStudents = 0;
$result = mysqli_query($conn,"SELECT COUNT(*) AS total FROM students WHERE status='Active'");
$row = mysqli_fetch_assoc($result);
$activeStudents = $row['total'];

// --------------------
// Student Query
// --------------------

$sql = "SELECT * FROM students WHERE 1";

if($search!="")
{
    $sql .= " AND (
        name LIKE '%$search%' OR
        email LIKE '%$search%' OR
        branch LIKE '%$search%'
    )";
}

if($branch!="")
{
    $sql .= " AND branch='$branch'";
}

$sql .= " ORDER BY id DESC";

$students = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Student Management System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="css/style.css">
<style>

body{

background:#f5f7fb;

}

.card{

border:none;

border-radius:15px;

box-shadow:0 0 15px rgba(0,0,0,.12);

}

.table img{

width:60px;
height:60px;
object-fit:cover;
border-radius:50%;

}

.badge{

font-size:14px;

}

</style>

</head>

<body>

<div class="container mt-4">

<h2 class="text-center mb-4">

🎓 Student Management System

</h2>

<?php

if($success!="")
{

?>

<div class="alert alert-success alert-dismissible fade show">

<?php echo $success; ?>

<button class="btn-close" data-bs-dismiss="alert"></button>

</div>

<?php

}

?>

<!-- Dashboard -->

<div class="row mb-4">

<div class="col-md-4">

<div class="card bg-primary text-white">

<div class="card-body">

<h5>Total Students</h5>

<h2><?php echo $totalStudent; ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-success text-white">

<div class="card-body">

<h5>Average CGPA</h5>

<h2><?php echo $avgCGPA; ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-warning text-dark">

<div class="card-body">

<h5>Active Students</h5>

<h2><?php echo $activeStudents; ?></h2>

</div>

</div>

</div>

</div>

<!-- Search -->

<div class="card mb-4">

<div class="card-body">

<form method="GET">

<div class="row">

<div class="col-md-5">

<input
type="text"
name="search"
class="form-control"
placeholder="Search Name, Email, Branch"
value="<?php echo $search; ?>">

</div>

<div class="col-md-4">

<select
name="branch"
class="form-select">

<option value="">All Branches</option>

<option <?php if($branch=="Computer Science") echo "selected"; ?>>

Computer Science

</option>

<option <?php if($branch=="Mechanical") echo "selected"; ?>>

Mechanical

</option>

<option <?php if($branch=="Civil") echo "selected"; ?>>

Civil

</option>

<option <?php if($branch=="Electrical") echo "selected"; ?>>

Electrical

</option>

<option <?php if($branch=="Electronics") echo "selected"; ?>>

Electronics

</option>

</select>

</div>

<div class="col-md-3 d-grid">

<button class="btn btn-primary">

<i class="bi bi-search"></i>

Search

</button>

</div>

</div>

</form>

</div>

</div>

<div class="mb-3">

<a href="add_student.php" class="btn btn-success">

<i class="bi bi-plus-circle"></i>

Add Student

</a>

</div>

<div class="card">

<div class="card-body">

<div class="table-responsive">

<table class="table table-striped table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Photo</th>

<th>Name</th>

<th>Email</th>

<th>Branch</th>

<th>CGPA</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>
    <?php

if(mysqli_num_rows($students) > 0)
{
    while($student = mysqli_fetch_assoc($students))
    {

?>

<tr>

<td><?php echo $student['id']; ?></td>

<td>

<?php

if($student['photo'] != "" && file_exists("uploads/".$student['photo']))
{

?>

<img src="uploads/<?php echo $student['photo']; ?>">

<?php

}
else
{

?>

<img src="https://via.placeholder.com/60">

<?php

}

?>

</td>

<td>

<?php echo htmlspecialchars($student['name']); ?>

</td>

<td>

<?php echo htmlspecialchars($student['email']); ?>

</td>

<td>

<?php echo htmlspecialchars($student['branch']); ?>

</td>

<td>

<?php echo $student['cgpa']; ?>

</td>

<td>

<?php

if($student['status']=="Active")
{

?>

<span class="badge bg-success">

Active

</span>

<?php

}
else
{

?>

<span class="badge bg-danger">

Inactive

</span>

<?php

}

?>

</td>

<td>

<a
href="edit_student.php?id=<?php echo $student['id']; ?>"
class="btn btn-primary btn-sm">

<i class="bi bi-pencil-square"></i>

Edit

</a>

<a
href="delete_student.php?id=<?php echo $student['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirmDelete();">

<i class="bi bi-trash"></i>

Delete

</a>

</td>

</tr>

<?php

    }
}
else
{

?>

<tr>

<td colspan="8" class="text-center text-danger">

<h5>No Students Found</h5>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<script>

function confirmDelete()
{
    return confirm("Are you sure you want to delete this student?");
}

// Auto hide success message

setTimeout(function(){

let alert=document.querySelector('.alert');

if(alert)
{
    alert.style.display='none';
}

},3000);

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>