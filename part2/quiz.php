<?php 
    include 'config.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php'); 
    }

    $unitid = $_GET['unitid'];
    if ($unitid) {
        $_SESSION['selectedunit'] = $unitid;
        $sql = "SELECT * FROM components WHERE parent_unit_id='$unitid";
        $topics = mysqli_query($con, $sql);
    }
    
    else {
        header('Location: login.php');
        die();
    }


?>

<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
    <link rel="stylesheet" type="text/css" href="../shared/main.css">
    <script src="https://kit.fontawesome.com/621b21f1c3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
<body class="cyan">
	<div class="container">
		<div class="card-panel">
			<h3 class="teal-text text-lighten-3"><?php echo 'Unit '.$unitid.' Quiz';?></h3>
			<hr>
			<div id="quiz" class="row">
				<form id="quizform">
				</form>
			</div>
			<div id="results" class="row"></div>
			<input id="hiddenid" type="hidden" value="<?php echo $unitid; ?>">
		</div>
	</div>
    <script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/sprinkle.js"></script>
	<script type="text/javascript" src="quiz.js"></script>
	<script>startQuiz();</script>

</body>
</html>
