<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ADMIN TAB PAGE SKELETON</title>
	<link rel="icon" href="images/spe_Fav.ico" /> <!-- The icon in the browser tab -->
	<link type = "text/css" rel = "stylesheet" href = "../css/photo.css" />
	<script type="text/javascript" src="scripts/admin.js"></script>
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="scripts/jquery.js"></script>
	<script src="scripts/jquery-ui.js"></script>
	<script>
		// init datepicker
		$(function() {
			$(".datepicker").datepicker({ showAnim: "clip" , dateFormat: "yy-mm-dd"});
		});

		// init tabs
		$(function() {
			$("#tabs").tabs();
		});
	</script>
	<style type="text/css">
		#tabs div {
			background-color: #888 !important;
		}

		#tabs {
			width: 95% !important;
			margin-left: auto;
			margin-right: auto;
		}

		.pagination {
			text-align: center;
		}

		.model_table td, .model_table th {
			text-align: left;
		}

		html,body {
			background-color: #333 !important;
			margin: 0;
			padding: 0;
		}

		.header {
			background-color: #000 !important;
		}

		#tabs {
			font-size: 14px;
		}

		a:link {
			color: #fc0 !important;
			font-weight: normal;
			border: 0;
		}

		a:visited, a:active {
			color: #fc0 !important;
			font-weight: normal;
			border: 0;
		}

		#tabs li {
			background-color: #888;
		}

		#tabs .ui-tabs-active a {
			color: #E6B300 !important;
		}

		.ui-widget-header {
			background:#000000;
			border: 1px solid #000000;
			color: #000000;
			font-weight: bold;
		}
	</style>
</head>
<body>
<div class="header">
	<a href="./">
		<img src="../img/logo.gif" title="Return to home page" width="92">
	</a>
</div>
