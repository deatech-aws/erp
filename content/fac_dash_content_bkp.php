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
//     WHERE cfacultyid='".$_SESSION['fac_id']."' ";

$query="SELECT SUM(fail) AS fail,SUM(third_class) AS third_class,
  SUM(sec_lower) AS sec_lower,
  SUM(sec_upper)AS sec_upper,
  SUM(first_class)AS first_class
  FROM prog_class_of_degree
  GROUP BY cfacultyid,batchno
  HaVING cfacultyid='".$_SESSION['fac_id']."' AND batchno='2016_1'";
// echo $query;
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
    $ndU=$rw[2];
    $ndL=$rw[3];
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
  <div class="icon pull-right" style="margin-top:5px;margin-left:30px">
       <a href="index.php" style="margin-left:30px"><i class="fa fa-2x fa-sign-out"></i> </a>
  </div>
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header">Faculty of <?php echo $fac_desc; ?> Result Analytics Dashboard <small>Academic Performance Distribution...</small></h1>
  <!-- end page-header -->
  <div class="row tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-users"></i> Total Numbers of Students</span>
        <div class="count text-info"><?php echo number_format($cTotal,"0"); ?></div>
        <span class="count_bottom"><i class="green"> </i>Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-warning"></i> Students on Probation</span>
        <div class="count text-danger"><?php echo number_format(($fail/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i> <?php echo number_format($fail); ?> </i> Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> 3rd Class Division</b></span>
        <div class="count text-warning"><?php echo number_format(($rdC/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($rdC); ?></b></i> Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> 2nd Class Lower Division</b></span>
        <div class="count"><?php echo number_format(($ndL/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndL); ?></b></i> Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> 2nd Class Upper Division</span>
        <div class="count text-primary"><?php echo number_format(($ndU/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndU); ?></b></i> Student Result</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"> First Class Division</i></span>
        <div class="count text-success"><?php echo number_format(($stC/$cTotal)*100,"2"); ?>%</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($stC); ?></b></i> Student Result</span>
      </div>
  </div>

<hr style="border-top: dotted 3px;margin-top:-20px" />
  <!-- begin row -->
			<!--  -->
			<!-- end row -->
  <!-- begin row -->
  <div class="row">
    <!-- begin col-8 -->
    <!-- <div class="col-md-8"> -->
      <!-- <div class="panel panel-inverse " data-sortable-id="index-1"> -->
        <!-- <div class="panel-heading bg-green">
          <div class="panel-heading-btn ">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h4 class="panel-title">Course Materials (as at 30th of April, 2021)</h4>
        </div> -->
        <!-- <div class="panel-body" >
          <div id="echart_line" class="height-ml" style="height:450px"></div>
        </div> -->
        <div class="widget-chart with-sidebar ">
            <div class="widget-chart-content" style="margin-top:-30px">
                <h3 class="text-black">
                    Class of Degree Analytics
                    <small>Faculty class of degree distribution</small>
                </h3>
                <div id="echart_line" class="height-ml" style="height:450px"></div>
                <!-- <div id="visitors-line-chart" class="morris-inverse" style="height: 260px;"></div> -->
            </div>
            <div class="widget-chart-sidebar bg-grey">
              <div class="chart-number">
                  <?php echo number_format($cTotal,"0"); ?>
                  <small class="chart-number"><b>Students' Count</b></small>
              </div>
                <!-- <div id="visitors-donut-chart" style="height: 160px"></div> -->
                <div id="morris-donut-chart" class="height-sm"></div>
                <!-- <ul class="" style="font-size:12px">
                    <i class="fa fa-circle fa-fw text-primary f-s-9 m-r-5 t-minus-1"></i> 34.0% <span>Assets</span></br>
                    <i class="fa fa-circle fa-fw text-aqua f-s-9 m-r-5 t-minus-1"></i> 56.0% <span>Consumables</span></br>
                    <i class="fa fa-circle fa-fw text-aqua f-s-9 m-r-5 t-minus-1"></i> 56.0% <span>Out-of-Stock</span>
                </ul> -->
                <ul class="pull-left" style="font-size:14px">
                    <i class="fa fa-circle fa-fw text-danger f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format(($fail/$cTotal)*100,"2"); ?><span> Probation List</span></br>
                    <i class="fa fa-circle fa-fw text-inverse f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format(($rdC/$cTotal)*100,"2") ?>% <span>3<sup>rd</sup> Class</span></br>
                    <i class="fa fa-circle fa-fw text-primary f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format(($ndL/$cTotal)*100,"2") ?>% <span>2<sup>nd</sup> Class <i class="fa fa-long-arrow-down"></i></span></br>
                    <i class="fa fa-circle fa-fw text-info f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format(($ndU/$cTotal)*100,"2") ?>% <span>2<sup>nd</sup> Class <i class="fa fa-long-arrow-up"></i></span></br>
                    <i class="fa fa-circle fa-fw text-success f-s-9 m-r-5 t-minus-1"></i> <?php echo number_format(($stC/$cTotal)*100,"2") ?>% <span>1<sup>st</sup> Class </span>
                </ul>
            </div>
        </div>
      <!-- </div> -->


    <!-- </div> -->
    <!-- end col-8 -->
    <!-- begin col-4 -->
    <!-- <div class="col-md-4"> -->
      <div class="panel panel-inverse" data-sortable-id="index-6">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h1 class="panel-title" style="font-size:14px">Faculty Class of Degree Analytics Details</h1>
        </div>
        <div class="panel-body p-t-0 ">
          <div style="overflow-x:auto;">
          <table id="tbl_zone" class="table table-striped table-valign-middle m-b-0" >
            <thead>
              <tr style="font-size:18px">
                <th>Program</th>
                <th>Population</th>
                <th>Probation</th>
                <th>3<sup>rd</sup> Class </th>
                <th>2<sup>nd</sup> Class <i class="fa fa-long-arrow-down"></i></th>
                <th>2<sup>nd</sup> Class <i class="fa fa-long-arrow-up"></i></th>
                <th>1<sup>st</sup> Class </th>
              </tr>
            </thead>
            <tbody>
              <?php
        //       $query ="SELECT *
        //           FROM tblzonevw
        //           ORDER BY cgeozoneid
        //           ";
        // $query ="SELECT f.cfacultyid,vlegend,
        //         SUM((CASE iLevel WHEN 100 THEN i.qty END ) ) AS '100L',
        //         SUM((CASE iLevel WHEN 200 THEN i.qty END ) ) AS '200L',
        //         SUM((CASE iLevel WHEN 300 THEN i.qty END ) ) AS '300L',
        //         SUM((CASE iLevel WHEN 400 THEN i.qty END ) ) AS '400L',
        //         SUM((CASE iLevel WHEN 500 THEN i.qty END ) ) AS '500L',
        //         SUM((CASE iLevel WHEN 600 THEN i.qty END ) ) AS 'PGD',
        //         SUM((CASE iLevel WHEN 700 THEN i.qty END ) ) AS 'Masters'
        //           FROM faculty f INNER JOIN
        //           availablecourse a ON a.cfacultyid = f.cfacultyid INNER JOIN
        //           inventory i ON  a.coursecode = i.coursecode
        //           GROUP BY f.cfacultyid,vlegend,cstudycenterid
        //           HAVING cstudycenterid='".$_SESSION['ctr_id']."'
        //           ";
      $query="SELECT c.cprogrammeid,vprogaward,
                SUM(fail) AS fail,
                SUM(third_class) AS third_class,
                SUM(sec_lower) AS sec_lower,
                SUM(sec_upper)AS sec_upper,
                SUM(first_class)AS first_class,clabel,ceductgid,iDuration
  							FROM prog_class_of_degree c INNER JOIN
  							programme p ON p.cprogrammeid=c.cprogrammeid
  							GROUP BY p.cprogrammeid,vprogaward,clabel,c.cfacultyid,batchno,ceductgid,iDuration
                HAVING c.cfacultyid='".$_SESSION['fac_id']."' AND batchno='2016_1' ORDER BY vprogaward";
             // echo $query;
                   $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                   $stmt->execute();
                   $j=0;
                   $rtotal=0;
                   $ZoneStr = array();
                   $fag = array();
                   $foa = array();
                   $foe = array();
                   $foh = array();
                   $fol = array();
                   $fom = array();
                   $fos = array();
                   $fss = array();
                     while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                     {
                       $j++;
                       // $rtotal=0;
                       for ($i = 2;($i<=6);$i++){
                         if(!is_null($rw[$i])){
                          $rtotal +=$rw[$i];
                          }
                        }
                        // $json_array['label']=$rw[1];
                        // $json_array['value']=number_format((($rtotal/$cTotal)*100)+'%',"2");
                        // array_push($json_data,$json_array);

                     echo "<tr style=\"font-size:16px\">
                           <td style=\"font-size:16px\">
                           <div class = \"view_result\">
                             <a href=\"prog_sess.php?Returnurl=".enc($rw[0])."\" target =\"_blank\"><b> ".$rw[1]."</b></a>
                               <div class =\"pull-bottom\">";
                              if($rw[8]=="PGX"){
                                echo"
                                <a class = \"viewresult btn btn-warning btn-xs\" target = \"_blank\" href=\"p_lev_sess.php?Returnurl=".enc($rw[0].'|700')."\" >PG List</a>
                                <a class = \"viewresult btn btn-primary btn-xs\" target = \"_blank\" href=\"prob_sess.php?Returnurl=".enc($rw[0])."\" >Probation Graduant</a>
                                ";
                              }elseif($rw[8]=="PGY"){
                                echo"
                                <a class = \"viewresult btn btn-warning btn-xs\" target = \"_blank\" href=\"p_lev_sess.php?Returnurl=".enc($rw[0].'|800')."\" >Master List</a>
                                <a class = \"viewresult btn btn-primary btn-xs\" target = \"_blank\" href=\"prob_sess.php?Returnurl=".enc($rw[0].'|800')."\" >Probation Graduant</a>
                                ";
                              }else{
                                for ($i=1;$i<=$rw[9];$i++){
                                  echo "<a class = \"viewresult btn btn-success btn-xs\" target = \"_blank\" href=\"p_lev_sess.php?Returnurl=".enc($rw[0].'|'.$i*100)."\" >".$i."00 Level </a>
                                  ";
                                }
                                $i--;
                                echo "<a class = \"viewresult btn btn-primary btn-xs\" target = \"_blank\" href=\"prob_sess.php?Returnurl=".enc($rw[0].'|'.$i*100)."\" >Probation Graduant</a>";
                              }
                                 echo "
                               </div>
                            </div>
                           </td>";

                           $ZoneStr[]=$rw[7];
                           $a_fail[] = number_format(($rw[2]/$rtotal)*100,"2");
                           $a_3rd[] = number_format(($rw[3]/$rtotal)*100,"2");
                           $a_2ndL[] = number_format(($rw[4]/$rtotal)*100,"2");
                           $a_2ndU[] = number_format(($rw[5]/$rtotal)*100,"2");
                           $a_1st[] = number_format(($rw[6]/$rtotal)*100,"2");

                           echo "
                           <td style=\"font-size:18px\">".number_format($rtotal,"0")."</td>
                           <td style=\"font-size:18px\">".number_format(($rw[2]/$rtotal)*100,"2")."% (".number_format($rw[2],"0").")</td>
                           <td style=\"font-size:18px\">".number_format(($rw[3]/$rtotal)*100,"2")."% (".number_format($rw[3],"0").")</td>
                           <td style=\"font-size:18px\">".number_format(($rw[4]/$rtotal)*100,"2")."% (".number_format($rw[4],"0").")</td>
                           <td style=\"font-size:18px\">".number_format(($rw[5]/$rtotal)*100,"2")."% (".number_format($rw[5],"0").")</td>
                           <td style=\"font-size:18px\">".number_format(($rw[6]/$rtotal)*100,"2")."% (".number_format($rw[6],"0").")</td>
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
    <!-- end col-4 -->
  </div>
  <!-- end row -->
</div>
<!-- end #content -->
