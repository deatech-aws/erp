<!-- begin #content -->
<?php

// $query="SELECT
//     	SUM(fail) AS fail,SUM(third_class) AS third_class,
//     	SUM(sec_lower) AS sec_lower,
//     	SUM(sec_upper)AS sec_upper,
//     	SUM(first_class)AS first_class
//     FROM prog_class_of_degree d INNER JOIN
//     programme p ON p.cprogrammeid = d.cprogrammeid
//     GROUP BY p.cprogrammeid,iYrlevel,batchno
//     HAVING p.cprogrammeid='".$_SESSION['prob_id']."' AND batchno='2016_2' AND iYrlevel=".$_SESSION['lev_id'];

// $query="SELECT
//     	SUM(fail) AS fail,SUM(third_class) AS third_class,
//     	SUM(sec_lower) AS sec_lower,
//     	SUM(sec_upper)AS sec_upper,
//     	SUM(first_class)AS first_class
//     FROM prog_class_of_degree d
//     GROUP BY cprogrammeid,iYrlevel,batchno
//     HAVING cprogrammeid='".$_SESSION['prob_id']."' AND batchno='2016_2' AND iYrlevel=".$_SESSION['lev_id'];

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
       <a href="." style="margin-left:30px"><i class="fa fa-2x fa-sign-out"></i> </a>
  </div>
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active"><a href="" onclick="generateComprehensive(<?php echo "'".$_SESSION['prob_id']."'".','. $imincredits;?>)">Regenerate Comprhensive</a></li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->

  <h1 class="page-header"><?php echo $prog_desc; ?> Result Analytics Dashboard <small>Academic Performance Distribution...</small></h1>
  <!-- end page-header -->
  <div class="row tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-users"></i> Total Numbers of Students</span>
        <div id="h_total" class="count text-info"><?php echo number_format($cTotal,"0"); ?></div>
        <span  class="count_bottom"><i class="green"> </i>Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-warning"></i> Students on Probation</span>
        <div id="h_fail" class="count text-danger"><?php echo number_format(($fail/$cTotal)*100,"2"); ?>%</div>
        <span id="s_fail" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i> <?php echo number_format($fail); ?> </i> Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> 3rd Class Division</b></span>
        <div id="h_3rd" class="count text-warning"><?php echo number_format(($rdC/$cTotal)*100,"2"); ?>%</div>
        <span id="s_3rd" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($rdC); ?></b></i> Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i><b> 2nd Class Lower Division</b></span>
        <div  id="h_ndL" class="count"><?php echo number_format(($ndL/$cTotal)*100,"2"); ?>%</div>
        <span id="s_ndL" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndL); ?></b></i> Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> 2nd Class Upper Division</span>
        <div id="h_ndU" class="count text-primary"><?php echo number_format(($ndU/$cTotal)*100,"2"); ?>%</div>
        <span id="s_ndU" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndU); ?></b></i> Probable Graduants</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"> First Class Division</i></span>
        <div id="h_stC" class="count text-success"><?php echo number_format(($stC/$cTotal)*100,"2"); ?>%</div>
        <span id="s_stC" class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($stC); ?></b></i> Probable Graduants</span>
      </div>
  </div>
<hr style="border-top: dotted 3px;margin-top:-20px" />
<div >
  <div class="pull-right" style="margin-top:-10px">
    <a href="prob_comprehensive.php" class="btn btn-xs btn-inverse" >Switch To Comprehensive View</a>
  </div>
  <h4 class="pull-left" style="margin-top:-10px">Minimun Credit Unit Required for Graduation: <?php echo $imincredits; ?> (Units)</h4>

