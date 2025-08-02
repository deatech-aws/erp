<?php
session_start();
include "inc/pdo_connectdb.php";
include "encr_decr.php";
global $gpe;
$gpe=0;

$fail=0;
$rdC =0;
$ndU=0;
$ndL=0;
$stC=0;
$cTotal=0;

$failPerc=0;
$rdCPerc =0;
$ndUPerc=0;
$ndLPerc=0;
$stCPerc=0;

$query ="SELECT vprogaward
FROM programme
WHERE cprogrammeid='".$_SESSION['prog_id']."'";
$prog_desc="";
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->execute();
$j=0;

while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
  $prog_desc=$rw[0];
}
$stmt->closeCursor();

$json_data=array();

global $cum_arry,$nm_arry,$mat_arry,$tcc_arry,$tce_arry,$tcgpe_arry;

$query="SELECT c.vMatricno,concat(vlastname, ' ', vothernames) AS vname,TCC, TCE, CGPE
  FROM cum_result_summary c INNER JOIN
  students s ON s.vMatricNo=c.vMatricNo
  AND c.vMatricNo IN (SELECT DISTINCT vMatricNo FROM resultsheet) AND s.cprogrammeid='".$_SESSION['prog_id']."' AND s.iYrlevel=".$_SESSION['lev_id']." LIMIT 100";

  $query="SELECT c.vMatricno,concat(vlastname, ' ', vothernames) AS vname,TCC, TCE, CGPE
    FROM cum_result_summary c INNER JOIN
    students s ON s.vMatricNo=c.vMatricNo
    AND s.cprogrammeid='".$_SESSION['prog_id']."' AND c.iYrlevel=".$_SESSION['lev_id'];

  //  echo $query;
  //  exit;
// $query="SELECT vMatricno,TCC, TCE, CGPE
//   FROM cum_result_summary s
//   WHERE vMatricNo IN (SELECT DISTINCT vMatricNo FROM resultsheet) AND s.cprogrammeid='".$_SESSION['prog_id']."' AND iYrlevel=".$_SESSION['lev_id'];

  $stmt =$conn->prepare($query,$pdo_attr);
  $stmt->execute();

  while ($rw=$stmt->fetch(PDO::FETCH_BOTH,PDO::FETCH_ORI_NEXT)){
    $cum_arry[]=$rw[0];
    $nm_arry[]=$rw[1];
    $tcc_arry[]=$rw[2];
    $tce_arry[]=$rw[3];
    $tcgpe_arry[]=$rw[4];
  }
  $stmt->closeCursor();

//,coursecode,Grade,creditunit,gpoints
$query="SELECT CONCAT( r.vmatricno,'|',coursecode,'|',TScore,'|',Grade,'|',creditunit,'|',gpoints) AS rec
  FROM resultsheet r inner join
  cum_result_summary s on s.vmatricno=r.vmatricno
  AND s.cprogrammeid='".$_SESSION['prog_id']."' AND iYrlevel=".$_SESSION['lev_id'];

//  echo $query;
//  exit;

    $stmt =$conn->prepare($query,$pdo_attr);
    $stmt->execute();

    while ($rw=$stmt->fetch(PDO::FETCH_BOTH,PDO::FETCH_ORI_NEXT)){
      $mat_arry[]=$rw[0];//.'|'.$rw[1].'|'.$rw[2].'|'.$rw[3].'|'.$rw[4];
    }
    $stmt->closeCursor();

    function stristrarray($array, $str){
        //This array will hold the indexes of every
        //element that contains our substring.
        $indexes = array();
        foreach($array as $k => $v){
            //If stristr, add the index to our
            //$indexes array.
            if(stristr($v, $str)){
                $indexes[] = $k;
            }
        }
        return $indexes;
    }

    // $result = stristrarray($mat_arry, $cum_arry[13]);
    // var_dump($result);

