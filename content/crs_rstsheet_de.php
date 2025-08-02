<!-- begin #content -->
<?php

$squery ="SELECT coursecode,F+E+D+C+B+A+I AS total,F,E,D,C,B,A,I
  FROM tbl_course_performance
  WHERE coursecode ='".$_SESSION['crs_id']."'";
 // echo $squery;
$stmt = $conn->prepare($squery, $pdo_attr);
// $stmt->bindParam(':courseid', $_SESSION['crs_id'], PDO::PARAM_STR,6);
$stmt->execute();

$stotal=0;
$fgrade=0;
$egrade=0;
$dgrade=0;
$cgrade=0;
$bgrade=0;
$agrade=0;
$igrade=0;
while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
  // $stotal = 0;
  for ($i = 2;($i<=8);$i++){
    if(!is_null($rw[$i])){
      $stotal +=$rw[$i];
    }
  }
  // $total=$rw[1];

  $fgrade=$rw[2];
  $egrade=$rw[3];
  $dgrade=$rw[4];
  $cgrade=$rw[5];
  $bgrade=$rw[6];
  $agrade=$rw[7];
  $igrade=$rw[8];
}
$stmt->closeCursor();

 ?>
<div id="content" class="content" style="margin-top:30px">
  <!-- begin breadcrumb -->
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h2 class="page-header"><?php echo $crs_desc; ?> Grade Distribution <?php echo "(Total: ".number_format($stotal,"0").")" ?><small>Academic Performance Distribution...</small></h2>
  <!-- end page-header -->
  <div class="row tile_count">

    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-warning"></i><b> F-Failure Grade</b></span>
      <div class="count" style="color:red"><?php echo number_format(($fgrade/$stotal)*100,"2")."%"; ?></div>
      <span class="count_bottom"><i class="red"><i class="fa fa-graduation-cap"></i> <?php echo number_format($fgrade); ?> </i>  Collated Score</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-warning"></i><b> E Grade</b></span>
      <div class="count" style="color:red"><?php echo number_format(($egrade/$stotal)*100,"2")."%"; ?></div>
      <span class="count_bottom"><i class="red"><i class="fa fa-graduation-cap"></i> <?php echo number_format($egrade); ?> </i>  Collated Score</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i><b> D-Grade</b></span>
      <div class="count yellow"><?php echo number_format(($dgrade/$stotal)*100,"2")."%"; ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i> <b><?php echo number_format($dgrade,"0"); ?></b></i> Collated Score</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i><b> C-Grade</b></span>
      <div class="count"><?php echo number_format(($cgrade/$stotal)*100,"2")."%"; ?></div>
      <span class="count_bottom"><i class="fa fa-graduation-cap"></i> <b> <?php echo number_format($cgrade,"0")?></b> Collated Score</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i><b> B-Grade</b></span>
      <div class="count " style="color:blue"><?php echo number_format(($bgrade/$stotal)*100,"2")."%"; ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i> <b><?php echo number_format($bgrade,"0"); ?></b></i> Collated Score</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i><b> A-Grade</b></span>
      <div class="count green"><?php echo number_format(($agrade/$stotal)*100,"2")."%"; ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i> <b> <?php echo number_format($agrade,"0")?></b></i> Collated Score</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i><b> I-Incomplete Results</b></span>
      <div class="count green"><?php echo number_format(($igrade/$stotal)*100,"2")."%"; ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i> <b> <?php echo number_format($igrade,"0")?></b></i> Collated Score</span>
    </div>
  </div>
<hr style="border-top: dotted 3px;margin-top:-20px" />

  <div class="row">
      <div class="panel panel-inverse" data-sortable-id="index-6">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove" disabled ><i class="fa fa-times"></i></a> -->
          </div>
          <h1 class="panel-title" style="font-size:14px">Score Sheet of <?php echo $crs_desc .' for '. $_SESSION['sess']; ?> Academic Session  </h1>
        </div>
        <div class="panel-body">
          <div class="table-responsive" >
          
          <table id="tbl_rst" class="table table-bordered table-striped " style="width:100%" >
            <thead>
              <tr style="font-size:12px">
                <th>#</th>
                <th>Matric No</th>
                <th>TMA-1</th>
                <th>TMA-2</th>
                <th>TMA-3</th>
                <th>TMA-4</th>
                <th>CUM-TMA</th>
                <th>Exam</th>
                <th>Total</th>
                <th>M-Score</th>
                <th>Grade</th>
                <th>GPoint</th>
                <th>GPE</th>
              </tr>
            </thead>
            <tbody>
        <?php
           $j=0;
           $k=0;
           $rtotal=0;
           $rec=array();

           $query = "SELECT vMatricNo,TMAI,TMAII,TMAIII,TMAIV,BestTMA,exam,Rscore,Tscore,grade,points,gpoints
                 FROM resultsheet
                 WHERE Coursecode ='".$_SESSION['crs_id']."'";

                 // $query = "SELECT s.vMatricNo,TMAI,TMAII,TMAIII,TMAIV,BestTMA,exam,Rscore,Tscore,grade,points,gpoints
                 //       FROM resultsheet r INNER JOIN
                 //       students s ON s.vMatricNo=r.vMatricNo AND  Coursecode ='".$_SESSION['crs_id']."'";
                 $stmt = $conn->prepare($query, $pdo_attr);
                 // $stmt->bindParam(':courseid', $_SESSION['crs_id'], PDO::PARAM_STR,6);
                 $stmt->execute();
           // $subset = $cum_arry[$i];
           // $results = array_filter($array, function ($item) use ($subset) {
           //     return $item === $subset;
           // });
           // set_time_limit(0);
           // echo $query;
           while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
           {
             $k++;
             //<a href=\"rst_sess.php?Returnurl=".enc($cum_arry[$i])."\" target =\"_blank\"><b> ".$nm_arry[$i]."</b></a>
          echo "<tr style=\"font-size:16px\">
               <td>".$k."</td>

               <td><a href=\"rst_sess.php?Returnurl=".enc($rw[0])."\" target =\"_blank\"><b>".strtoupper($rw[0])."</b></a></td>
               <td class=\"text-center\">".$rw[1]."</td>
               <td class=\"text-center\">".$rw[2]."</td>
               <td class=\"text-center\">".$rw[3]."</td>
               <td class=\"text-center\">".$rw[4]."</td>
               <td class=\"text-center\">".$rw[5]."</td>
               <td class=\"text-center\">".$rw[6]."</td>
               <td class=\"text-center\">".$rw[7]."</td>
               <td class=\"text-center\">".$rw[8]."</td>
               <td class=\"text-center\">".$rw[9]."</td>
               <td class=\"text-center\">".$rw[10]."</td>
               <td class=\"text-center\">".$rw[11]."</td>
               </tr>
               ";
           }
         ?>
            </tbody>

          </table>
        </div>
        </div>
        </div>
      </div>
      <!--  -->
    </div>
    <!-- end col-4 -->
  </div>
  <hr>
  <br>
  <!-- end row -->

<!-- end #content -->
