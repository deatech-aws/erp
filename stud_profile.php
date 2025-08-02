<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<?php
session_start();
include "inc/pdo_connectdb.php";
// $_SESSION['location']="stud_rst.php";
$query ="SELECT vMatricNo,vname AS fname,vcityname AS Centre,
 iYrLevel,s.email,s.vPhoneNo,vProgaward,p.iMincredits,90 AS drcredits,s.ceductgid,s.cprogrammeid
 FROM students s  INNER JOIN
 programme p ON p.cProgrammeID = s.cProgrammeID INNER JOIN
 studycenter c ON c.cStudyCenterId = s.cStudyCenterId
 AND vMatricNo =:matricno";


 // echo $query .$_SESSION['Returnurl'];
//'NOU132787127'";
// $_SESSION['Returnurl']='NOU132787127';
// echo $query." ".$_SESSION['Returnurl'];
// echo "The Matric No is: ".$_SESSION['Returnurl'];
 //$_SESSION['Returnurl']=$_SESSION['Returnurl']);

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
}
$stmt->closeCursor();

global $core_arry;
$query ="SELECT crscode
FROM core_courses
WHERE cprogrammeid='$pid'";
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
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>NOUN Result Portal | Examination Result Presentation</title>
  <link rel="icon" type="image/png" href="assets/img/login-bg/nou.png" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
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

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <!-- <link href="assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" /> -->
	<link href="assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <link href="assets/css/default/sweetalert2.css" rel="stylesheet" />
  <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>

  <script src="assets/plugins/pace/pace.min.js"></script>
  <!-- ================== END BASE JS ================== -->
<!-- ================== FILE UPLOAD CSS ================== -->
  <link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
   <link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
   <link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />



</head>

<style>
/* .theme-panel{
    width:50px!important;
} */

div.dataTables_filter,
div.dataTables_length {
  padding-top: 0.65em;
}
ul.stats-overview li {
    display: inline-block;
    text-align: center;
    padding: 0 15px;
    width: 30%;
    font-size: 14px;
    border-right: 1px solid #e8e8e8;
}
.logins_box{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  /* background-color: lightgrey; */
  color: #000000;

}
.logins_box:focus{
  background-color: white;
  color: #000000;
}
::placeholder {
  color: grey!important;
  opacity: 1
}
.caption-title {
  background-color: white!important;
}
.news-caption{
  background-color: white!important;
}
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

