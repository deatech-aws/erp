<?php
session_start();
include "inc/pdo_connectdb.php";
include "encr_decr.php";
$ddate = date("Y-m-d");
// if($_POST['id']){
  // $_SESSION['Returnurl']=enc($_REQUEST['id']);
// }

$query ="SELECT vMatricNo,CONCAT(vlastname,' ',vothernames) AS fname,vcityname AS Centre,
 iYrLevel,s.email,s.vPhoneNo,vProgaward,p.iMincredits,90 AS drcredits,p.ceductgid,s.cprogrammeid,entrymode
 FROM students s  INNER JOIN
 programme p ON p.cProgrammeID = s.cProgrammeID INNER JOIN
 studycenter c ON c.cStudyCenterId = s.cStudyCenterId
 AND vMatricNo =:matricno";

$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->bindParam(':matricno', $_SESSION['Returnurl'], PDO::PARAM_STR,4);
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

// global $core_arry;
// if ($mode=="Open"){
//   $query ="SELECT coursecode
//   FROM core_courses
//   WHERE cprogrammeid='$pid'";
// }else{
//   $query ="SELECT coursecode
//   FROM core_courses
//   WHERE cprogrammeid='$pid' AND de=1";
// }

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
 ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
  <title>NOUN Result Portal | Examination Result Presentation</title>
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
  <link href="assets/css/invoice-print.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
  <link href="assets/plugins/bootstrap-sweetalert/dist/sweetalert.css" rel="stylesheet" />
  <script src="assets/plugins/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
	<!-- ================== BEGIN BASE JS ================== -->

  <!-- ================== BEGIN DATATABLE PAGE LEVEL STYLE ================== -->
		<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
		<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END DATATABLE PAGE LEVEL STYLE ================== -->



  <script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<style>
  .view_result {
      cursor: pointer;

      }
      .viewresult {
       display: none;
      }

      .view_result:hover .viewresult {
        display: inline-block;
      }

      .viewresult{
         display: none;
      }
       .view_result:hover .viewresult {
        display: inline-block;
      }
      .progress{
       height: 5px;
     }
     .modal-centered{
     position: sticky;
     }
     .modal.left .modal-dialog,
     .modal.right .modal-dialog {
     position: fixed;
     margin: auto;
     width: 540px;
     height: 100%;
     -webkit-transform: translate3d(0%, 0, 0);
     		-ms-transform: translate3d(0%, 0, 0);
     		 -o-transform: translate3d(0%, 0, 0);
     				transform: translate3d(0%, 0, 0);
     }

     .modal.left .modal-content,
     .modal.right .modal-content {
     height: 100%;
     overflow-y: auto;
     }
     .modal.left .modal-body,
     .modal.right .modal-body {
     padding: 15px 15px 80px;
     }

     /*Left*/
     .modal.left.fade .modal-dialog{
     left: 0px;
     -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
     	 -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
     		 -o-transition: opacity 0.3s linear, left 0.3s ease-out;
     				transition: opacity 0.3s linear, left 0.3s ease-out;
     }

     .modal.left.fade.in .modal-dialog{
     left: 0;
     }

     /*Right*/
     .modal.right.fade .modal-dialog {
     right: -0px;
     -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
     	 -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
     		 -o-transition: opacity 0.3s linear, right 0.3s ease-out;
     				transition: opacity 0.3s linear, right 0.3s ease-out;
     }

     .modal.right.fade.in .modal-dialog {
     right: 0;
     }

     .swal-size-sm
     {
        width: 650px !important;
     }

     .swal-size-lg
     {
        width: 950px !important;
     }

     .swal-wide{
         width:550px !important;
     }
     /* Create a custom checkbox */
     /* Customize the label (the container) */
     .container {
       display: block;
       position: relative;
       padding-left: 0px;
       margin-bottom: 30px;
       cursor: pointer;
       width:0px!important;
       font-size: 22px;
       -webkit-user-select: none;
       -moz-user-select: none;
       -ms-user-select: none;
       user-select: none;
     }

     /* Hide the browser's default checkbox */
     .container input {
       position: absolute;
       opacity: 0;
       cursor: pointer;
       height: 0;
       width: 0;
     }

     /* Create a custom checkbox */
     .checkmark {
       position: absolute;
       top: 0;
       left: 0;
       height: 25px;
       width: 25px;
       background-color: #cee;
     }

     /* On mouse-over, add a grey background color */
     .container:hover input ~ .checkmark {
       background-color: #ccc;
     }

     /* When the checkbox is checked, add a blue background */
     .container input:checked ~ .checkmark {
       background-color: #2196F3;
     }

     /* Create the checkmark/indicator (hidden when not checked) */
     .checkmark:after {
       content: "";
       position: absolute;
       display: none;
     }

     /* Show the checkmark when checked */
     .container input:checked ~ .checkmark:after {
       display: block;
     }

     /* Style the checkmark/indicator */
     .container .checkmark:after {
       left: 9px;
       top: 5px;
       width: 5px;
       height: 10px;
       border: solid white;
       border-width: 0 3px 3px 0;
       -webkit-transform: rotate(45deg);
       -ms-transform: rotate(45deg);
       transform: rotate(45deg);
     }
     /* @media(min-width: 0px);
      .container {
          width:0px!important;
      } */
 </style>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-without-sidebar page-header-fixed">
		<!-- begin #header -->
		<!-- <div id="header" class="header navbar navbar-default navbar-fixed-top"> -->
			<!-- begin container-fluid -->
      <?php
      include "inc/sheader.php";
      include "content/hd_sor_detail.php";
      // include 'inc/float_up.php';
      ?>
  		<!-- end #header -->

		<!-- begin #content -->
