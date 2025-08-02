<?php
session_start();
include "inc/pdo_connectdb.php";
$ddate = date('d/m/Y');
// $_SESSION['location']="stud_rst.php";
$query ="SELECT vmatricno,concat(vlastname,' ',vothernames) AS vname,vfacultydesc,vprogaward,dateofbirth,cgender
FROM students s INNER JOIN
faculty f ON f.cfacultyid=s.cfacultyid inner join
programme p ON p.cprogrammeid=s.cprogrammeid
AND vmatricno ='".$_SESSION['Returnurl']."'";

$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
// $stmt->bindParam(':matricno', $_SESSION['Returnurl'], PDO::PARAM_STR,4);
$stmt->execute();
if($stmt->rowCount()<=0){
  // header("Location: ../");
}
$k=1;
$id = "";
$Ptitle= "";
$gender= "";
$dob= "";
$email="";
$phon= "";
$prog= "";
$prog="";
$mcr=0;
$ceductgid ="";
$pid ="";
$mode="";
while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
$id = $rw[0];
$Ptitle= $rw[1];
$faculty = $rw[2];
$prog= $rw[3];
$dob=date("d/m/Y", strtotime($rw[4]));//;
//date("d-m-Y", strtotime($originalDate));
$gender=$rw[5];

}
$stmt->closeCursor();
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
	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />

  <!-- <link href="assets/css/toptile.css" rel="stylesheet" /> -->

  <!-- ================== BEGIN DATATABLE PAGE LEVEL STYLE ================== -->
   <link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
   <link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
   <!-- ================== END DATATABLE PAGE LEVEL STYLE ================== -->

	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <!-- <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" /> -->
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

</head>


<style>
.chart-number{
  color:black!important;
}

.theme-panel {
    position: fixed;
    right: -175px;
    top: 150px;
    z-index: 1020;
    /* background: #008f00; */
    padding: 15px;
    box-shadow: 0 0 2px rgb(0 0 0 / 40%);
    -webkit-box-shadow: 0 0 2px rgb(0 0 0 / 40%);
    -moz-box-shadow: 0 0 2px rgba(0,0,0,.4);
    width: 175px;
    -webkit-transition: right .2s linear;
    -moz-transition: right .2s linear;
    transition: right .2s linear;
}
.theme-panel .theme-panel-content {
    margin: -15px;
    padding: 15px;
    /* background: #008f00; */
    position: relative;
    z-index: 1020;
    min-width: 500px;
}
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
  .modal-centered{
    /* left:45%! important;
    transform: translateX(-45%) !important; */
  /* margin-left: 33%; */
  /* align-self: center; */
  position: sticky;
  }
  /* .active{
    background: white!important;
    color:black!important
  }
  ul li a{
    background: transparent!important;
  } */
  .panel-heading, .nav-tabs{
    background: green!important
  }
  ul li a{
    /* background: transparent!important; */
    color:black!important;
  }
  .anchor{
    background-color:green!important;
    color: white!important;
  }
  .anchor:active{
    background-color:green!important;
    color: white!important;
  }
  .anchor:active{
    background-color: white!important;
    color:black!important;
  }
  .anchor:hover{
    background-color: white!important;
    color: black!important;
  }
  .anchor:focus{
  background-color: white!important;
  color:black!important;
  }

  .nav.nav-tabs.nav-tabs-inverse>li.active>a, .nav.nav-tabs.nav-tabs-inverse>li.active>a:focus, .nav.nav-tabs.nav-tabs-inverse>li.active>a:hover {
    background: #fff;
    color: #242a30;
}

ul.stats-overview li {
    display: inline-block;
    text-align: center;
    padding: 0 15px;
    width: 30%;
    font-size: 14px;
    border-right: 1px solid #e8e8e8;
}
  /* .anchor.active{
  background-color: white!important;
  color:black!important;
  } */

body {
  background-image: url('assets/img/nlogo.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  /* z-index: -1; */
}
#tb_sheet {
  z-index: -1;
}
/* .table, th, td {
  border: 0px;
} */

#tbl_content {
    display: table;
}

#pageFooter {
    display: table-footer-group;
    size:8.5in 11in; 
    margin: 2cm;
}

/* #pageFooter:after {
    counter-increment: page;
    content: counter(page);
} */

