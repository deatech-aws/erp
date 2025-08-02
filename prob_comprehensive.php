<?php session_start(); 

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

global $de_core_arry,$core_arry, $cum_arry,$nm_arry,$mat_arry,$tcc_arry,$tce_arry,$tcgpe_arry,$id_arry;
$prog_desc="";
$j=0;

$query ="SELECT coursecode,de
FROM grad_parameter
WHERE cprogrammeid='".$_SESSION['prob_id']."' AND cstatus<>'E'" ;
//  echo $query;
//  exit;

$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->execute();

while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
  $core_arry[]=$rw[0];
  if($rw[1]==1){
    $de_core_arry[]=$rw[0];
  }
}
//var_dump( $core_arry);
//exit;
$stmt->closeCursor();

// $query ="SELECT vprogaward,imax_decredits
// FROM programme
// WHERE cprogrammeid='".$_SESSION['prob_id']."'";

$query ="SELECT vprogaward,idecredit
FROM programme
WHERE cprogrammeid='".$_SESSION['prob_id']."'";

$prog_desc="";
$imincredits=0;
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->execute();
$j=0;
// $ctr_desc ="";
while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
  $prog_desc=$rw[0];
  $imincredits=$rw[1];
}
$stmt->closeCursor();

$json_data=array();


// $query="SELECT c.vMatricno,vname,TCC, TCE, CGPE
//   FROM cum_result_summary c INNER JOIN
//   students s ON s.vMatricNo=c.vMatricNo
//   AND c.vMatricNo IN (SELECT DISTINCT vMatricNo FROM resultsheet) AND s.cprogrammeid='".$_SESSION['prog_id']."' AND s.iYrlevel=".$_SESSION['lev_id'];

$query="SELECT c.vmatricNo,CONCAT(vlastname,' ',vothernames) AS vname,TCC,TCE,CGPE
    FROM cum_result_summary c inner join
    students s on s.vmatricno=c.vmatricno inner join
    programme p ON p.cprogrammeid = s.cprogrammeid
    AND TCE >=idecredit AND grad_approved=0 AND s.cprogrammeid='".$_SESSION['prob_id']."'
    ";
    //  echo $query;
    //  exit;
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
  AND s.cprogrammeid='".$_SESSION['prob_id']."' AND iYrlevel=".$_SESSION['lev_id'];

$query="SELECT CONCAT( r.vmatricno,'|',coursecode,'|',TScore,'|',Grade,'|',creditunit,'|',gpoints) AS rec,r.vmatricno AS id
      FROM resultsheet r inner join
      cum_result_summary c on c.vmatricno=r.vmatricno inner join
      students s on s.vmatricno=r.vmatricno inner join
      programme p ON p.cprogrammeid = s.cprogrammeid
      AND TCE >=imincredits AND grad_approved=0
      AND s.cprogrammeid='".$_SESSION['prob_id']."'";
$query ="SELECT vmatricno AS id
                  FROM tbl_details
                  WHERE  cprogrammeid='".$_SESSION['prob_id']."'";

  // echo $query;
  // exit;
    $stmt =$conn->prepare($query,$pdo_attr);
    $stmt->execute();
    $mat_str="";
    while ($rw=$stmt->fetch(PDO::FETCH_BOTH,PDO::FETCH_ORI_NEXT)){
      $mat_arry[]=$rw[0];
      if($mat_str==""){
        $mat_str="'".$rw[0]."'";
      }else{
        $mat_str.=",'".$rw[0]."'";
      }
    }
    $stmt->closeCursor();

    $query="SELECT vMatricNo, GROUP_CONCAT(CONCAT(Coursecode,'[',Grade,']') SEPARATOR ',') AS Courses
  			FROM releasedresults
  			WHERE vMatricNo IN ($mat_str)";

if($mat_str!==""){
   $query="SELECT vMatricNo,courses
  			FROM tbl_details
  			WHERE vMatricNo IN ($mat_str)";

    // echo $query;
    // exit;
    $stmt =$conn->prepare($query,$pdo_attr);
    $stmt->execute();

    while ($rw=$stmt->fetch(PDO::FETCH_BOTH,PDO::FETCH_ORI_NEXT))
    {
      $id_arry[]=$rw[0].'|'.$rw[1];
    }
    $stmt->closeCursor();
}
 

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
      $gpe  =3;
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

 ?>
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
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
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

      <link href="assets/plugins/bootstrap-sweetalert/dist/sweetalert.css" rel="stylesheet" />
      <script src="assets/plugins/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

</head>


<style>

.modal-centered{
position: sticky;
}
.modal.left .modal-dialog,
.modal.right .modal-dialog {
position: fixed;
margin: auto;
width: 820px;
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
table {
        /* border-collapse: collapse; */
        /* table-layout: fixed; */
        /* width: 310px; */
      }
      table td {
        /* border: solid 1px #666;
        width: 110px; */
        word-wrap: break-word;
      }
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

  .loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('assets/img/page-loader.gif') 50% 50% no-repeat rgba(255, 255, 255, 0.8);
}

