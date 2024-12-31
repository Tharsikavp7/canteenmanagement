<?php
if (!isset($_SESSION)) {
	session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>UOV CANTEEN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<style>
        .text-center.mb-4 {
            margin: 24px 0;
        }
    </style>
</head>

<body>
	<!-- banner-start -->
	<?php
	include("config.php");
	include("home_banner.php");
	?>
	<!-- banner-end -->
	<!--body start-->
	<?php
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
		if (file_exists($page)) {
			// Include the specified page
			include($page);
		} else {
			// Include default page if $page is not available
			include("body.php");
		}
	} else {
		include("body.php");
	}
	?>
	<!-- body end -->

	<!-- footer start here -->
	<footer class="container-fluid text-center bg-light" style="margin: 24px 0;">
		<!-- Copyright note -->
		<p>&copy; 2024 University of Vavuniya. All Rights Reserved.</p>
	</footer>
	<!-- //footer end here -->
</body>

</html>