<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hanif
 * Date: 4/8/2015
 * Time: 10:28 AM
 */
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign In</title>
	<!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/custom.css" rel="stylesheet">
     <!-- Custom Fonts -->
    <link href="assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
	    <div class="row vertical-offset-100">
	    	<div class="col-md-4 col-md-offset-4">
	    		<!-- <img src = "assets/img/Ashesi_Logo_Black_1.png" alt = "Ashesi Logo" align = "center"></img> -->
	    		<div class="panel panel-default">
				  	<div class="panel-heading">
				    	<h3 class="panel-title" align="center">BusFi Admin</h3>
				 	</div>
				  	<div class="panel-body">
				    	<form action="action/action_page.php?login" method="POST">
	                    <fieldset>
				    	  	<div class="form-group">
				    		    <input class="form-control" placeholder="Username" name="username" type="text">
				    		</div>
				    		<div class="form-group">
				    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
				    		</div>

				    		<input class="btn btn-lg btn-success btn-block" type="submit" name = "submit" value="Login">


				    	</fieldset>
				      	</form>
				    </div>
				</div>
			</div>
		</div>
	</div>



<script type="text/javascript">
	$(document).ready(function(){
  $(document).mousemove(function(e){
     TweenLite.to($('body'),
        .5,
        { css:
            {
                backgroundPosition: ""+ parseInt(event.pageX/8) + "px "+parseInt(event.pageY/'12')+"px, "+parseInt(event.pageX/'15')+"px "+parseInt(event.pageY/'15')+"px, "+parseInt(event.pageX/'30')+"px "+parseInt(event.pageY/'30')+"px"
            }
        });
  });
});
</script>


</body>
</html>

