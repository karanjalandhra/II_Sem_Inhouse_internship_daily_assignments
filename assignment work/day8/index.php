<?php include("header.php"); ?>

<div class="container mt-5">

<div class="header">

<h2>Student Registration Form</h2>

</div>

<div class="card shadow">

<div class="card-body">

<form action="confirm.php" method="POST">

<div class="mb-3">

<label>Name</label>

<input type="text"
class="form-control"
name="name">

</div>

<div class="mb-3">

<label>Email</label>

<input type="email"
class="form-control"
name="email">

</div>

<div class="mb-3">

<label>CGPA</label>

<input type="number"
step="0.01"
class="form-control"
name="cgpa">

</div>

<div class="mb-3">

<label>Branch</label>

<input type="text"
class="form-control"
name="branch">

</div>

<div class="mb-3">

<label>College</label>

<input type="text"
class="form-control"
name="college">

</div>

<div class="mb-3">

<label>Gender</label><br>

<input type="radio"
name="gender"
value="Male"> Male

<input type="radio"
name="gender"
value="Female"> Female

</div>

<div class="mb-3">

<label>Course</label>

<select class="form-select"
name="course">

<option>B.Tech</option>

<option>BCA</option>

<option>MCA</option>

<option>B.Sc</option>

</select>

</div>

<div class="mb-3">

<label>Address</label>

<textarea
class="form-control"
name="address"></textarea>

</div>

<div class="mb-3">

<label>Student Photo</label>

<input type="file"
class="form-control">

</div>

<button class="btn btn-primary w-100">

Submit

</button>

</form>

</div>

</div>

</div>

<?php include("footer.php"); ?>