</div>
  <div class="row" >
      <div class="panel panel-inverse" data-sortable-id="index-6">
        <div class="panel-heading" style="margin-top:15px">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove" disabled ><i class="fa fa-times"></i></a> -->
          </div>
          <h1 class="panel-title" style="font-size:14px;margin-top">Result Sheet of Probable Graduants of <?php echo $prog_desc .' for '.$_SESSION['sess']; ?>  Academic Session  </h1>
        </div>
        <div class="panel-body">
          <div style="width: 100%;">
          <div class="table-responsive" >
          <table id="tbl_rst" class="table table-bordered table-striped table-responsive" >
            <thead>
              <tr style="font-size:12px">
                <!-- <th>#</th> -->
                <th style="min-width:200px">Student's Name</th>
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
                <th>CC</th>
                <th>CE</th>
                <th>GPA</th>
                <th>TCC</th>
                <th>TCE</th>
                <th>CGPE</th>
                <th>CGPA</th>
                <th style="width:90px">Outstanding</th>
                <th style="width:90px">Passed Courses</th>
                <th style="width:90px">Failed Courses</th>
              </tr>
            </thead>
            <tbody>
        <?php
           $j=0;
           $k=0;
           $rtotal=0;
           $rec=array();
           $f_crs=array();
           $crs_taken=array();

           $arrCourse = array();
           $arrFCourse = array();
           $arrPCourse = array();
           $arrPC=array();
           $arrC = array();
           $arrP = array();
           $arrF = array();
           $arrFC = array();
           $f='[F]';

           set_time_limit(0);
           $cTotal=COUNT($cum_arry);
            for ($i=0;$i<=COUNT($cum_arry)-1;$i++)
             {
               $k++;
               echo "<tr style=\"font-size:12px;\">
                <td  style=\"font-size:12px\">
                <div class = \"view_result\">
                  <a href=\"rst_sess.php?Returnurl=".enc($cum_arry[$i])."\" target =\"_blank\"><b> ".$nm_arry[$i]."</b></a>
                  <div class =\"pull-bottom\">
                  <a class = \"viewresult btn btn-success btn-xs\" target = \"_blank\" href =\"rst_sess.php?Returnurl=".enc($cum_arry[$i])."\" >View Result Sheet</a>
                  </div>
                 </div>
                </td>";
                $tot=0;
              $result = stristrarray($mat_arry, $cum_arry[$i]);
              $o_crs="";
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
               if($t_tcc==0){
                 $c_gpa=0;
               }else{
                 $c_gpa=$t_gp/$t_tcc;
               }
               echo "
                 <td>".$t_tcc."</td>
                 <td>".$t_tce."</td>
                 <td>".number_format($c_gpa,"2")."</td>
                  <td>".$tcc_arry[$i]."</td>
                  <td>".$tce_arry[$i]."</td>
                  <td>".$tcgpe_arry[$i]."</td>
                  <td>".number_format($tcgpe_arry[$i]/$tcc_arry[$i],"2")."</td>
                  ";
                  $val=$tcgpe_arry[$i]/$tcc_arry[$i];
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
                      $crs = stristrarray($id_arry, $cum_arry[$i]);
                      if(count($crs)>0){
                        $all_crs =explode('|',$id_arry[$crs[0]]);//Get the entire row
                        $crs_taken=explode(",",$all_crs[1]);//Get students' comprehensive into array
                        //Get all the failed courses
                        $f_crs = stristrarray($crs_taken, '[F]');//Search for failed couses
                        $o_crs_g="";
                        if(COUNT($f_crs)>0){ //If they're failed courses
                          for ($y=0;$y<=COUNT($f_crs)-1;$y++){
                            //Retrieve the course code of all failed courses
                            if($o_crs==""){
                              $o_crs =substr($crs_taken[$f_crs[$y]],0,6);
                              $o_crs_g=$crs_taken[$f_crs[$y]];//Coursecode with grade
                            }else{
                              $o_crs .=",".substr($crs_taken[$f_crs[$y]],0,6);
                              $o_crs_g.=",".$crs_taken[$f_crs[$y]];
                            }
                          }

                          $arrFC=explode(",",$o_crs);
                          $arrFC_g=explode(",",$o_crs_g);
                          $arrPC=array_diff($crs_taken,$arrFC_g);

                            for($b=0;$b<=COUNT($arrPC)-1;$b++){
                              if (isset($arrPC[$b])) {
                                 // //Retriev only the coursecode of all passed courses
                                $arrPCourse[]=substr($arrPC[$b],0,6);
                              }

                            }

                          if (COUNT($arrPCourse)>0){
                            $out_standing=array_values(array_diff($core_arry,$arrPCourse));
                          }else{
                            $out_standing=array_values($core_arry);
                          }

                          $os_crs="";
                          $comma_separated_os="";
                          for ($t=0;$t<=COUNT($arrFC)-1;$t++){
                            //if any of the failed courses has been passed
                            if (COUNT(stristrarray($arrPC, $arrFC[$t]))<=0){
                              if($os_crs==""){
                                $os_crs =$arrFC[$t];
                              }else{
                                $os_crs .=",".$arrFC[$t];
                              }
                            };
                          }
                          $comma_separated_os = implode(",", array_unique($out_standing));
                          if($comma_separated_os!==""){
                            if ($os_crs!==""){
                              $data=$os_crs.','.$comma_separated_os;
                            }else{
                              $data=$comma_separated_os;
                            }

                          }else{
                            $data=$os_crs;
                          }
                          $arr_data=explode(",",$data);
                          $data=implode(",",array_unique($arr_data));

                          echo "<td class=\"text-left\" style=\"max-width:350px;\">".$data."</td>";

                        }else{
                          echo "<td></td>";
                        }

                    }else{
                      echo "<td></td>";
                    }
                    echo "<td class=\"text-left\" style=\"max-width:350px;\">".implode(",",$arrPC)."</td>";
                    echo "<td class=\"text-left\" style=\"max-width:350px;\">".implode(",",$arrFC)."</td>";

                  echo"
                </tr>";



             }

         ?>
            </tbody>
          </table>
        </div>
      </div>
        </div>
        </div>
      </div>

    </div>

  </div>
  <hr>
  <br>
  <!-- end row -->

<!-- end #content -->
