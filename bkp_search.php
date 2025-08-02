<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>NOUN Result Portal | Examination Result Platform</title>
	<link rel="icon" type="image/png" href="assets/img/login-bg/nou.png" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<div class="login-cover">
	    <!-- <div class="login-cover-image"><img src="assets/img/login-bg/bg-2.jpg" data-id="login-cover-image" alt="" /></div> -->
			<div class="login-cover-image"><img src="assets/img/image1.jpeg" data-id="login-cover-image" alt="" style="width:100%;height:100%"/></div>
	    <div class="login-cover-bg"></div>
	</div>

	<!-- begin #page-container -->
	<div id="page-container" class="fade">

	    <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn" style="margin-top:5%!important">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">

                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
								<!-- <div class="m-t-20 m-b-40 p-b-40 text-white"> -->
									<div class="text-center" style="font-size:14px">
									<h3 class="text-white"> Abuja Model Study Center.</h3>
										<p>Your search is limited to only students of this Center.</p>
									</div>
								<!-- </div> -->
								<hr>
								<!-- <form class=" full-width" action="m_sess.php"> -->
									<div class="form-group">
										<input id = "Returnurl" type="text" class="form-control input-lg text-center" name = "Returnurl" style="font-size:22px;height:52px" placeholder="Enter Matric No" required />
									</div>
									<div class="login-buttons">
											<button id="submit" class="btn btn-success btn-block btn-lg">Search...</button>
									</div>
								<!-- </form> -->

								<div class="text-justify text-white col-md-12 ">
									<p class="text-center" style="font-size:14px">Enquiries relating to student's result are to be registered here.</p>

								</div>
								<br>
								<div class="login-buttons">
										<button  class="btn btn-primary btn-block btn-lg">Report Missing Result</button>
								</div>
								<div class="m-t-20 m-b-40 p-b-40 text-inverse">
									<p class="text-center text-white" style="font-size:14px">All non-result related enquiry should be raised by the student on the support/e-Ticketing Platform for quicker resolution</p>
										<!-- <b>Have you verfied your account? Click <a href="verify.php">here</a> and enter your verfication code to verify your registration before you login.</b> -->
								</div>
								<div class="icon pull-right" style="margin-top:-5px;margin-left:30px">
								       <a href="." style="margin-left:30px"><i class="fa fa-2x fa-sign-out"></i> </a>
								  </div>
            </div>

        </div>
				<?php //include 'inc/float.php'; ?>
        <!-- end login -->

        <ul class="login-bg-list clearfix">
					<!-- <div style="margin-top:130px;margin-left:0px"> -->
					<img src="assets/img/nlogo.png" style="height: 80px;margin-left:-100px" alt="" />
					<h2 class="text-white" style="margin-top:-70px">ERP Platform</h2>
					<small class="text-white" style="font-size:18px">Examination Result Presentation Platform </small>
				<!-- </div> -->
				</ul>
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->

	<link href="assets/plugins/bootstrap-sweetalert/dist/sweetalert.css" rel="stylesheet" />
	<script src="assets/plugins/bootstrap-sweetalert/dist/sweetalert.min.js"></script>

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/js/login-v2.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>

	<script src="inc/cdal.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
			checkLoginStatus();
			var _delay = 3000;
	    function checkLoginStatus(){
	     $.get("checkStatus.php", function(data){
	       // alert('Value is ' + data);
	        if(data==0) {
	            window.location = "./";
	        }
	        setTimeout(function(){checkLoginStatus(); }, _delay);
	      });
	    }
		});
		// $("#submit").click(function(){
		// 	// alert("Submit button clicked");
		// 	// $("#Returnurl").trigger("keyup","13");
		// })
	</script>
<script>
  // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  // })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	//
  // ga('create', 'UA-53034621-1', 'auto');
  // ga('send', 'pageview');

</script>
</body>
</html>
