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
// echo $id;
// exit;

$singleIdResult = $smallQueriesObj->singleId($id);
if($singleIdResult){
    $data = $singleIdResult;
}
// $query = "SELECT * FROM myclass WHERE id='$id' ";
// $res = mysqli_query($connection, $query);
// $data = mysqli_fetch_assoc($res);
// print_r($data);
// exit;

$allMembers = $smallQueriesObj->rollOrder();
if ($allMembers) {
    $allMembersarray = $allMembers;
}

$allMembersresult = $smallQueriesObj->rollOrder(5);
if ($allMembersresult) {
    $allMembersres = $allMembersresult;
}

// $allMembers = "SELECT * FROM myclass ORDER BY roll";
// $allMembersres = mysqli_query($connection, $allMembers);
// $allMembersarray = mysqli_fetch_assoc($allMembersres);

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

		<?php
// $chkUser = getdataofloginuser($id);
$userStatus = $data['status'];

if (1 == $userStatus || 2 == $userStatus) {?>
			<div class="container-fluid panel-view" style=" background: red; padding: 40px 0px;margin: 25px 0px 0px 0px;">
				<h2 style="text-align: center;color: white;font-weight: bold;">Admin Panel</h2>
				<h5 style="text-align: center;color: white;font-weight: bold;">Welcome to our website <span style="background: #fff;color: #000;padding: 0px 6px;"><?php echo $data['name']; ?></span> </h5>
			</div>
		<?php } else {?>
			<div class="container-fluid panel-view" style="padding: 40px 0px;margin: 25px 0px 0px 0px;">
				<h2 style="text-align: center;color: white;font-weight: bold;">Welcome to our website <?php echo $data['name']; ?></span> </h2>
			</div>
		<?php }?>


	<section id="cover">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<?php

