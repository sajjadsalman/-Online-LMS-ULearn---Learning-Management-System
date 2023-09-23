<?php 
    include 'config.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php'); 
    }
    $unitid = $_GET['unitid'];
    $headings = "SELECT * FROM components WHERE parent_unit_id='$unitid'";
    $results = mysqli_query($con, $headings);
?>

<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lecture</title>
        <link rel="stylesheet" type="text/css" href="../shared/main.css">
        <script src="https://kit.fontawesome.com/621b21f1c3.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    </head>
    <body class="bg-danger">
        <nav class="navbar fixed-top">
            <a href="main.php"><i class="icon ms-3 fa-solid fa-hippo fa-2xl" style="color: #ff8800;"></i></a>
            <p class="m-0 text-warning">Welcome to ULearn <?php
                if(isset($_SESSION['username']) && $_SESSION['username']) {
                    echo $_SESSION['username'];
                }
            ?>!</p>
            <div>
                <a class="me-3 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="registerCourse.php">Register</a>
                <a class="me-3 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="logout.php">Logout</a>
            </div>       
         </nav>

	<div class="container" style="margin-top: 5rem;">
		<div>
			<?php 
			include 'parser.php';
            echo '<h2 class="teal-text">Unit ' . $unitid . '</h2>';
            
            while ($heading = mysqli_fetch_assoc($results)) {
                echo '<hr>';
                echo '<h4>' . $heading['chapname'] . '</h4>';
                
                $data = $heading['data'];
                $processContent = parseContent($data);
                
                if ($processContent) {
                    $subchap = array_values($processContent);
                    $subchapIndex = 0;
                    $subchapCount = count($subchap);
                    
                    while ($subchapIndex < $subchapCount) {
                        $sub = $subchap[$subchapIndex];
                        
                        echo '<h5>' . $sub['heading'] . '</h5>';
                        echo '<div><ul>';
                        
                        $dataItems = array_values($sub['content']);
                        $dataItemIndex = 0;
                        $dataItemCount = count($dataItems);
                        
                        while ($dataItemIndex < $dataItemCount) {
                            $dataItem = $dataItems[$dataItemIndex];
                            echo '<li>' . $dataItem . '</li>';
                            $dataItemIndex++;
                        }
                        
                        echo '</ul></div>';
                        $subchapIndex++;
                    }
                }
            }
            
            
			echo '<div class="center row">
				<form action="quiz.php?unitid=' . $unitid . '" method="post" class="dropdown-form">
				<input type="hidden" name="unitid" value="' . $unitid . '"></input>
				<button class="btn btn-warning" type="submit">Take the quiz</button></form></div>';

			?>
		</div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>