<!--
    <p>
        <a href="javascript:history.back(-1);" class="btn btn-success hidden-print">
            <i class="fa fa-arrow-circle-left"></i> Back to previous page
        </a>
    </p> -->

		<!-- end #content -->
    <!-- begin #footer -->

        <!-- begin theme-panel -->

        <!-- end theme-panel -->

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade hidden-print" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
    <a href="javascript:history.back(-1);" class="btn btn-success"><i class="fa fa-arrow-circle-left"></i> Back to previous page</a>
	</div>
	<!-- end page container -->
  <div id="footer" class="footer hidden-print pull-right">
      &copy; 2021 National Open University of Nigeria
      <small>-All Rights Reserved</small>
  </div>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<!-- <script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script> -->
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

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/js/table-manage-default.demo.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="assets/js/apps.min.js"></script>

  <!-- <script src="inc/cdal.js"></script> -->
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
      // TableManageCombine.init();
      // $("#tbl_bin").dataTable();

        // $('#tbl_bin').DataTable( {
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'print'
        //     ]
        // } );

        $('#tbl_bin').DataTable( {
          "sDom": '<"H"if><"clear">t<"F"p>' ,
          "paging": false,
          "info": false
        } );
      })
      $( "#btn_print" ).click(function() {
      // alert("!...");
        var table =$("#tbl_bin").DataTable();
        table.search();
        // table.dom: 'lrt';
        if (table.search()!==''){
          swal("Please clear your search before printing");
          return false;
        }
        $("#tbl_bin").DataTable({
          dom: 'lrt'
        })
        window.print();
      });


      $("#tbl_os").DataTable({
      pageLength: 25,
      "sDom": '<"H"if><"clear">t<"F"p>' ,
      "info": false
      })

      $("#cgpa").append(<?php echo json_encode("CGPA:". $cgpa." (".$gclass.")");?>);
      $("#scgpa").html(<?php echo json_encode($cgpa." (".$gclass.")");?>);
      $("#tot_c").html(<?php echo json_encode($tc);?>);
      $("#stcc").html(<?php echo json_encode($ttcc);?>);
      $("#tot_ce").html(<?php echo json_encode($ttce);?>);
      $("#stce").html(<?php echo json_encode($ttce);?>);
      $("#tot_gc").html(<?php echo json_encode($mcr);?>);
      $("#tot_oc").html(<?php echo json_encode($mcr-$ttce);?>);
      //

      $("#gd_a").html(<?php echo json_encode($gradeA);?>);
      $("#gd_b").html(<?php echo json_encode($gradeB);?>);
      $("#gd_c").html(<?php echo json_encode($gradeC);?>);
      $("#gd_d").html(<?php echo json_encode($gradeD);?>);
      $("#gd_e").html(<?php echo json_encode($gradeE);?>);
      $("#gd_f").html(<?php echo json_encode($gradeF);?>);

      function alignModal(){
  				var modalDialog = $(this).find(".modal-dialog");

  				// Applying the top margin on modal dialog to align it vertically center
  				modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
  		}
  		// Align modal when it is displayed
  		$(".modal").on("shown.bs.modal", alignModal);

  		// Align modal when user resize the window
  		$(window).on("resize", function(){
  				$(".modal:visible").each(alignModal);
  		});



    // $(document).ready(function() {
    //
    // } );



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
