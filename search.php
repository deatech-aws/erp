<?php
session_start();
$config = "inc/pdo_class.php";
	include "inc/pdo_connectdb.php";
include 'encr_decr.php';

if(isset($_SESSION['matric_id'])){
  $query ="SELECT vMatricNo,CONCAT(vlastname,' ',vothernames) AS fname,vcityname AS Centre,
   iYrLevel,s.email,s.vPhoneNo,vProgaward,p.iMincredits,90 AS drcredits,p.ceductgid,s.cprogrammeid,entrymode
   FROM students s  INNER JOIN
   programme p ON p.cProgrammeID = s.cProgrammeID INNER JOIN
   studycenter c ON c.cStudyCenterId = s.cStudyCenterId
   AND vMatricNo =:matricno";

  $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $stmt->bindParam(':matricno', $_SESSION['matric_id'], PDO::PARAM_STR,4);
  $stmt->execute();
  if($stmt->rowCount()<=0){
    // header("Location: ../");
  }
  $k=1;
  $id = "";
  $Ptitle= "";
  $stcentre= "";
  $cLevel= "";
  $email="";
  $phon= "";
  $prog= "";
  $dcr=0;
  $mcr=0;
  $ceductgid ="";
  $pid ="";
  $mode="";
  while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
  {
  $id = $rw[0];
  $Ptitle= $rw[1];
  $stcentre= $rw[2];
  $cLevel= $rw[3];
  $email= $rw[4];
  $phon= $rw[5];
  $prog= $rw[6];
  $mcr = $rw[7];
  $dcr =$rw[8];
  $ceductgid =$rw[9];
  $pid =$rw[10];
  $mode=$rw[11];
  }
  $stmt->closeCursor();

  global $core_arry;
  if ($mode=="Open"){
    $query ="SELECT coursecode
    FROM grad_parameter
    WHERE cprogrammeid='$pid'";
  }else{
    $query ="SELECT coursecode
    FROM grad_parameter
    WHERE cprogrammeid='$pid' AND de=1";
  }

  // echo $query;
  $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $stmt->execute();

  while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
  {
    $core_arry[]=$rw[0];
  }
  $stmt->closeCursor();
  $stmt=null;
  $conn=null;
}

 ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Result Portal | Examination Result Presentation</title>
	<link rel="icon" type="image/png" href="assets/img/login-bg/nou.png" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->


  <!-- ================== BEGIN DATATABLE PAGE LEVEL STYLE ================== -->
   <link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
   <link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
   <!-- ================== END DATATABLE PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<style>
.center {
	/* line-height: 200px; */
 height: 50%;
 /* border: 3px solid green; */
 text-align: center;
}
.centered {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}

body {
    background: #ffffff;
    font-size: 12px;
    font-family: 'Open Sans',"Helvetica Neue",Helvetica,Arial,sans-serif;
    color: #707478;
}
</style>
<body>

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
	<?php
   include "content/track_de.php";
   ?>
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

		<!-- end scroll to top btn -->
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

  <script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
  <script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
  <script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/js/table-manage-default.demo.min.js"></script>

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script> -->
	<script src="assets/js/timeline.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();

      $("#tb_sheet").DataTable({
        // "dom": '<"right"l><"top"f>rt<"bottom"pi>'
        'pageLength':25
      });
      //
      $("#tbl_os").DataTable({
        // "dom": '<"right"l><"top"f>rt<"bottom"pi>'
        'pageLength':10
      });
      //tbl_
		});

		$("#btn_track").click(function(){
			var id =$("#search-div").val();
			// $("#his").empty();
			var dataString = 'id='+ id;
			$.ajax({
				type: "POST",
				url: "ajax/ajax_sess.php",
				data: dataString,
				cache: false,
					success: function(data){
            location.reload();
					}
				})
		})
    	// Timeline.init();
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
