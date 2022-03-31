<?php

session_start();
$_SESSION['id'] = $_SESSION['id'] ?? '';
$id = $_SESSION['id'];


if ($id == '') {
    header('location:index.php');
    return;
}


include_once 'config.php';
include_once 'functions.php';

$obj = new Database();
$smallQueriesObj = new smallQueries();

$connection = $obj->xxx();
if (!$connection) {
    throw new Exception("Not Connected<br>");
}

$editId = $_GET['editId'] ?? '';

$res = $smallQueriesObj->singleId($editId,5);
$data = $smallQueriesObj->singleId($editId);

?>


<!doctype html>



<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/design.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <title>Student Management | Home</title>
  </head>
  <body>
    <div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

	  <a href="home.php">Home</a>
	  <a href="about.php">About</a>
	  <a href="records.php">Records</a>
	  <a href="logout.php">Logout</a>
	</div>

	<br>
	<span style="padding-left: 45%;font-size:30px;cursor:pointer;font-weight: bold;" onclick="openNav()">&#9776; Menu</span>


	<div class="container-fluid" style="margin:45px 0px;">
	<div class="row" >
		<div class="col-md-3 col-lg-4 col-sm-2 col-xs-2">

		</div>
		<div class="col-md-6 col-lg-4  col-sm-8 col-xs-8">

			<div class="card">
			  <!-- <div class="card-header">

			  </div> -->
			  <div class="card-body">
			  	<p style="font-weight: bold;text-align: center; font-size: 22px;color: grey;">
                  <?php

$status = $_GET['status'] ?? '';
if ($status) {
    echo $status;
}

?>
				</p>
				<?php if(mysqli_num_rows($res) > 0 || isset($id)) { ?>
				<form action="tasks.php?editId=<?php echo $editId ?>" method="post">
					<h2 style="color: grey;font-weight: bold;">Edit Student</h2>
					<hr style="background: grey">


				  <div class="input-group mb-3">
				    <div class="input-group-prepend">
				    </div>
				    <input type="text" class="form-control" value="<?php echo $data['name'] ?>" placeholder="Enter your name (lettersOnly)" name="name" onkeyup="lettersOnly(this)">
				  </div>

				  <div class="input-group mb-3">
				    <div class="input-group-prepend">
				    </div>
				    <input type="email" value="<?php echo $data['email'] ?>" class="form-control" placeholder="Enter email"  name="email">
				  </div>


				  <div class="input-group mb-3" >
					    <div class="input-group-prepend">
					    </div>
					    <input type="number" value="<?php echo $data['roll'] ?>" class="form-control" placeholder="Enter your roll/id" name="roll" >
				  </div>

				  <div class="input-group mb-3">
					    <div class="input-group-prepend">
					    </div>
					    <input type="number" value="<?php echo $data['cgpa'] ?>" step=0.01 class="form-control" placeholder="Enter your cgpa"  name="cgpa">
				  </div>

			     <input type="submit" style="margin-top: 6px;"  name="submit"  value="Update" class="btn btn-primary btn-block">
			     <input type="hidden" name="action" value="editByAdmin">
			     <input type="hidden" name="user-id" value="<?php echo $data['id'] ?>">
				</form>
			<?php } ?>

			  </div>

			</div>
		</div>
		<div class="col-md-3 col-lg-4  col-sm-2 col-xs-2">

		</div>
	</div>
</div>

<section id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h3 class="head">Contact</h3>
					<p><i class="fas fa-check"></i>Mirzbazar</p>
					<p><i class="fas fa-check"></i>+880174.....</p>
					<p><i class="fas fa-check"></i>tanvirxahm@gmail.com</p>
					<p><i class="fas fa-check"></i>github.com/tanvircancode</p>

					</div>
			<div class="col-md-4">
				<h3 class="head">Recent News</h3>
				<p class="para">
					Footer with solid color background and a contact form, Easily add subscribe and contact forms without any server-side integration.
				</p>
				<p class="para">
					Footer with solid color background and a contact form, Easily add subscribe and contact forms without any server-side integration.
				</p>
			</div>
			<div class="col-md-4">
				<h3 class="head">Subscribe</h3>
				<p class="para">Get monthly updates and free resources.</p>
				<div class="text-center">
					<input type="text" class="form-control py-2 px-4" placeholder="Email">
				<button class="btn btn-default text-center">Subscribe</button>
				</div>


			</div>
		</div>
		<hr>
		<p class="credit text-center">Credit Goes To <strong>Shakib Mohammed</strong> for design</p>
	</div>
</section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
		function openNav() {
		  document.getElementById("mySidenav").style.width = "250px";
		}

		function closeNav() {
		  document.getElementById("mySidenav").style.width = "0";
		}

	</script>
  </body>
</html>