#pageFooter:after {
    counter-increment: page;
    content:"Page " counter(page);
    left: 0; 
    top: 100%;
    white-space: nowrap; 
    z-index: 20;
    -moz-border-radius: 5px; 
    -moz-box-shadow: 0px 0px 4px #222;  
    background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);  
  }

  @page {
  @bottom-left {
    content: counter(page) ' of ' counter(pages);
  }

   /* @page { size:8.5in 11in; margin: 2cm } */
}
</style>

<body class="boxed-layout body">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-without-sidebar page-header-fixed" style="margin-top:-40px">
		<!-- begin #header -->
		<?php
    // include "inc/header.php";
    include "../content/transcript_de.php";
    ?>
		<!-- end #header -->
		<!-- begin scroll to top btn -->
    <div id="tbl_content">
  <div id="pageFooter"> </div>  
</div>
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade hidden-print" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
    <a href="javascript:history.back(-1);" class="btn btn-success hidden-print"><i class="fa fa-arrow-circle-left"></i> Back to previous page</a>
    <div class="pull-right"><a type="button" id="apporved_btn" data-id="<?php echo $_SESSION['ticket_id'];?>" data-track ="<?php echo $_SESSION['track'];?>" class="btn btn-success"><i class="fa fa-check"></i> Approved Transcript</a></div>
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


  <script src="assets/plugins/raphael/raphael.min.js"></script>
  <script src="assets/plugins/morris.js/morris.min.js"></script>

  <script src="assets/plugins/echarts/dist/echarts.min.js"></script>
  <script src="assets/plugins/echarts/map/js/world.js"></script>


  <script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
  <script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
  <script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/js/table-manage-default.demo.min.js"></script>

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<!-- <script src="assets/plugins/gritter/js/jquery.gritter.js"></script> -->
	<script src="assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/plugins/sparkline/jquery.sparkline.js"></script>
	<!-- <script src="assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script> -->
	<!--<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
	
	<script src="assets/js/dashboard.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
<script src="inc/cdal.js"></script>
<script>
  $(document).ready(function() {
    App.init();
    $("#cgpa").append(<?php echo json_encode($cgpa);?>);
    $("#scgpa").html(<?php echo json_encode($cgpa." (".$gclass.")");?>);
    $("#tot_c").html(<?php echo json_encode($tc);?>);
    $("#stcc").html(<?php echo json_encode($ttcc);?>);
    $("#tot_ce").html(<?php echo json_encode($ttce);?>);
    $("#stce").html(<?php echo json_encode($ttce);?>);
    $("#tot_gp").html(<?php echo json_encode($tgp);?>);
    $("#tot_oc").html(<?php echo json_encode($mcr-$ttce);?>);
    //

    $("#gd_a").html(<?php echo json_encode($gradeA);?>);
    $("#gd_b").html(<?php echo json_encode($gradeB);?>);
    $("#gd_c").html(<?php echo json_encode($gradeC);?>);
    $("#gd_d").html(<?php echo json_encode($gradeD);?>);
    $("#gd_e").html(<?php echo json_encode($gradeE);?>);
    $("#gd_f").html(<?php echo json_encode($gradeF);?>);

    // checkLoginStatus();

    var _delay = 3000;
    function checkLoginStatus(){
     $.get("checkStatus.php", function(data){
       //alert('Value is ' + data);
        if(data==0) {
            window.location = "./";
        }
        setTimeout(function(){checkLoginStatus(); }, _delay);
      });
    }


    updateList = function() {
      var input = document.getElementById('files');
      var output = document.getElementById('fileList');

      output.innerHTML = '<h4 class="text-black"> <b>Selected Documents for Upload:</b></h4>';
      output.innerHTML += '</ul> <div class="timeline-header"></div>';
      output.innerHTML += '<ul>';
      for (var i = 0; i < input.files.length; ++i) {
        output.innerHTML += '<li class="text-black">' + input.files.item(i).name + '</li>';
      }
      output.innerHTML += '</ul> <div class="timeline-header"></div>';
      output.innerHTML += '<p class ="text-black"> <b>Note:</b> Any exisiting file will be overwritten.</p>';
      output.innerHTML += '<hr>';
    }
  });

  function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#mypssp').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    $('#myfile').change(function(evt) {
     readURL(this);
 });



</script>
</body>
</html>
