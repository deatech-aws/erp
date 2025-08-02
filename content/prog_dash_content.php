<!-- begin #content -->
<?php
// $query ="SELECT
//     COUNT(CASE WHEN CGPA  BETWEEN 0 AND 1.49 THEN r.vMatricNo END) AS Fail,
//     COUNT(CASE WHEN CGPA  BETWEEN 1.5 AND 2.49 THEN r.vMatricNo END) AS Third_Class,
//     COUNT(CASE WHEN CGPA  BETWEEN 2.5 AND 3.49 THEN r.vMatricNo END) AS Second_Class_lower,
//     COUNT(CASE WHEN CGPA  BETWEEN 3.5 AND 4.49 THEN r.vMatricNo END) AS Second_Class_upper,
//     COUNT(CASE WHEN CGPA  BETWEEN 4.5 AND 5 THEN r.vMatricNo END) AS First_Class
//     FROM released_summary r ";
//
// $query="SELECT SUM(fail) AS fail,
//     SUM(third_class) AS third_class,
//     SUM(sec_lower) AS sec_lower,
//     SUM(sec_upper)AS sec_upper,
//     SUM(first_class)AS first_class
//     FROM class_of_degree
//     WHERE cfacultyid='".$_SESSION['fac_id']."'";

$query="SELECT
    	SUM(fail) AS fail,SUM(third_class) AS third_class,
    	SUM(sec_lower) AS sec_lower,
    	SUM(sec_upper)AS sec_upper,
    	SUM(first_class)AS first_class
    FROM rst_class_of_degree
    GROUP BY cprogrammeid,batchno
    HAVING cprogrammeid='".$_SESSION['prog_id']."' AND batchno = '".$_SESSION['sess']."'";

  // echo $query;
  // exit;

  $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $stmt->execute();
  $fail=0;
  $rdC =0;
  $ndU=0;
  $ndL=0;
  $stC=0;
  $cTotal=0;
  while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
  {
    $fail=$rw[0];
    $rdC =$rw[1];
    $ndL=$rw[2];
    $ndU=$rw[3];
    $stC=$rw[4];
    $cTotal=$rw[0]+$rw[1]+$rw[2]+$rw[3]+$rw[4];
    $json_array['label']='Probation';
    $json_array['value']=$rw[0];
    array_push($json_data,$json_array);
    $json_array['label']='Third Class';
    $json_array['value']=$rw[1];
    array_push($json_data,$json_array);
    $json_array['label']='2.2';
    $json_array['value']=$rw[2];
    array_push($json_data,$json_array);
    $json_array['label']='2.1';
    $json_array['value']=$rw[3];
    array_push($json_data,$json_array);
    $json_array['label']='First Class';
    $json_array['value']=$rw[4];
    array_push($json_data,$json_array);
  }
  $stmt->closeCursor();
 ?>