</style>
<div id ="loader" class="loader"></div>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-without-sidebar page-header-fixed">
		<!-- begin #header -->
		<?php
    include "inc/mheader.php";
    include "content/prob_comprehensive_de.php";
    include 'modal/modal_grad_req.php';
    include 'modal/modal_approve_grad.php';
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

	<script>
  $(window).load(function() {
  	$(".loader").fadeOut("slow");
  });
		$(document).ready(function() {
			App.init();
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
      
     $("#tbl_gp").DataTable({
       'pageLength':25
     });
      checkLoginStatus();

      var _delay = 3000;
      function checkLoginStatus(){
       $.get("checkStatus.php", function(data){
         // alert(data);
          if(data==0) {
              window.location = "./";
          }
          setTimeout(function(){checkLoginStatus(); }, _delay);
        })
      }
      $("#h_total").html(<?php echo json_encode($cTotal); ?>);
      $("#h_fail").html(<?php echo json_encode(number_format(($fail/$cTotal)*100,"2")."%"); ?>);
      $("#h_3rd").html(<?php echo json_encode(number_format(($rdC/$cTotal)*100,"2")."%"); ?>);
      $("#h_ndL").html(<?php echo json_encode(number_format(($ndL/$cTotal)*100,"2")."%"); ?>);
      $("#h_ndU").html(<?php echo json_encode(number_format(($ndU/$cTotal)*100,"2")."%"); ?>);
      $("#h_stC").html(<?php echo json_encode(number_format(($stC/$cTotal)*100,"2")."%"); ?>);

      $("#s_fail").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($fail)." Student Result </i></b>"); ?>);
      $("#s_3rd").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($rdC)." Student Result </i></b>"); ?>);
      $("#s_ndL").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($ndL)." Student Result </i></b>"); ?>);
      $("#s_ndU").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($ndU)." Student Result </i></b>"); ?>);

      $("#s_stC").html('<i class="green"><i class="fa fa-graduation-cap"> '+<?php echo json_encode("<b><i>".number_format($stC)." Student Result </i></b>"); ?>);

      $("#tbl_rst").dataTable({
        // dom: "Bfrtip",
          // 'targets': [0],
          // 'ordering': false,

          'sScrollX': "100%"
      });
} )
</script>
<script>

$("#btn_gen").click(function(){
  //alert("Clicked");
  // exit;
  var id = $(this).data('id');
  var min =$(this).data('min');
  if(confirm("Generating Comprhensive Result. This will take some few minutes. \n Are You Sure You Want to continue?"))
  {
    $('#loader').show();
    $.post("ajax/ajax_generateComprehensive.php",{pidRef: id,mcrRef: min},
    function(data, textStatus){
        //alert(data);
        if(data == "1"){           
          alert("Comprehensive result generated successfully.");
          location.reload();
          exit;
        }else{
          alert(data);
        }
      });
  };
})


function generateComprehensive(myval,myval1){
  if(confirm("Generating Comprhensive Result. This will take some few minutes. \n Are You Sure You Want to continue?"))
  {
    $('#loader').show();
    $.post("../ajax/ajax_generateComprehensive.php",{pidRef: myval,mcrRef: myval1},
    function(data, textStatus){
        if(data == "1"){
          alert("Comprehensive result generated successfully.");
          location.reload();
          exit;
        }else{
          alert(data);
        }
      });
  }
}
$(document).on("click",".btn_app",function(){
// $("#btn_app").click(function(){
  // swal("Approve candidate for graduation!");
  var id = $(this).data('id');
  swal({
    title:'APPROVE CANDIDATE!',
    text: 'Approve for graduation. Are you sure you want to continue?',
    type:'warning',
    customClass:'swal-size-sm',
    showCancelButton: true,
    confirmButtonClass: "btn-primary",
    cancelButtonClass: "btn-danger",
    confirmButtonText: "Yes, Approve!",
    cancelButtonText: "No, cancel pls!",
    closeOnConfirm: false,
    closeOnCancel: false,
    titleClass:"text-red"
  },
  function(isConfirm){
    if (isConfirm){
      $.post("ajax/ajax_grad_approve.php",{id1: id},
      function(data, textStatus){
        if(data == 1){
          swal({
            position: 'top-end',
            type: 'success',
            title: 'Candidate successfully approved.',
            showConfirmButton: true,
          });
           location.reload();
         }else if (data == 2){
           swal("Oops!","An error occured. Candidate not approved.","error");
           //alert("An error occured. Request for quotation not cancelled!");
         }else{
           swal("Error!",data,"error");
         }
       });

    }else{
      //
      swal({
        title:'Cancelled!',
        text:'Action cancelled by you.',
        // type:'info',
        showConfirmButton: false,
        timer: 1500
      });
    }
  })

})


$(document).on("click",".btn_remove",function(){
// $("#btn_app").click(function(){
  // swal("Approve candidate for graduation!");
  var id = $(this).data('id');
  swal({
    title:'REMOVE CANDIDATE!',
    text: 'Remove candidate from graduation list. Are you sure you want to continue?',
    type:'warning',
    customClass:'swal-size-sm',
    showCancelButton: true,
    confirmButtonClass: "btn-primary",
    cancelButtonClass: "btn-danger",
    confirmButtonText: "Yes, Remove!",
    cancelButtonText: "No, cancel pls!",
    closeOnConfirm: false,
    closeOnCancel: false,
    titleClass:"text-red"
  },
  function(isConfirm){
    if (isConfirm){
      $.post("ajax/ajax_grad_remove.php",{id1: id},
      function(data, textStatus){
        if(data == 1){
          swal({
            position: 'top-end',
            type: 'success',
            title: 'Candidate successfully removed.',
            showConfirmButton: true,
          });
           location.reload();
         }else if (data == 2){
           swal("Oops!","An error occured. Candidate not removed.","error");
           //alert("An error occured. Request for quotation not cancelled!");
         }else{
           swal("Error!",data,"error");
         }
       });

    }else{
      //
      swal({
        title:'Cancelled!',
        text:'Action cancelled by you.',
        // type:'info',
        showConfirmButton: false,
        timer: 1500
      });
    }
  })

})



</script>

</body>
</html>
