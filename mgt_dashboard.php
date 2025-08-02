<?php
session_start();
include "inc/pdo_connectdb.php";
include "encr_decr.php";
$_SESSION['page']="mgt_dashboard";

$json_data=array();


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
	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->
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
	<!-- <link href="assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" /> -->
	<!-- <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" /> -->
    <!-- <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" /> -->
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
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
    /* background-color:green!important; */
    /* color: white!important; */
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
  .form-control, .control-label{
    font-size: 16px!important;
    font-weight: normal!important;
  }
</style>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-with-sidebar page-header-fixed">
		<!-- begin #header -->
		<?php
    include "inc/mheader.php";
    include "inc/sidebar.php";
    include "content/mgt_dash_content.php";
    include "modal/modal_create_user.php";
    include "inc/float.php";
    ?>
		<!-- end #header -->

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

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


  <script src="assets/plugins/raphael/raphael.min.js"></script>
  <script src="assets/plugins/morris.js/morris.min.js"></script>

  <script src="assets/plugins/echarts/dist/echarts.min.js"></script>
  <script src="assets/plugins/echarts/map/js/world.js"></script>


  <link href="assets/plugins/bootstrap-sweetalert/dist/sweetalert.css" rel="stylesheet" />
  <script src="assets/plugins/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<!-- <script src="assets/plugins/gritter/js/jquery.gritter.js"></script> -->
	<script src="assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/plugins/sparkline/jquery.sparkline.js"></script>
	<!-- <script src="assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script> -->
	<!-- <script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
	<!-- <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> -->
	<!-- <script src="assets/js/dashboard.min.js"></script> -->
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

<script src="inc/cdal.js"></script>

	<script>
		$(document).ready(function() {
			App.init();
			// Dashboard.init();
      checkLoginStatus();
      // $("#tabs").tabs({active:0});
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


      //

  Morris.Donut({
    element: 'morris-donut-chart',
    data:<?php echo json_encode($json_data)?>,
    //data:[{"label":"Asset (Non-Stock Item)","value":"24"},{"label":"Cleaning Items","value":"1"},{"label":"Consumables","value":"24"},{"label":"Electrical Assessory","value":"4"}],
     labelColor: 'black',
     colors: [
       'red',
       'black',
       '#39B580',
       'blue',
       'green',
       'yellow',
       'orange'
     ],
     formatter: function (x) { return x}
    });

} )

</script>
<script>
var theme = {
         color: [
             'red', 'black', '#BDC3C7', 'blue',
             'green', 'pink', 'black','darkgrey', '#9B59B6'
         ],

         title: {
             itemGap: 8,
             textStyle: {
                 fontWeight: 'normal',
                 color: '#408829'
             }
         },

         dataRange: {
             color: ['#1f610a', '#97b58d']
         },

         toolbox: {
             color: ['#408829', '#408829', '#408829', '#408829']
         },

         tooltip: {
             backgroundColor: 'rgba(0,0,0,0.5)',
             axisPointer: {
                 type: 'line',
                 lineStyle: {
                     color: '#408829',
                     type: 'dashed'
                 },
                 crossStyle: {
                     color: '#408829'
                 },
                 shadowStyle: {
                     color: 'rgba(200,200,200,0.3)'
                 }
             }
         },

         dataZoom: {
             dataBackgroundColor: '#eee',
             fillerColor: 'rgba(64,136,41,0.2)',
             handleColor: '#408829'
         },
         grid: {
             borderWidth: 0
         },

         categoryAxis: {
             axisLine: {
                 lineStyle: {
                     color: '#408829'
                 }
             },
             splitLine: {
                 lineStyle: {
                     color: ['#eee']
                 }
             }
         },

         valueAxis: {
             axisLine: {
                 lineStyle: {
                     color: '#408829'
                 }
             },
             splitArea: {
                 show: true,
                 areaStyle: {
                     color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                 }
             },
             splitLine: {
                 lineStyle: {
                     color: ['#eee']
                 }
             }
         },
         timeline: {
             lineStyle: {
                 color: '#408829'
             },
             controlStyle: {
                 normal: {color: '#408829'},
                 emphasis: {color: '#408829'}
             }
         },

         k: {
             itemStyle: {
                 normal: {
                     color: '#68a54a',
                     color0: '#a9cba2',
                     lineStyle: {
                         width: 1,
                         color: '#408829',
                         color0: '#86b379'
                     }
                 }
             }
         },
         map: {
             itemStyle: {
                 normal: {
                     areaStyle: {
                         color: '#ddd'
                     },
                     label: {
                         textStyle: {
                             color: '#c12e34'
                         }
                     }
                 },
                 emphasis: {
                     areaStyle: {
                         color: '#99d2dd'
                     },
                     label: {
                         textStyle: {
                             color: '#c12e34'
                         }
                     }
                 }
             }
         },
         force: {
             itemStyle: {
                 normal: {
                     linkStyle: {
                         strokeColor: '#408829'
                     }
                 }
             }
         },
         chord: {
             padding: 4,
             itemStyle: {
                 normal: {
                     lineStyle: {
                         width: 1,
                         color: 'rgba(128, 128, 128, 0.5)'
                     },
                     chordStyle: {
                         lineStyle: {
                             width: 1,
                             color: 'rgba(128, 128, 128, 0.5)'
                         }
                     }
                 },
                 emphasis: {
                     lineStyle: {
                         width: 1,
                         color: 'rgba(128, 128, 128, 0.5)'
                     },
                     chordStyle: {
                         lineStyle: {
                             width: 1,
                             color: 'rgba(128, 128, 128, 0.5)'
                         }
                     }
                 }
             }
         },
         gauge: {
             startAngle: 225,
             endAngle: -45,
             axisLine: {
                 show: true,
                 lineStyle: {
                     color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                     width: 8
                 }
             },
             axisTick: {
                 splitNumber: 10,
                 length: 12,
                 lineStyle: {
                     color: 'auto'
                 }
             },
             axisLabel: {
                 textStyle: {
                     color: 'auto'
                 }
             },
             splitLine: {
                 length: 18,
                 lineStyle: {
                     color: 'auto'
                 }
             },
             pointer: {
                 length: '90%',
                 color: 'auto'
             },
             title: {
                 textStyle: {
                     color: '#333'
                 }
             },
             detail: {
                 textStyle: {
                     color: 'auto'
                 }
             }
         },
         textStyle: {
             fontFamily: 'Arial, Verdana, sans-serif'
         }
     };
