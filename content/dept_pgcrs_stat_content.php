<!-- begin #content -->
<?php
$query ="SELECT t.coursecode,coursetitle,F as fail,E+D+C+B+A AS pass
         FROM tbl_course_performance t inner join
         availablecourse a ON a.coursecode =t.coursecode AND cfacultyid ='S' AND ilevel<=500
         AND F+D+C+B+A>0";

 $query ="SELECT t.coursecode,coursetitle,creditunit,ilevel,f as fail,E+D+C+B+A AS pass
          FROM tbl_course_performance t inner join
          availablecourse a ON a.coursecode =t.coursecode 
           AND cdepartmentid ='".$_SESSION['dept_id']. "' AND ilevel>500 AND F+E+D+C+B+A>0";


  // echo $query;
    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stmt->execute();
// echo $query;
$f_count =0;
$p_count=0;
$ttal=0;
while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
  $f_count+=$rw[4];
  $p_count+=$rw[5];
}
$ttal=$f_count+$p_count;


 ?>
<div id="content" class="content" style="margin-top:30px">
  <!-- begin breadcrumb -->
  <!-- <div class="icon pull-right" style="margin-top:5px;margin-left:30px">
       <a href="index.php" style="margin-left:30px"><i class="fa fa-2x fa-sign-out"></i> </a>
  </div> -->
  <!-- <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active">Dashboard</li>
  </ol> -->
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header"><?php echo $_SESSION['sess'];?> Department of <?php echo $fac_desc; ?> Result Analytics Dashboard <small>Academic Performance Distribution...</small></h1>
  <!-- end page-header -->
  <div class="row tile_count responsive">
      <div class="col-md-2 col-sm- col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-users"></i> Total Score Collated</span>
        <div class="count text-info"><?php echo number_format($ttal,"0"); ?></div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-warning"></i> Failure</span>
        <div class="count text-danger"><?php echo number_format($f_count,"0"); ?></div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> Passed</b></span>
        <div class="count text-warning"><?php echo number_format($p_count,"0"); ?></div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> % of Failure</b></span>
        <div class="count"><?php echo number_format(($f_count/$ttal)*100,"2"); ?>%</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> % Passed</span>
        <div class="count text-primary"><?php echo number_format(($p_count/$ttal)*100,"2"); ?>%</div>
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
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
        <h1 class="panel-title" style="font-size:14px"><?php echo $_SESSION['sess'];?> Faculty Under-Graduate Course Statistics</h1>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table id="data-table" class="table table-striped table-valign-middle m-b-0" >
            <thead>
              <tr style="font-size:18px">
                <th>Code</th>
                <th>Course Title</th>
                <th>Unit</th>
                <th>Level</th>
                <th>Failed</th>
                <th>Passed</th>
                <th>% Failed</th>
                <th>% Passed</th>
                <th>Total </th>
              </tr>
            </thead>
            <tbody>
      <?php

   $query ="SELECT t.coursecode,coursetitle,creditunit,ilevel,f as fail,E+D+C+B+A AS pass
            FROM tbl_course_performance t inner join
            availablecourse a ON a.coursecode =t.coursecode 
             AND cdepartmentid ='".$_SESSION['dept_id']. "' AND ilevel>500";

               $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
               $stmt->execute();
               $j=0;
               $rtotal=0;

                 while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                 {
                   $j++;
                   $rtotal=$rw[4]+$rw[5];

                 echo "<tr style=\"font-size:16px\">
                       <td style=\"font-size:16px\">".$rw[0]."</td>
                       <td style=\"font-size:16px\"><a href=\"r_sess.php?Returnurl=".enc($rw[0])."\" target =\"_blank\"> ".trim($rw[1])."</td>
                       <td style=\"font-size:16px\">".$rw[2]."</td>
                       <td style=\"font-size:16px\">".$rw[3]."</td>
                       <td style=\"font-size:16px\">".$rw[4]."</td>
                       <td style=\"font-size:16px\">".$rw[5]."</td>
                       <td style=\"font-size:18px\">".number_format(($rw[4]/$rtotal)*100,"2")."%</td>
                       <td style=\"font-size:18px\">".number_format(($rw[5]/$rtotal)*100,"2")."%</td>
                       <td style=\"font-size:18px\">".number_format(($rtotal),"0")."</td>
                   </tr>";
                   $rtotal=0;
                 }
             ?>
            </tbody>

          </table>
        </div>
        <hr>
      </div>
    <!-- </div> -->
  </div>
  </div>
  <!-- end row -->
</div>
<!-- end #content -->