<div id="content" class="content" style="margin-top:30px">
  <!-- begin breadcrumb -->

  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Dashboard</a></li>
    <li class="active">Analytics</li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header"><?php echo $fac_desc; ?> Result Analytics Dashboard <small>Academic Performance Distribution...</small></h1>
  <!-- end page-header -->

  <div class="row tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-users"></i> Total Numbers of Students</span>
        <div class="count text-info"><?php echo number_format($cTotal,"0"); ?></div>
        <span class="count_bottom"><i class="green"> </i>Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-warning"></i> Students on Probation</span>
        <div class="count text-danger"><?php echo number_format(($fail/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i> <?php echo number_format($fail); ?> </i> Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> 3rd Class Division</b></span>
        <div class="count text-warning"><?php echo number_format(($rdC/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($rdC); ?></b></i> Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> 2nd Class Lower Division</b></span>
        <div class="count"><?php echo number_format(($ndL/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndL); ?></b></i> Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> 2nd Class Upper Division</span>
        <div class="count text-primary"><?php echo number_format(($ndU/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndU); ?></b></i> Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"> First Class Division</i></span>
        <div class="count text-success"><?php echo number_format(($stC/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($stC); ?></b></i> Probable Graduants</span>
      </div>
  </div>

<hr style="border-top: dotted 3px;margin-top:-20px" />

  <div class="row">
      <div class="panel panel-inverse" data-sortable-id="index-6">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a> -->
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
          </div>
          <h4 class="panel-title"><?php echo $fac_desc; ?> Class of Degree Distribution By Level</h4>
        </div>
        <div class="panel-body p-t-0 ">
          <br>
          <div class="table-responsive">
          <table id="tbl_zone" class="table table-striped"  >
            <thead>
              <tr style="font-size:14px">
                <th style="font-size:18px">Programme Level of Study</th>
                <th style="font-size:18px">Population</th>
                <th style="font-size:18px">Probation</th>
                <th style="font-size:18px">3<sup>rd</sup> Class </th>
                <th style="font-size:18px">2<sup>nd</sup> Class <i class="fa fa-long-arrow-down"></i></th>
                <th style="font-size:18px">2<sup>nd</sup> Class <i class="fa fa-long-arrow-up"></i></th>
                <th style="font-size:18px">1<sup>st</sup> Class </th>
              </tr>
            </thead>
            <tbody>
              <?php

        $query="SELECT iYrlevel,
                	SUM(fail) AS fail,SUM(third_class) AS third_class,
                	SUM(sec_lower) AS sec_lower,
                	SUM(sec_upper)AS sec_upper,
                	SUM(first_class)AS first_class
                FROM rst_class_of_degree
                GROUP BY iYrlevel,cprogrammeid,batchno
                HAVING cprogrammeid='".$_SESSION['prog_id']."' AND batchno = '".$_SESSION['sess']."'";

                // echo $query;

                // exit;

                   $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                   $stmt->execute();
                   $j=0;
                   $rtotal=0;
                   $ZoneStr = array();
                   $a_fail = array();
                   $a_3rd = array();
                   $a_2ndL = array();
                   $a_2ndU = array();
                   $a_1st = array();
                   $lev="";

                     while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                     {
                       $j++;
                       // $rtotal=0;
                       $rtotal=0;
                       for ($i = 1;($i<=5);$i++){
                         if(!is_null($rw[$i])){
                          $rtotal +=$rw[$i];
                          }
                        }
                        $lev=enc($rw[0]);
                        //$lev=enc($lev);
                        // echo "Level is: ".enc($lev);
                        // exit;
                        // $json_array['label']=$rw[0]." Level";
                        // $json_array['value']=number_format((($rtotal/$cTotal)*100)+'%',"2");
                        // array_push($json_data,$json_array);

                         //<a class = \"viewresult btn btn-warning btn-xs\" target = \"_blank\" href=\"p_lev_sess.php?Returnurl=".enc($rw[0].'|700')."\">PG List</a>
                      //<a href=\"lev_sess.php?Returnurl=".$lev."\" target =\"_blank\"><b> ".$rw[0]." Level Result Statistics</b></a>
                     echo "<tr style=\"font-size:14px\">
                           <td style=\"font-size:18px\">
                             <div class = \"view_result\">                                 
                                 <a  target = \"_blank\" href=\"p_lev_sess.php?Returnurl=".enc($_SESSION['prog_id'].'|'.$rw[0])."\"><b> ".$rw[0]." Level Result Statistics</b></a>
                              </div>
                           </td>";

                           $ZoneStr[]=$rw[0];
                           $a_fail[] = number_format(($rw[1]/$rtotal)*100,"2");
                           $a_3rd[] = number_format(($rw[2]/$rtotal)*100,"2");
                           $a_2ndL[] = number_format(($rw[3]/$rtotal)*100,"2");
                           $a_2ndU[] = number_format(($rw[4]/$rtotal)*100,"2");
                           $a_1st[] = number_format(($rw[5]/$rtotal)*100,"2");

                           echo "
                           <td style=\"font-size:18px\">".number_format($rtotal,"0")."</td>
                           <td style=\"font-size:18px\">".number_format(($rw[1]/$rtotal)*100,"2")."% (".number_format($rw[1],"0").")</td>
                           <td style=\"font-size:18px\">".number_format(($rw[2]/$rtotal)*100,"2")."% (".number_format($rw[2],"0").")</td>
                           <td style=\"font-size:18px\">".number_format(($rw[3]/$rtotal)*100,"2")."% (".number_format($rw[3],"0").")</td>
                           <td style=\"font-size:18px\">".number_format(($rw[4]/$rtotal)*100,"2")."% (".number_format($rw[4],"0").")</td>
                           <td style=\"font-size:18px\">".number_format(($rw[5]/$rtotal)*100,"2")."% (".number_format($rw[5],"0").")</td>


                       </tr>";
                       $rtotal=0;
                     }
                 ?>
            </tbody>

          </table>
          </div>
        </div>
      </div>
      <div class="col-md-12 ">
			        <div class="widget-chart with-sidebar ">
			            <div class="widget-chart-content" style="margin-top:-30px">
			                <h3 class="text-black">
			                    Class of Degree Analytics
			                    <small>Class of Degree Distribution By Level of Study</small>
			                </h3>
                      <div id="echart_line" class="height-ml" style="height:450px"></div>
			                <!-- <div id="visitors-line-chart" class="morris-inverse" style="height: 260px;"></div> -->
			            </div>
			            <div class="widget-chart-sidebar bg-grey">
			                <div class="chart-number">
			                    <?php echo number_format($cTotal,"0"); ?>
			                    <small class="chart-number"><b>Students' Count</b> </small>
			                </div>
			                <!-- <div id="visitors-donut-chart" style="height: 160px"></div> -->
                      <div id="morris-donut-chart" class="height-sm"></div>
                      <ul class="pull-left" style="font-size:14px">
                          <i class="fa fa-circle fa-fw text-danger f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format($fail,"0"); ?><span> Probation List</span></br>
                          <i class="fa fa-circle fa-fw text-inverse f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format(($rdC/$cTotal)*100,"2") ?>% <span>3<sup>rd</sup> Class</span></br>
                          <i class="fa fa-circle fa-fw text-primary f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format(($ndL/$cTotal)*100,"2") ?>% <span>2<sup>nd</sup> Class <i class="fa fa-long-arrow-down"></i></span></br>
                          <i class="fa fa-circle fa-fw text-info f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format(($ndU/$cTotal)*100,"2") ?>% <span>2<sup>nd</sup> Class <i class="fa fa-long-arrow-up"></i></span></br>
                          <i class="fa fa-circle fa-fw text-success f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format(($stC/$cTotal)*100,"2") ?>% <span>1<sup>st</sup> Class </span>
                      </ul>
                      <!-- <ul class="" style="font-size:12px">
                          <i class="fa fa-circle fa-fw text-primary f-s-9 m-r-5 t-minus-1"></i> 34.0% <span>Assets</span></br>
                          <i class="fa fa-circle fa-fw text-aqua f-s-9 m-r-5 t-minus-1"></i> 56.0% <span>Consumables</span></br>
                          <i class="fa fa-circle fa-fw text-aqua f-s-9 m-r-5 t-minus-1"></i> 56.0% <span>Out-of-Stock</span>
                      </ul> -->
			            </div>
			        </div>
			    </div>
    </div>
    <!-- end col-4 -->
  </div>
  <hr>
  <br>
  <!-- end row -->

<!-- end #content -->
