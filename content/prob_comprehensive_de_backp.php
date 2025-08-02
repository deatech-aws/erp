<!-- begin #content -->
<?php

$query="SELECT
    	SUM(fail) AS fail,SUM(third_class) AS third_class,
    	SUM(sec_lower) AS sec_lower,
    	SUM(sec_upper)AS sec_upper,
    	SUM(first_class)AS first_class
    FROM prog_class_of_degree d INNER JOIN
    programme p ON p.cprogrammeid = d.cprogrammeid
    GROUP BY p.cprogrammeid,iYrlevel,batchno
    HAVING p.cprogrammeid='".$_SESSION['prob_id']."' AND batchno = '".$_SESSION['sess']."' AND iYrlevel=".$_SESSION['lev_id'];

$query="SELECT
    	SUM(fail) AS fail,SUM(third_class) AS third_class,
    	SUM(sec_lower) AS sec_lower,
    	SUM(sec_upper)AS sec_upper,
    	SUM(first_class)AS first_class
    FROM prog_class_of_degree d
    GROUP BY cprogrammeid,iYrlevel,batchno
    HAVING cprogrammeid='".$_SESSION['prob_id']."' AND batchno = '".$_SESSION['sess']."' AND iYrlevel=".$_SESSION['lev_id'];

  // echo $query;

  // $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  // $stmt->execute();

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
       <!-- <a href="." style="margin-left:30px"><i class="fa fa-2x fa-sign-out"></i> </a> -->
  </div>
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active"><a id="btn_gen" data-id="<?php echo $_SESSION['prob_id']; ?>" data-min="<?php echo $imincredits; ?>" href="">Regenerate Comprhensive</a></li>
   <!--  <li class="active"><a id="btn_gen_direct" data-id="<?php echo $_SESSION['prob_id']; ?>" href="">Generate Comprehensive (Direct TCE=90)</a></li>-->
   <!--  <a id="btn_gen_direct" data-id="<?php echo $_SESSION['prob_id']; ?>" class="btn btn-info btn-lg">Generate Comprehensive (Direct TCE=90)</a> -->

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

  <div class="pull-right">      
      <a class="btn btn-success btn-block btn-sm" href="#modal_grad_req" data-toggle="modal" data-backdrop="static" data-keyboard="false" style="margin-top:-17px"></i>View Graduation Requirement</a>     
  </div>
  <div class="pull-right">   
      <a class="btn btn-primary btn-block btn-sm " href="#modal_grad_approved" data-toggle="modal" data-backdrop="static" data-keyboard="false" style="margin-top:-17px;margin-left:-10px"></i>Approved Probable Graduant</a>
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
          <h1 class="panel-title" style="font-size:14px;margin-top">Comprehensive Result Sheet of Probable Graduants of <?php echo $prog_desc .' for '.$_SESSION['sess']; ?> Academic Session  </h1>
        </div>
        <div class="panel-body">
          <div style="width: 100%;">
          <div class="table-responsive" >
          <table id="tbl_rst" class="table table-bordered table-striped table-responsive" >
            <thead>
              <tr style="font-size:12px">
                <th>Matric No</th>
                <th style="min-width:200px">Student's Name</th>
                <th>Center</th>
                <th>TCC</th>
                <th>TCE</th>
                <th>CGPE</th>
                <th>CGPA</th>
                <th>Passed Courses</th>
                <th>Failed Courses</th>
                <th >Outstanding</th>
              </tr>
            </thead>
            <tbody>
        <?php
        // $query="SELECT vMatricNo,Name,Center,TCC,TCE,CGPE,CGPA,cProgrammeId,courses
        //   FROM tbl_details
        //   WHERE cprogrammeid=:programmeid ";//'".$_SESSION['prob_id']."'
        $query="SELECT t.vMatricNo,Name,Center,TCC,TCE,CGPE,CGPA,t.cProgrammeId,courses,entrylevel
          FROM tbl_details t inner join
          students s ON s.vmatricno=t.vMatricNo AND t.cprogrammeid=:programmeid AND grad_approved=0 where t.vMatricNo NOT in (select vMatricNo from misconduct_list)";
          // echo $query;
          $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
              $stmt->bindParam(':programmeid', $_SESSION['prob_id'], PDO::PARAM_STR,4);
              $stmt->execute();
              $k=1;
              $t_fail=0;
              $t_out=0;
              $t_both=0;
              $t_grad=0;
              $cTotal=$stmt->rowCount();
              $t_only_fail=0;
              $t_only_out=0;
          // $t_both=0;
              $isStr="";
              $dsc ="";
              $ien_level=0;
          while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
          {
            $f = '[F]';
            $isStr="";
            $is_De ="";
            $arrCourse = array();
            $arrFCourse = array();
            $arrPCourse = array();
            $arrOut= array();
            $arrC = array();
            $arrEn = array();
            $arrP = array();
            $arrF = array();
            $arrFC = array();
            $arrOut1=array();
            $arrOut=array();
            $de_arrOut =array();
            $course = $rw[8];
            $ien_level=$rw[9];
            //$course=returns_reference($rw[0]);
            $arrCourse = explode(',',$course);
            for ($i = 0; $i < count($arrCourse); $i++) {
              $str = $arrCourse[$i];
              $arrC[] = substr($str,0,6);

              $pos=strpos($str,$f);
              if ($pos!==false){
                $arrFCourse[]=$arrCourse[$i];
                $arrF[] = substr($arrCourse[$i],0,6);
              }else{
                  $arrP[]=substr($arrCourse[$i],0,6);
              }
            }
            $arrFC =array_diff($arrF,$arrP);
            // $arrFC =array_diff($arrFC,$arrP);
            // var_dump($core_arry);
            // exit;
            
            $arrPCourse=array_diff($arrCourse,$arrFCourse);
            $arrOut1 =array_diff($core_arry,$arrP);
            $arrOut =array_diff($arrOut1,$arrF);
            $arrOF = array_diff($core_arry,$arrP);
            
            $is_De="";
            if($ien_level==200){
              $arrOut1=array_diff($de_core_arry,$arrP);
              $arrOut =array_diff($arrOut1,$arrF);
              $is_De = " (Direct Entry)";
            }

            $comma_separated = implode(",", $arrPCourse);
            $comma_separatedF = implode(",", $arrFCourse);
            $comma_separated_out=implode(",",$arrOut);
            $comma_separated_arrOF=implode(",",$arrOF);

            $isStr=implode(",", $arrFC);


            // for ($y = 0; $y < count($arrFCourse); $y++) {
            //   if (substr($arrFCourse[$y],0,3)==1){
            //     $arrEn[]=$arrFCourse($y);
            //   };
            // }

            // if($ien_level==200){
            //   if (count($arrEn)>0){
            //     $arrOut =array_diff($arrOut,$arrEn);
            //   }
            //
            //   if (count($arrOut)>0){
            //     $comma_separated_out=implode(",",$arrOut);
            //   }
            //
            // }
            //

            if (COUNT($arrFC)>0){
              $t_fail+=1;
            }
            if($comma_separated_out!=""){
              $t_out+=1;
            }
            if (COUNT($arrFC)>0){
              if($comma_separated_out!=""){
                $t_both+=1;
              }else{
                $t_only_fail+=1;
              }
            }else{
              if($comma_separated_out!=""){
                $t_only_out+=1;
              }else{
                $t_grad+=1;
              }
            }

            $url = enc($rw[0]);
            $val=$rw[6];

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

            $dsc ="<div class = \"view_result\">
              <a href=\"rst_sess.php?Returnurl=".enc($rw[0])."\"><b> ".$rw[1]."</b></a>
              <div class =\"pull-bottom\">
              <a class = \"viewresult btn btn-success\"  href=\"rst_sess.php?Returnurl=".enc($rw[0])."\">Review </a>
             
			  <a class = \"viewresult btn_app btn btn-primary\" data-id =".$rw[0].">Ovveride Approve Result</a>
              </div>
             </div>";
			 $dsc2 ="<div class = \"view_result\">
              <a href=\"rst_sess.php?Returnurl=".enc($rw[0])."\"><b> ".$rw[1]."</b></a>
              <div class =\"pull-bottom\">
              <a class = \"viewresult btn btn-success\"  href=\"rst_sess.php?Returnurl=".enc($rw[0])."\">Review </a>
			  <a class = \"viewresult btn_app btn btn-primary\" data-id =".$rw[0].">Ovveride Approve Result</a>
              </div>
             </div>";

             $dsc1 ="<div class = \"view_result\">
               <a href=\"rst_sess.php?Returnurl=".enc($rw[0])."\" ><b> ".$rw[1]."</b></a>
               <div class =\"pull-bottom\">
               <a class = \"viewresult btn btn-success\"  href=\"rst_sess.php?Returnurl=".enc($rw[0])."\">Review </a>

               </div>
              </div>";
            $val=0;
            echo"
              <tr>
              ";
            if ( $comma_separated_out=="" && $comma_separated_arrOF==""){
            // if ( $comma_separated_out=="" ){
          // if (empty($comma_separated_out) || $comma_separated_out==""){
              echo "<td> ".$rw[0]."<br><b>".$is_De."</b><span class=\"text-center\"><i class =\"fa fa-2x fa-check \"><i/></span></td>
              <td style =\"width:200px\">
              ".$dsc."</td>";
            }elseif ($comma_separated_out!==""){
              echo "<td> ".$rw[0]."<br><b>".$is_De."</b></td>
              <td style =\"width:200px\">
              ".$dsc2."</td>";
			      }
			else{
               echo "<td>".$rw[0]."<br><b>".$is_De."</b></td>
                <td>".$dsc1."</td>";
            }
            echo "

                 <td>".$rw[2]."</td>
                 <td>".$rw[3]."</td>
                 <td>".$rw[4]."</td>
                 <td>".$rw[5]."</td>
                <td>".number_format($rw[6],"2")."</td>
                <td style=\"max-width:500px\">".$comma_separated."</td>
                <td style=\"max-width:500px\">".$isStr."</td>
                <td style=\"max-width:300px\">".$comma_separated_out." </td>
              </tr>";
              $k+=1;

            $arrFCourse = null;
            $arrPCourse = null;
            $arrCourse=null;
            $arrF=null;
            $arrP=null;
          }
          $stmt->closeCursor();
         ?>
        </tbody>
      </table>
    </div>
  </div>

    <p class="lead">Summary Statistics</p>
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <!-- <span class="count_top"><i class="fa fa-users"></i> Met Graduation Creteria</span> -->
              <div  class="count text-info"><?php echo number_format(($t_grad/$cTotal)*100,"2");?>%</div>
              <span  class="count_bottom"><i class="green"></i> <?php echo $t_grad; ?></b> </i>Met Graduation Creteria</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <!-- <span class="count_top"><i class="fa fa-warning"></i> One or More Reference(s)</span> -->
              <div  class="count text-danger"><?php echo number_format(($t_fail/$cTotal)*100,"2"); ?>%</div>
              <span  class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i> <?php echo $t_fail; ?> </i> One or More Reference(s)</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <!-- <span class="count_top"><i class="fa fa-user"></i><b> One or More Outstanding</b></span> -->
              <div  class="count text-warning"><?php echo number_format(($t_out/$cTotal)*100,"2"); ?>%</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo $t_out; ?></b></i> One or More Outstanding</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <!-- <span class="count_top"><i class="fa fa-user"></i><b> References & Outstanding</b></span> -->
              <div  class="count"><?php echo number_format(($t_both/$cTotal)*100,"2"); ?>%</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo $t_both; ?></b></i> Both Outstanding & References</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <!-- <span class="count_top"><i class="fa fa-user"></i> Religated </span> -->
              <div class="count text-primary"><?php echo number_format(($t_only_out/$cTotal)*100,"2"); ?>%</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($t_only_out); ?></b></i> Only Outstanding</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <!-- <span class="count_top"><i class="fa fa-user"> Direct Entry Probable</i></span> -->
              <div class="count text-success"><?php echo number_format(($t_only_fail/$cTotal)*100,"2"); ?>%</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($t_only_fail); ?></b></i> Only References</span>
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
