<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
unset($_SESSION['email']);
unset($_SESSION['pwd']);
unset($_SESSION['dsc']);
unset($_SESSION['sess']);
unset($_SESSION['matric_id']);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->

<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Result Portal | Login Page</title>
	<link rel="icon" type="image/png" href="assets/img/login-bg/nou.png" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
	<!-- <link href="assets/plugins/animate/animate.min.css" rel="stylesheet" /> -->
	<link href="assets/css/transparent/style.min.css" rel="stylesheet" />
	<link href="assets/css/transparent/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/transparent/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />

  <link href="assets/plugins/bootstrap-sweetalert/dist/sweetalert.css" rel="stylesheet" />
	<script src="assets/plugins/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/ColReorder/css/colReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/KeyTable/css/keyTable.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="assets/plugins/pace/pace.min.js"></script>
  <!-- <script src="inc/cdal.js"></script> -->
  <!-- ================== END BASE JS ================== -->
</head>

<style>
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
</style>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<?php
	include 'modal/modal_n_chpwd.php';
	 ?>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
									<!-- <iframe width="100%" height="100%"
									src="http://directorateofinformationandcommunicationtechnologyd11.sg-host.com/wp-content/uploads/2022/01/NOUN-AT-A-GLANCE-3.mp4">
									</iframe> -->
									<!-- <iframe width="100%" height="100%"
									 src="assets/img/login-bg/NOUN-AT-A-GLANCE-3.mp4">
									</iframe> -->
									<video loop="loop" autoplay="" playsinline="" muted="" id="mejs_04978300085092657_html5" preload="none" src="assets/img/login-bg/NOUN-AT-A-GLANCE-3.mp4" style="margin-top: -60px; width: 1440px; height: 810px;">
										<source type="video/mp4" src="assets/img/login-bg/NOUN-AT-A-GLANCE-3.mp4">
									</video>
                    <!-- <img src="assets/img/login-bg/bg-2.jpg" data-id="login-cover-image" alt="" /> -->
                </div>
                <div class="news-caption">
									<h4 class="caption-title"><img src="assets/img/login-bg/nou.png" style="height: 90px;margin-top:-10px" alt="" /> National Open University of Nigeria</h4>
									<h6 class="caption-title" style="font-size:24px;margin-left:115px;margin-top:-32px">  Examination Result Presentation/Reporting Platform </h6>
										<!-- <p style="text-align:justify">
                        Admission requirement into Under-Graduate program is a minimum of 5 O'level credits including English Language and Mathematics while that of Post-Graduate is
												First-Degree in the relevant field and a minimum of 5 O'level credits including English Language and Mathematics.
                    </p> -->
                 </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header ">

                    <div class="brand text-inverse" style="width:650px">
                        <span class="" ></span>NOUN ERP Portal
                        <small class="text-inverse" style="font-size:18px">Examination Result Presentation Platform </small>
										</div>
										<div class="icon pull-right" style="margin-top:80px;margin-left:30px">
												 <a href="#" style="margin-left:30px"><i class="fa fa-sign-in"></i> </a>

										</div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content" style="">
                    <!-- <form  method="POST" class="margin-bottom-0"> -->
                        <div class="form-group m-b-15">
                            <input type="text" name="username" id="t_uname" class="form-control input-lg text-inverse " placeholder="Email Address" required />
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" name="password" id="t_pwd" class="form-control input-lg text-inverse" placeholder="Password" required />
                        </div>
                        <div class="checkbox m-b-30 ">
                            <label class="text-inverse">
                                <input type="checkbox"/> Remember Me
                            </label>
                        </div>
                        <div class="login-buttons">
                            <button  class="btn btn-success btn-block btn-lg" id="bsumit">Sign me in</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                            <b>Forgot password? Click <a href="register.php" class="text-success">here</a> to reset your password.</b>
                        </div>
												<!-- <div class="login-buttons">
														<a class="btn btn-primary btn-block btn-lg" id="b_remita" href="#modal_verify_remita" data-toggle="modal" data-backdrop="static" data-keyboard="false"></i>Make Remita Payment</a>
                        </div>
												<div class="m-t-20 m-b-40 p-b-40 text-inverse">
                            <b>Have you verfied your account? Click <a href="verify.php">here</a> and enter your verfication code to verify your registration before you login.</b>
                        </div> -->
												<!-- <div class="text-center" style="margin-top:130px;margin-left:0px">

                             <img src="assets/img/nlogo.png" style="height: 110px;margin-top:-50px;margin-left:10px" alt="" />
    										</div> -->
                        <!-- <hr style="margin-top:-60px" / >
                        <p class="text-center" style="margin-top:-20px">
                            &copy; Color Admin All Right Reserved 2015
                        </p> -->
                        <hr />
                        <p class="text-center">
                            &copy; Color Admin All Right Reserved 2023
                        </p>
                    <!-- </form> -->
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->


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
	<script src="assets/js/apps.min.js"></script>
   <script src="inc/cdal.js"></script> 
	<!-- ================== END PAGE LEVEL JS ================== -->

  <script>
        var _delay = 3000;
        function checkLoginStatus(){
         $.get("checkStatus.php", function(data){
            if(data) {
                //window.location = "./index.php";
            }
            setTimeout(function(){  checkLoginStatus(); }, _delay);
            });
        }
        checkLoginStatus();
  </script>

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

      $("#bsumit").click(function(){
				// alert('Login being submitted!');
        var id_usr = $("#t_uname").val();
        var id_pwd = $("#t_pwd").val();
        // alert("User name is: "+id_usr+" and password is: "+id_pwd)
        $.post("ajax/ajax_check_login.php",{id_usr1: id_usr,id_pwd1: id_pwd},
        function(data, textStatus){
            // alert(data);
           if(data == 0){
             swal({title:"Oops!",
                  text:"Invalid login parameter. Check username or password!",
                  type:"error",
                  customClass:"swal-size-sm",
                  showCancelButton: false,
                  closeOnConfirm:true,
                },function(){
                  location.reload();
              //window.location.href = './';
              })

				// 		}else if(data == "3"){
        //         window.location.href = 'fac_dashboard';
        //       }else if(data == "5"){
				// 				window.location.href = 'search';
				// 				// window.location.href = 'ctr_dashboard';
				// }else if(data == "7"){
				// 				window.location.href = 'helpdesk';
				// 			}else if(data == "1"){
				// 				window.location.href = 'mgt_dashboard';
        //       }else if(data == "6"){
				// 				window.location.href = 'spg_dash';
				// 			}else {
				// 					window.location.href = 'fac_dashboard';
				// 			}
              }else if(data == "1"){
                window.location.href = 'mgt_dashboard';
             }else if(data == "2"){
								window.location.href = 'fac_dashboard';
						  }else if(data == "3"){
                window.location.href = 'dept_dashboard';
              }else if(data == "4"){
								window.location.href = 'search';
							}else if(data == "5"){
								window.location.href = 'search';
							}else if(data == "6"){
								window.location.href = 'spg_dash';
							}else if(data == "7"){                
                window.location.href = 'mgt_dashboard';
							}else if(data == "9"){							
					        $("#modal_chpwd").modal({
					           keyboard: false,
					           backdrop: 'static'
					         });
					        $("#modal_chpwd").modal({"backdrop": "static"});
					        $("#modal_chpwd").modal({"keyboard": "false"});
					        $("#modal_chpwd").modal("show");
									// $("#btn_usr").hide();
							}else{
							window.location.href = 'search';
							}

         });
      })
		});

	</script>
<script>

$("#t_pwd").keyup(function(event) {
    if (event.keyCode === 13) {
        $("#bsumit").click();
    }
});
  // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  // })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  // ga('create', 'UA-53034621-1', 'auto');
  // ga('send', 'pageview');

</script>
</body>
</html>
