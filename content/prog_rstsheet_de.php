<!-- begin #content -->
<?php
$query="SELECT
    	SUM(fail) AS fail,SUM(third_class) AS third_class,
    	SUM(sec_lower) AS sec_lower,
    	SUM(sec_upper)AS sec_upper,
    	SUM(first_class)AS first_class
    FROM rst_class_of_degree
    GROUP BY cprogrammeid,iYrlevel,batchno
    HAVING cprogrammeid='".$_SESSION['prog_id']."' AND batchno = '".$_SESSION['sess']."' AND iYrlevel=".$_SESSION['lev_id'];
    
//    echo $query;
// exit;
  $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $stmt->execute();

  // while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
  // {
  //   $fail+=$rw[0];
  //   $rdC +=$rw[1];
  //   $ndU=+$rw[2];
  //   $ndL=+$rw[3];
  //   $stC=+$rw[4];
  //   $cTotal+=$rw[0]+$rw[1]+$rw[2]+$rw[3]+$rw[4];
  // }
  // $stmt->closeCursor();
$desc="";
  if ($_SESSION['lev_id']=='800'){
      $desc="";

  }elseif($_SESSION['lev_id']=='700'){
      $desc="";
  }else{
      $desc=$_SESSION['lev_id'].' Level ';
  }

 ?>
<div id="content" class="content" style="margin-top:30px">
  <!-- begin breadcrumb -->
  <div class="icon pull-right" style="margin-top:5px;margin-left:30px">
       <a href="index.php" style="margin-left:30px"><i class="fa fa-2x fa-sign-out"></i> </a>
  </div>
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->

  <h1 class="page-header"><?php echo $_SESSION['sess']. ' '. $desc.' '.$prog_desc; ?> Result Analytics Dashboard <small>Academic Performance Distribution...</small></h1>
  <!-- end page-header -->
  <div class="row tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-users"></i> Total Numbers of Students</span>
        <div id="h_total" class="count text-info"></div>
        <span class="count_bottom"><i class="green"> </i> Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-warning"></i> Students on Probation</span>
        <div id="h_fail" class="count text-danger"></div>
        <span id="s_fail" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i>  </i>  Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> 3rd Class Division</b></span>
        <div id="h_3rd" class="count text-warning"></div>
        <span id="s_3rd" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> </b></i>  Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> 2nd Class Lower Division</b></span>
        <div id="h_ndL" class="count"></div>
        <span id="s_ndL" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndL); ?></b></i>  Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> 2nd Class Upper Division</span>
        <div id="h_ndU" class="count text-primary"></div>
        <span id="s_ndU" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndU); ?></b></i>  Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"> First Class Division</i></span>
        <div id="h_stC" class="count text-success"></div>
        <span id="s_stC" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($stC); ?></b></i>  Student Result</span>
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
          <h1 class="panel-title" style="font-size:14px">Result Sheet of <?php echo $desc."  Courses of ".$prog_desc .' for '.$_SESSION['sess']; ?>  Academic Session  </h1>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
          <table id="tbl_rst" class="table table-bordered table-striped " style="width:100%" >
            <thead>
              <tr style="font-size:12px">
                <!-- <th>#</th> -->
                <th style="min-width:200px!important">Student's Name</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
                <th>15</th>
                <th>16</th>
                <th>17</th>
                <th>TCC</th>
                <th>TCE</th>
                <th>GPA</th>
                <th>CCC</th>
                <th>CCE</th>
                <th>CGPE</th>
                <th>CGPA</th>
                <!-- <th>Outstanding</th> -->
              </tr>
            </thead>
            <tbody>
        <?php
           $j=0;
           $k=0;
           $rtotal=0;
           $rec=array();

           set_time_limit(0);
            for ($i=0;$i<=COUNT($cum_arry)-1;$i++)
             {

               if(!is_null($mat_arry[$i]) && !is_null($cum_arry[$i])){
                  $result = stristrarray($mat_arry, $cum_arry[$i]);
               }
              
               $k++;
               if(!empty($result) && count($result)>0){
                 if (COUNT($result)>1){
                 $val=0;
                 $cTotal++;
                 echo "<tr style=\"font-size:12px\">
                  <td  style=\"font-size:12px\">
                  <div class = \"view_result\">
                    <a href=\"rst_sess.php?Returnurl=".enc($cum_arry[$i])."\" target =\"_blank\"><b> ".$nm_arry[$i]."</b></a>
                    <div class =\"pull-bottom\">
                    <a class = \"viewresult btn btn-success btn-xs\" target = \"_blank\" href=\"rst_sess.php?Returnurl=".enc($cum_arry[$i])."\" >View Result Sheet</a>
                    </div>
                   </div>
                  </td>";
                  $tot=0;

                $t_gp = 0;
                $t_tcc =0;
                $t_tce =0;
                $c_gpa =0;
                for ($a=0;$a<=COUNT($result)-1;$a++)
                {
                  $tot++;

                  $rec=explode("|",$mat_arry[$result[$a]]);
                  $t_tcc+=$rec[4];
                  $t_gp+=$rec[5];
                  if($rec[3]<>"F"){
                    $t_tce+=$rec[4];
                  }                 
                  echo "<td class=\"text-center\"><a href=\"r_sess.php?Returnurl=".enc($rec[1])."\" target =\"_blank\">".$rec[1]."<br>[".$rec[2]."=".$rec[3]."]"."</a></td>";
                }
                 for ($r=0;$r<=(17-($tot+1));$r++)
                 {
                   echo "<td></td>";
                 }
                 if ($t_tcc==0){
                   $c_gpa=0;
                 }else{
                   $c_gpa=$t_gp/$t_tcc;
                 }
                 if($tcc_arry[$i]>0){
                    $val=$tcgpe_arry[$i]/$tcc_arry[$i];
                 }
                 
                 echo "
                    <td>".$t_tcc."</td>
                    <td>".$t_tce."</td>
                    <td>".number_format($c_gpa,"2")."</td>
                    <td>".$tcc_arry[$i]."</td>
                    <td>".$tce_arry[$i]."</td>
                    <td>".$tcgpe_arry[$i]."</td>
                    <td>".number_format( $val,"2")."</td>

                  </tr>";
               
                // generate_cgpa($t_cgpa);
                switch ($val) {
                  case $val>=0 AND $val<1.5:
                  $fail++;
                  break;
                  case $val>=1.5 AND $val<2.5:
                  $rdC++;
                  break;
                  case $val>=2.5 AND $val<3.5:
                  $ndL++;
                  break;
                  case $val>=3.5 AND $val<4.5:
                  $ndU++;
                  break;
                  case $val>=4.5:
                  $stC++;
                  break;
                }
                $val=0;

                $failPerc=($fail/$cTotal)*100;
                $rdCPerc=($rdC/$cTotal)*100;
                $ndUPercc=($ndU/$cTotal)*100;
                $ndLPercc=($$ndL/$cTotal)*100;
                $stCPercc=($$stC/$cTotal)*100;

               }
               }

             }
             // $cTotal = $fail+$rdC+$ndU+$ndL+$stC;
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