var echartLine = echarts.init(document.getElementById('echart_line'), theme);

    echartLine.setOption({
      title: {
        text: "Class of Degree Percentage (%) Distribution.",
        subtext:''
      },
      tooltip: {
        trigger: 'axis'
      },
      legend: {
        x: 220,
        y: 40,
        data: ['Fail', '3rd Class', '2nd Class Upper', '2nd Class Lower', '1st Class']
      },
      toolbox: {
        show: true,
        feature: {
          magicType: {
            show: true,
            title: {
              line: 'Line',
              bar: 'Bar',
              stack: 'Stack',
              tiled: 'Tiled'
            },
            type: ['bar','line',  'stack', 'tiled']
          },
          restore: {
            show: true,
            title: "Restore"
          },
          saveAsImage: {
            show: true,
            title: "Save Image"
          }
        }
      },
      calculable: true,
      xAxis: [{
        type: 'category',
        axisLabel: {
           interval: 0,
           rotate: 45,
         },
        boundaryGap: true,
        data: <?php echo json_encode($ZoneStr); ?>}],
        // data: ["FE-.AGE","FE-BIO","FE-CHM","FE-INT","FE-ITT","FE-MTH","FE-PHY","FE-ECE","FE-ENG","FE-FRE","FE-PED","FE-BUS","PG-EDU","ME-EDA","ME-SED","ME-EDT","ME-EGC"]        }],
      yAxis: [{
        type: 'value'
      }],
series: [{
  name: 'Fail',
        type: 'bar',
        smooth: true,
        itemStyle: {
          normal: {
            areaStyle: {
              type: 'default'
            }
          }
        },
        data: <?php echo json_encode($fag); ?>
        // data: ["2.65","3.68","5.00","0.98","2.72","6.86","3.61","3.50","3.77","7.75","1.80","2.36","15.05","10.72","20.53","12.55","12.56"]
      }, {
        name: '3rd Class',
        type: 'bar',
        smooth: true,
        itemStyle: {
          normal: {
            areaStyle: {
              type: 'default'
            }
          }
        },
        data: <?php echo json_encode($foa); ?>
        // data: ["27.86","29.07","31.41","18.46","28.20","34.76","32.52","30.02","27.27","43.31","21.14","26.53","65.85","58.42","55.21","59.69","60.47"]
      }, {
        name: '2nd Class Upper',
        type: 'bar',
        smooth: true,
        itemStyle: {
          normal: {
            areaStyle: {
              type: 'default'
            }
          }
        },
        data: <?php echo json_encode($foe); ?>
        // data: ["47.41","47.64","43.66","49.67","46.70","42.65","45.42","46.36","43.87","36.97","47.02","47.05","19.09","30.76","24.26","27.72","26.74"]
      }, {
        name: '2nd Class Lower',
        type: 'bar',
        smooth: true,
        itemStyle: {
          normal: {
            areaStyle: {
              type: 'default'
            }
          }
        },
        data: <?php echo json_encode($foh); ?>
        // data: ["19.60","16.96","17.17","25.16","19.55","13.20","16.39","17.31","21.31","10.56","25.32","21.01","0.00","0.05","0.00","0.05","0.23"]
      }, {
        name: '1st Class',
        type: 'bar',
        smooth: true,
        itemStyle: {
          normal: {
            areaStyle: {
              type: 'default'
            }
          }
        },
        data: <?php echo json_encode($fol); ?>
        // data: ["2.48","2.66","2.76","5.72","2.83","2.54","2.06","2.80","3.79","1.41","4.72","3.05","0.00","0.06","0.00","0.00","0.00"]
      }]
    });
</script>
</body>
</html>