if (1 == $userStatus || 2 == $userStatus) {?>
							<h2 style="margin-top: 30px; padding: 15px;text-align: center; background: red;font-weight: bold;color: white;font-size: 36px;">Admin Interface</h2>
					<?php } else {?>
						<h2 style="margin-top: 30px; padding: 15px;text-align: center; background: white;font-weight: bold;color: black;font-size: 36px;">User Interface</h2>
					<?php }?>


				<h1 class="head text-center">Thanks for visiting us!</h1>

					<p class="lead text-center">How are you? If you are interested to see your profile then please the click the button below.</p>
					<button class="btn-default py-3 px-5" data-toggle="modal" data-target="#myModal"><b>Your Profile</b></button>

		<!--------------------Modal Start--------------------->
		<!--------------------Modal Start--------------------->
		<!--------------------Modal Start--------------------->

		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title" style="float: left;">Your Information</h4>
		      </div>
		      <div class="modal-body">

				<table class="table table-bordered table-striped  ">
				    <tr>
				    	<th><b>Name :- </b></th>
				    	<td><?php echo $data['name']; ?></td>
				    </tr>
				    <tr>
				    	<th><b>Email :- </b></th>
				    	<td><?php echo $data['email']; ?></td>
				    </tr>
				    <tr>
				    	<th><b>Roll :- </b></th>
				    	<td><?php echo $data['roll']; ?></td>
				    </tr>
				    <tr>
				    	<th><b>Cgpa :- </b></th>
				    	<td><?php echo $data['cgpa']; ?></td>
				    </tr>
				    <tr>
				    	<th><b>Gender :- </b></th>
				    	<td><?php echo $data['gender']; ?></td>
				    </tr>

				  </table>

		      </div>
		      <div class="modal-footer">
		        <a href="edit.php?editId=<?php echo $data['id'] ?>" class="btn btn-info">Edit</a>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>
		<!--------------------Modal Close--------------------->
		<!--------------------ModalClose--------------------->
			</div>
			<div class="col-md-6">

			</div>
			</div>
		</div>
	</section>


	<div class="container">
		<div class="row">
			<h2 style="margin: 0 auto; color: grey;font-weight: bold; padding: 70px 0px 30px 0px;">Our Student Details</h2>
		</div>
	</div>

	<div class="container-fluid" style="padding-bottom: 60px;">
		<div class="row">
			<div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">

			</div>
			<div class="col-md-8 col-lg-8  col-sm-8 col-xs-8">
				<div class="table-responsive">

				<?php if (mysqli_num_rows($allMembersres) > 0) {?>
                    <p>Type something in the input field to search the table for names</p>
  				<input style="border: 3px solid grey;" class="form-control" id="myInput" type="text" placeholder="Search.." >

  				<br>
				  <table class="table table-bordered table-striped table-hover ">
				    <thead>
				      <tr style="background: grey;color: white">
				        <th scope="col">Roll</th>
				        <th scope="col">Name</th>
				        <th scope="col">Cgpa</th>
				        <th scope="col">Gender</th>
				        <th scope="col">Status</th>

				     <?php
if ($data['status'] == 1 || $data['status'] == 2) {?>
                             <th scope="col">Action</th>
                            <?php
}
    ?>


				      </tr>
				    </thead>
				    <tbody id="myTable">


                    <?php
while ($singleMember = mysqli_fetch_assoc($allMembersres)) {
    if($singleMember['id'] != $data['id']) {
        ?>


				      <tr>
				        <td><?php echo $singleMember['roll']; ?></td>
				        <td><?php echo $singleMember['name']; ?></td>
				        <td><?php echo $singleMember['cgpa']; ?></td>
				        <td><?php echo $singleMember['gender']; ?></td>

				        <?php
if ($singleMember['status'] == 1 || $singleMember['status'] == 2) {?>
                           <td style="background-color: #ff2929;">Admin</td>
                          <?php
} else {
            ?>
                        <td style="background-color: #47cd39;">Member</td>
                        <?php }?>


       <?php if ($data['status'] == 1) {?>
				        			<td>

				        			<a href="edit.php?editId=<?php echo $singleMember['id']; ?>" class="btn btn-info">Edit</a>

					<!--------------Delete member Start ------------->
				        			<a href="#" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger delete" data-taskid="<?php echo $singleMember['id']; ?>">Delete</a>
				       <!--------------Delete member End ------------->


				       <!--------------Make as admin/member button Start ------------->
				        			<?php if ($singleMember['status'] == 2) {?>
				        				<a href="#" onclick="return confirm('Are you sure to make him as Member?')" class="btn btn-success member" data-taskid="<?php echo $singleMember['id']; ?>">Make as member</a>
				        				<?php }  elseif ($singleMember['status'] == 3) {?>
				        					<a href="#" onclick="return confirm('Are you sure to make him as Admin?')" class="btn btn-success admin" data-taskid="<?php echo $singleMember['id']; ?>">Make as admin</a>
				        			<?php }?>
				       <!--------------Make as admin/member button End ------------->

				        		<?php }?>
				        		<?php
     if ($data['status'] == 2) {?>
				        			<td>
				        			<a href="edit.php?editId=<?php echo $singleMember['id']; ?>" class="btn btn-info">Edit</a>
				        		    </td>
				        <?php }?>
				      </tr>
					<?php } }?>
				    </tbody>
				  </table>
                  <?php }?>

				</div>
			</div>
			<div class="col-md-2 col-lg-2  col-sm-2 col-xs-2">

			</div>
		</div>
	</div>

<section id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h3 class="head">Contact</h3>
                <p><i class="fas fa-check"></i>Mirabazar, Sylhet</p>
					<p><i class="fas fa-check"></i>+88017798.....</p>
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

	<form  method="POST" id="makeAdminForm" action="tasks.php">
	    <input type="hidden" name="action" value="adminRequest">
	    <input type="hidden" id="adminReqId" name="taskid">
	</form>

	<form  method="POST" id="makeMemberForm" action="tasks.php">
	    <input type="hidden" name="action" value="memberRequest">
	    <input type="hidden" id="memberReqId" name="taskid">
	</form>

	<form  method="POST" id="deleteForm" action="tasks.php">
	    <input type="hidden" name="action" value="deleteRequest">
	    <input type="hidden" id="deleteId" name="taskid">
	</form>

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

        function closeNav(){
        document.getElementById("mySidenav").style.width="0";
       }
        $(".admin").click(function(){
            var id = $(this).data("taskid");
            $("#adminReqId").val(id);
            $("#makeAdminForm").submit();
        })


		$(".member").click(function(){
           let id = $(this).data("taskid");
           $("#memberReqId").val(id);
           $("#makeMemberForm").submit();
        })

	    $(".delete").click(function(){
            var id = $(this).data("taskid");
            $("#deleteId").val(id);
            $("#deleteForm").submit();
        })

		$(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
           });
         });


	</script>
  </body>
</html>