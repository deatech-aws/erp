<?php

 ?>
 <div class="row" >
       <!-- begin col-12 -->
 <div class="col-md-12">
     <!-- begin panel -->
     <div class="panel" style="height:60px;margin-top:80px">

       <div class="panel-body bg-white" style="margin-top:5px;margin-right:5px">
       <form action="" method="POST" name="form-wizard">
         <div class="panel-heading"
             <h5 class="panel-title" style="font-size:20px"><?php echo $Ptitle." :Matric No: ".$id; ?> </h5>
         </div>
         <hr style="margin-top:-10px" />
         <div class="profile-section" style="width:100%">
             <!-- begin profile-left -->
             <div class="col-sm-12 col-sm-12 col-sm-16">
             <ul class="stats-overview">
                  <li>
                    <span class="name" style="font-size:15px"> <b>Cumulative Credit Carried <br></b> </span>
                    <span id = "stcc" class="value text-success" style="font-size:20px"> 2300 </span>
                  </li>
                  <li>
                    <span class="name" style="font-size:15px"> <b>Cumulative Credit Earned<br></b> </span>
                    <span id = "stce" class="value text-success" style="font-size:20px"> 2000 </span>
                  </li>
                  <li class="hidden-phone">
                    <span class="name" style="font-size:15px"> <b>Cum. Grade Point Average <br></b> </span>
                    <span id = "scgpa" class="value text-success" style="font-size:20px"> 20 </span>
                  </li>
              </ul>
              <hr>
              </div>
             <!-- end profile-left -->
             <!-- begin profile-right -->
             <!-- <h2>Courses Taken To Date</h2> -->
             <div class="col-md-12">
                 <!-- begin profile-info -->
                 <div class="profile-info" >
                     <!-- begin table -->
                     <!-- <div class="height-ml" data-scrollbar="true" data-init="true" style="overflow: hidden; width: auto; height: 650px;"> -->
                      <!-- <div class="slimScrollBar"> -->
                    <div class="table-responsive" data-scrollbar="true" style="height:550px">
                        <div class="" >
                          <table id="tb_sheet" class="table table-striped table-bordered" style="width:100%!important;font-siz">
                          <thead>
                          <tr>
                            <th>ID</th>
                            <th>Course Title</th>
                            <th>Unit</th>
                            <th>Grade</th>
                            <th>Point</th>
                            <th align = "right">G-Point</th>
                            <th>Status</th>
                            <th>Batch</th>
                          </tr>

                          </thead>
                            <tbody>
                              <?php
                               include "inc/pdo_connectdb.php";
                                $SQL ="SELECT  r.CourseCode,RTRIM(c.CourseTitle),r.CreditUnit,r.Grade,r.Points,r.CreditUnit*r.Points AS GradePnt,c.cStatus,BatchNo
                                FROM releasedresults r INNER JOIN
                                availablecourse c ON  r.CourseCode = c.CourseCode
                                AND r.vMatricNo =:matricno
                                              ";
                                  $dbgradepoint = 0;
                                  $p_crs=array();
                                  $out_standing=array();
                                  $tcc= 0;
                                  $tce= 0;
                                  $tgp = 0;
                                  $gpa = 0;
                                  $cgpa = 0;

                                  $ttcc= 0;
                                  $ttce= 0;
                                  $otcr= 0;
                                  $ttgp = 0;
                                  $tgpa = 0;
                                  $tc = 0;

                                  $total = 0;
                                  $gradeF=0;
                                  $gradeE=0;
                                  $gradeD=0;
                                  $gradeC=0;
                                  $gradeB=0;
                                  $gradeA=0;

                             $stmt = $conn->prepare($SQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                 $stmt->bindParam(':matricno', $_SESSION['Returnurl'], PDO::PARAM_STR,4);
                                 $stmt->execute();
                                 $k=1;
                          $arrBatchNo = array();
                          $result= array();
                          $arrGrade = array();
                          $arrRset = array();
                          $rec="";
                          while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                                  {
                                    $rec = $rw[0]."|".trim($rw[1])."|".$rw[2]."|".$rw[3]."|".$rw[4]."|".$rw[5]."|".$rw[6]."|".$rw[7];
                                    $stripped = str_replace('\?', '', $rw[1]);
                                    echo"
                                    <tr style=\"font-size:14px\">

                                       <td>".$rw[0]."</td>

                                       <td>".$stripped. "</td>
                                       <td>".$rw[2]. "</td>
                                       <td>".$rw[3]."</td>
                                       <td>".$rw[4]."</td>
                                       <td>".$rw[5]."</td>
                                       <td>".$rw[6]."</td>
                                       <td>".$rw[7]."</td>
                                    </tr>";
                                  $arrBatchNo[] = $rw[7];
                                  $arrGrade[] = $rw[3];
                                  $arrRset[]=$rec;
                                  $rec="";
                                  $tc+=1;
                                  $tcc += $rw[2];
                                  $ttcc += $rw[2];
                                    if($rw[3]<>"F"){
                                      $p_crs[]=$rw[0];
                                    }
                                    if($rw[5]>0){
                                      $tce += $rw[2];
                                      $ttce += $rw[2];
                                    }
                                    $tgp+= $rw[5];
                                    $ttgp+= $rw[5];
                                  }


                                  if ($tce>0){
                                    $gpa = number_format($tgp/$tcc,"2");
                                    $cgpa = number_format($tgp/$tcc,"2");
                                  }
                                  switch ($gpa){
                                   case ($gpa<1.5):
                                    $gclass ="Probation";
                                    break;
                                  case ($gpa<2.5):
                                    $gclass ="3<sup>rd</sup> Class";
                                    break;
                                  case ($gpa<3.5):
                                    $gclass ="2nd Class <i class = \"fa fa-long-arrow-down\"></i>";
                                    break;
                                  case ($gpa<4.5):
                                    $gclass ="2nd Class <i class = \"fa fa-long-arrow-up\"></i>";
                                    break;
                                  case ($gpa>=4.5):
                                  $gclass ="1st Class";
                                  }
                                   //$stmt->closeCursor();
                                   $stmt=null;
                                   $conn=null;
                                   asort($arrBatchNo);
                                   $result = array_values(array_unique($arrBatchNo));

                                   if ($ceductgid!=="PSZ")
                                   {
                                     if($gpa<3.0)
                                     {
                                       $gclass ="Probation";
                                     }else{
                                       $gclass ="Pass";
                                     }
                                   }
                                   $total = 0;
                                  //print_r($result);
                                  if (array_key_exists('A',array_count_values($arrGrade)))
                                  {
                                    $gradeA= array_count_values($arrGrade)['A'];//$rsult['A'];
                                  }
                                  if (array_key_exists('B',array_count_values($arrGrade)))
                                  {
                                    $gradeB= array_count_values($arrGrade)['B'];;
                                  }

                                  if (array_key_exists('C',array_count_values($arrGrade)))
                                  {
                                    $gradeC= array_count_values($arrGrade)['C'];;
                                  }
                                  if (array_key_exists('D',array_count_values($arrGrade)))
                                  {
                                    $gradeD= array_count_values($arrGrade)['D'];;
                                  }

                                  if (array_key_exists('E',array_count_values($arrGrade)))
                                  {
                                    $gradeE= array_count_values($arrGrade)['E'];;
                                  }

                                  if (array_key_exists("F", array_count_values($arrGrade)))
                                  {
                                    $gradeF= array_count_values($arrGrade)['F'];
                                  }
                                  //$otcr =
                                  //$_SESSION['Returnurl']=enc($_SESSION['Returnurl']);

                              ?>
                            </tbody>
                          </table>
                     </div>
                      <!-- </div> -->
                      <hr>
                      <!-- <div class="row">
                        <div class="col-xs-6">
                          <p class="lead">Result Summary</p>
                          <div class="table-responsive">
                          <table class="table" style="font-size:16px">
                            <tbody>
                            <tr>
                              <th style="width:85%">Cumulative Credit Carried (CCC):</th>
                              <td><?php //echo $tcc;?></td>
                            </tr>
                            <tr>
                              <th>Cumulative Credit Earned (CCE):</th>
                              <td><?php //echo $tce;?></td>
                            </tr>
                            </tbody>
                          </table>
                          </div>
                        </div>

                         <div class="col-xs-6">
                          <p class="lead">Performance Standing:</p>
                          <div class="table-responsive">
                          <table class="table" style="font-size:16px">
                            <tbody>
                              <tr>
                                <th>Cumulative Grade Point Earned:</th>
                                <td><?php //echo $tgp;?></td>
                              </tr>
                              <tr>
                                <th>Cumulative Grade Pont Average (CGPA):</th>
                                <td><?php //echo $gpa;?></td>
                              </tr>
                            </tbody>
                          </table>
                          </div>
                        </div>
                      </div> -->
                     <!-- end table -->
                 </div>
                 <!-- end profile-info -->
             </div>
             <!-- end profile-right -->
         </div>
     </form>
    </div>
   </div>
   </div>
</div>
</div>
   <!-- end col-12 -->