function generate_grade($val){
  if ($val==""){
    $gpe=0;
    return "";
  }else{
    switch ($val) {
      case $val>0 AND $val<40:
      $gpe=0;
      return  "(F)0";
      case $val>=40 AND $val<45:
      $gpe=1;
      return  "(E)1";
      case $val>=45 AND $val<50:
      $gpe=2;
      return "(D)2";
      case $val>=50 AND $val<60:
      $gpe =3;
      return "(C)3";
      case $val>=60 AND $val<70:
      $gpe=4;
      return "(B)4";
      case $val>=70 :
      $gpe=5;
      return "(A)5";
    }
  }

}
// $query ="SELECT vcityname
// FROM studycenter
// WHERE cstudycenterid='".$_SESSION['ctr_id']."'";
// $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
// $stmt->execute();
// $j=0;
// $ctr_desc ="";
// while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
// {
//   $ctr_desc=$rw[0];
// }
// $stmt->closeCursor();
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
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />

  <link href="assets/css/toptile.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <!-- <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" /> -->

    <!-- ================== BEGIN DATATABLE PAGE LEVEL STYLE ================== -->
      <link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
      <link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
      <!-- ================== END DATATABLE PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

</head>

<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
<style>

.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    background: #e9edf1!important;
    border-color: #242a30!important;
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
  /* .anchor.active{
  background-color: white!important;
  color:black!important;
  } */
</style>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-without-sidebar page-header-fixed">
		<!-- begin #header -->
		<?php
    include "inc/sheader.php";
    include "content/prog_rstsheet_de.php";
    ?>
		<!-- end #header -->

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


  <script src="assets/plugins/raphael/raphael.min.js"></script>
  <script src="assets/plugins/morris.js/morris.min.js"></script>

  <script src="assets/plugins/echarts/dist/echarts.min.js"></script>
  <script src="assets/plugins/echarts/map/js/world.js"></script>

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<!-- <script src="assets/plugins/gritter/js/jquery.gritter.js"></script> -->
	<script src="assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/dashboard.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->


<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/table-manage-default.demo.min.js"></script>
<!-- <script src="assets/js/doubleScroll.js"></script> -->

	<script>
		$(document).ready(function() {
			App.init();
      // $('.double-scroll').doubleScroll();
      $("#h_total").html(<?php echo json_encode($cTotal); ?>);
      $("#h_fail").html(<?php echo json_encode(number_format($failPerc,"2")."%"); ?>);
      $("#h_3rd").html(<?php echo json_encode(number_format($rdCPerc,"2")."%"); ?>);
      $("#h_ndL").html(<?php echo json_encode(number_format($ndLPerc,"2")."%"); ?>);
      $("#h_ndU").html(<?php echo json_encode(number_format($ndUPerc,"2")."%"); ?>);
      $("#h_stC").html(<?php echo json_encode(number_format($stCPerc,"2")."%"); ?>);

      $("#s_fail").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($fail)." Student Result </i></b>"); ?>);
      $("#s_3rd").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($rdC)." Student Result </i></b>"); ?>);
      $("#s_ndL").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($ndL)." Student Result </i></b>"); ?>);
      $("#s_ndU").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($ndU)." Student Result </i></b>"); ?>);

      $("#s_stC").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($stC)." Student Result </i></b>"); ?>);
      // $("#s_stC").attr("class","count_bottom");
      //$fail
      //$fail
      checkLoginStatus();

      var _delay = 3000;
      function checkLoginStatus(){
       $.get("checkStatus.php", function(data){
         // alert(data);
          if(data=="0") {
              window.location = "./";
          }
          setTimeout(function(){checkLoginStatus(); }, _delay);
        });
      }
			// Dashboard.init();
      // TableManageCombine.init();
      $("#tbl_rst").DataTable({

          // 'targets': [0],
          // 'ordering': false,

          'sScrollX': "100%"

      });
    // $(document).ready(function() {
    // $('#tbl_zone').DataTable( {
    //     "scrollX": true
    // } );
  Morris.Donut({
    element: 'morris-donut-chart',
    data:<?php echo json_encode($json_data)?>,
    //data:[{"label":"Asset (Non-Stock Item)","value":"24"},{"label":"Cleaning Items","value":"1"},{"label":"Consumables","value":"24"},{"label":"Electrical Assessory","value":"4"}],
     labelColor: 'black',
     colors: [
       'blue',
       '#39B580',
       'red',
       'green',
       'yellow',
       'orange'
     ],
     formatter: function (x) { return x}
    });

} )
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