.input-lg{
  font-size:18px !important;
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

.news-feed{
  height: 100% !important
}
</style>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
      <?php
        include "inc/p_header.php";
       ?>
       <br>
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed" style="height:auto!important">
                <?php

                  include "content/wiz_profile.php";
                 ?>
                 <!-- <div class="news-image">
                     <img src="assets/img/login-bg/bg-8.jpg" data-id="login-cover-image" alt="" />
                 </div> -->
                 <div class="news-caption hidden" style="margin-top:200px">
 									<h4 class="caption-title text-black" style="color:black"><img src="assets/img/login-bg/nou.png" style="height: 90px;margin-top:-10px" alt="" /> National Open University of Nigeria</h4>
 									<h6 class="caption-title" style="font-size:24px;margin-left:115px;margin-top:-32px;color:black;">  Examination Result Presentation/Reporting Platform </h6>
                 </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content" style="width:470px;margin-top:60px">

                <div class="col-md-12" style="margin-left:40px;margin-top:30px">
                  <section class="panel">
                    <div class="x_title">
                      <h2>Student's Profile</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="profile_left">
                        <div class="profile_img" style="margin-left:35px">
                          <div id="crop-avatar">
                            <!-- Current avatar -->
                            <img class="media-object rounded-corner" src="assets/img/user.png" alt="Avatar" title="Change the avatar">
                          </div>
                        </div>
                        <h4 style="margin-left:30px"><?php echo $Ptitle;?></h4>

                        <!-- <ul class="list-unstyled user_data" style="font-size:16px">
                          <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $stcentre; ?>
                          </li>

                          <li>
                            <i class="fa fa-graduation-cap user-profile-icon"></i> <?php echo $prog;?>
                          </li>

                          <li class="m-top-xs">
                            <i class="fa fa-envelope user-profile-icon"></i>
                            <a href="http://www.kimlabs.com/profile/" target="_blank"><?php echo $email;?></a>
                          </li>

                          <li class="m-top-xs">
                            <i class="fa fa-phone user-profile-icon"></i><?php echo $phon;?></a>
                          </li>

                        </ul> -->

                        <h2 id ="cgpa" class="lead" style="margin-top:0px;margin-Left:40px"> </h2>
                        <h4 style="margin-left:30px"><?php echo $prog;?></h4>
                        <div style = "width:80%" class="table-responsive">
                        <table class="table" style="font-size:14px">
                          <tbody>
                          <tr>
                          <th >Courses Taken:</th>
                            <td id = "tot_c" class ="pull-right"></td>
                          </tr>
                          <tr>
                            <th>Min. Credit Units Req:</th>
                            <td id = "tot_gc" class ="pull-right"></td>
                          </tr>
                          <tr>
                            <th>Min. Direct Entry Credit Units Req:</th>
                            <td id = "tot_dc" class ="pull-right"></td>
                          </tr>
                          <tr>
                            <th>Total Credit Earned (TCE):</th>
                            <td id = "tot_ce" class ="pull-right"></td>
                          </tr>
                          <tr>
                            <th>Outstanding Credit:</th>
                            <td id = "tot_oc" class ="pull-right"></td>
                          </tr>

                          </tbody>
                        </table>
                        </div>

                        <p class="lead">Grade statisitics</p>
                        <div style = "width:80%" class="table-responsive">
                        <table class="table" style="font-size:16px">
                          <tbody>
                          <tr>
                          <th >A-Grade:</th>
                            <td id = "gd_a" class ="pull-right"></td>
                          </tr>
                          <tr>
                            <th>B- Grade:</th>
                            <td id = "gd_b" class ="pull-right"></td>
                          </tr>
                          <tr>
                            <th>C-Grade:</th>
                            <td id = "gd_c" class ="pull-right"></td>
                          </tr>
                          <tr>
                            <th>D-Grade:</th>
                            <td id = "gd_d" class ="pull-right"></td>
                          </tr>
                          <tr>
                            <th>E-Grade:</th>
                            <td id = "gd_e" class ="pull-right"></td>
                          </tr>
                          <tr>
                            <th>F-Grade:</th>
                            <td id = "gd_f" class ="pull-right">7</td>
                          </tr>
                          </tbody>
                        </table>
                        </div>
                      </div>
                        </div>
                      <br />
                    </div>
                  </section>
                </div>
                <!-- end project-detail sidebar -->
              </div>

            <!-- end right-container -->
        </div>
        <!-- end login -->
        <!-- begin theme-panel -->
       <div class="theme-panel" style="width:200px">
           <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-mortar-board"></i></a>
           <div class="theme-panel-content" style="width:800px">
               <h5 class="m-t-0">Out Standing Courses</h5>
               <!-- <hr> -->
               <!-- <h5 class="m-t-0">O'Level Creteria</h5> -->
                <div class="divider"></div>
               <?php
                $out_crs=array_values(array_diff($core_arry,$p_crs));
                // $out_crs=array_diff($core_arry,$p_crs);
                // print_r($out_crs);
               if (COUNT($out_crs)>0){
                 for($u=0;($u<=COUNT($out_crs)-1);$u++){
                   if (isset($out_crs[$u])){
                     echo "
                       <div class=\"row m-t-10\">
                           <div class=\"col-md-12 control-label double-line\">$out_crs[$u]</div>
                           <div class=\"col-md-7\">
                           </div>
                       </div>";
                   }


                 }
               }
              ?>

           </div>
       </div>
       <!-- Array ( [1] => EDU821 [7] => EDA842 [8] => EDU822 [9] => SED834 [10] => SED800 [11] => EDU820 [12] => EDU808 )
       GST807 -->

       <!-- end theme-panel -->
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

  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  	<script src="assets/plugins/parsley/dist/parsley.js"></script>
  	<!-- <script src="assets/plugins/bootstrap-wizard/js/bwizard.js"></script> -->
  	<!-- <script src="assets/js/form-wizards-validation.demo.min.js"></script> -->
  	<script src="assets/js/apps.min.js"></script>
  	<!-- ================== END PAGE LEVEL JS ================== -->
<!--
    <script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/table-manage-default.demo.min.js"></script> -->

    <script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/table-manage-default.demo.min.js"></script>

    <script src="assets/js/form-plugins.demo.min.js"></script>
    <script src="inc/cdal.js"></script>




<script>
$(document).ready(function(){
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
});
</script>
	<script>
		$(document).ready(function() {
			App.init();

      $("#tb_sheet").DataTable({
        // 'sScrollX': "100%"
        // "dom": '<"top"lif>rt<"bottom"p><"clear">rt<"right"f>'
        "dom": '<"right"l><"top"f>rt<"bottom"pi>'
        // dom: 'Bftip',
    //     paging: false,
    // lengthChange: false,
    // searching: true,
    // info: true,
      });

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

      // checkLoginStatus();

      var _delay = 3000;
      function checkLoginStatus(){
       $.get("checkStatus.php", function(data){
         //alert('Value is ' + data);
          if(!data) {
              // window.location = "./";
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
<!-- <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53034621-1', 'auto');
  ga('send', 'pageview');

</script> -->
</body>
</html>
