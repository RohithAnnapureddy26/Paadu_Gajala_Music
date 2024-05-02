<?php  
include("includes/includedFiles.php");
?>
<html>
<head>
	<style>
		html, body {
		    height: 100%;
		    margin: 0;
		    padding: 0;
		    overflow-y: hidden; /* Hide vertical scrollbar */
		    box-sizing: border-box; /* Include padding and border in the element's total width and height */
		}

		.entityInfo {
		    display: flex;
		    flex-direction: column;
		    justify-content: center;
		    align-items: center;
		    text-align: center; /* Center the text if needed */
		    box-sizing: border-box; /* Include padding and border in the element's total width and height */
		    /* Make sure the total size of content here doesn't exceed the viewport height */
		}

		body {
		    background: url('assets/images/artwork/bg1.jpg') no-repeat center center fixed; 
		    background-size: cover; /* Cover the entire page */
		    overflow-x: hidden; /* Prevent horizontal scrollbar */

		}
	</style>
</head>

<body>
	<div class="entityInfo">

	<div class="centerSection">
		<div class="userInfo">
			<h1><?php echo $userLoggedIn->getFirstAndLastName(); ?></h1>
		</div>
	</div>

	<div class="buttonItems">
		<button class="button" onclick="openPage('updateDetails.php')">USER DETAILS</button>
		<button class="button" onclick="logout()">LOGOUT</button>
	</div>


</div>
</body>

</html>