<!-- begin #content -->
		<div id="content" class="content" style="margin-top:15px" >
      
			<h1 class="page-header">Academic Performance  <small>header small text goes here...</small></h1>
			<!-- end page-header -->
			<!-- begin profile-container -->
            <div class="profile-container">
                <!-- begin profile-section -->
                <div class="profile-section">
                    <!-- begin profile-left -->
                    <div class="profile-left">
                        <!-- begin profile-image -->
                        <div class="x_content">
                          <div class="profile_left">
                            <div class="profile_img" style="margin-left:0px">
                              <div id="crop-avatar">
                                <!-- Current avatar -->
                                <img class="media-object rounded-corner" src="assets/img/user.png" alt="Avatar" title="Change the avatar">
                              </div>
                            </div>
                            <h4 class="text-center" style="margin-left:0px"><?php echo $Ptitle;?></h4>
                            <h4 class="text-center" style="margin-left:0px"><?php echo $_SESSION['Returnurl'];?></h4>
                            <h4 class="text-center" style="margin-left:0px"><?php echo $stcentre;?></h4>

<!--  -->
                            <!-- <h5 id ="cgpa" class="lead text-center" style=""> </h5> -->
                            <h5  class="text-center" style="margin-left:10px"><i class="fa fa-mortar-board"></i> <?php echo $prog;?></h5>
                            <h4  class="text-center" style="margin-left:10px"> <?php echo $cLevel;?> Level</h4>

                            <h4  class="text-center" style="margin-left:10px"> <?php echo $mode;?> Entry</h4>
<hr>
                            <h5  class="text-center" ><i class="fa fa-envelope">: </i><?php echo $email;?></h5>
                            <h5  class="text-center"><i class="fa fa-phone">: </i><?php echo $phon;?></h5>

<hr>
                            <!-- <h2 id ="cgpa" class="text-center" > </h2> -->
                            <p class="lead" style="">Grade statisitics</p>
                            <div style = "width:100%" class="table-responsive">
                            <table class="table" style="font-size:16px">
                              <tbody>
                              <tr>
                              <th >A-Grade:</th>
                                <td id = "gd_a" class ="pull-right"></td>
                              </tr>
                              <tr>
                                <th>B- Grade:</th>
                                <td id = "gd_b" class ="pull-right"></td>
                              </tr>
                              <tr>
                                <th>C-Grade:</th>
                                <td id = "gd_c" class ="pull-right"></td>
                              </tr>
                              <tr>
                                <th>D-Grade:</th>
                                <td id = "gd_d" class ="pull-right"></td>
                              </tr>
                              <tr>
                                <th>E-Grade:</th>
                                <td id = "gd_e" class ="pull-right"></td>
                              </tr>
                              <tr>
                                <th>F-Grade:</th>
                                <td id = "gd_f" class ="pull-right">7</td>
                              </tr>
                              </tbody>
                            </table>
                            </div>
                          </div>
                            </div>
                        <!-- end profile-highlight -->
                    </div>
                    <!-- end profile-left -->
                    <!-- begin profile-right -->
                    <div class="profile-right">
                        <!-- begin profile-info -->
                        <div class="profile-info">
                          <!-- <div class="col-sm-12 col-sm-12 col-sm-16"> -->
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
                           <!-- </div> -->
                            <!-- begin table -->
                            <div class="table-responsive" data-scrollbar="true" style="height:750px">
                                <div class="" >
                                  <table id="tb_sheet" class="table table-striped table-bordered" style="width:100%!important">
                                  <thead>
                                  <tr style ="font-size:11px">
                                    <th style ="width:0px!important">ID</th>
                                    <th>Course Title</th>
                                    <th>Unit</th>
                                    <th>Grade</th>
                                    <th>Point</th>
                                    <th align = "right">GPoint</th>
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
                                          $pass=0;

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
                                            <tr style=\"font-size:12px\">

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
                                          $pass=$gradeA+$gradeB+$gradeC+$gradeD+$gradeE;
                                          //$otcr =
                                          //$_SESSION['Returnurl']=enc($_SESSION['Returnurl']);

                                      ?>
                                    </tbody>
                                  </table>
                             </div>
                              <!-- </div> -->
                              <!-- <hr> -->

                         </div>
                            <!-- end table -->
                        </div>
                        <!-- end profile-info -->
                    </div>
                    <!-- end profile-right -->
                </div>
                <hr style="margin-top:0px">
                <!-- end profile-section -->
                <p class="lead">Summary Statistics</p>
                <!-- begin profile-section -->
                <div class="profile-section">
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-4 -->
                        <div class="col-md-6">
                            <!-- <h4 class="title">Passed Courses <small>56 Courses</small></h4> -->
                            <!-- begin scrollbar -->
                            <div style = "width:100%" class="table-responsive">
                            <table class="table" style="font-size:14px">
                              <tbody>
                              <tr>
                              <th >Courses Taken:</th>
                                <td id = "tot_c" class ="pull-right"></td>
                              </tr>
                              <tr>
                                <th>Courses Passed</th>
                                <td id = "tot_pss" class ="pull-right"><?php echo $pass; ?></td>
                              </tr>
                              <tr>
                                <th>Courses Failed</th>
                                <td id = "tot_dc" class ="pull-right"><?php echo $gradeF; ?></td>
                              </tr>


                              </tbody>
                            </table>
                            </div>
                            <!-- end scrollbar -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-6">
                            <!-- <h4 class="title">Failed Courses <small>3 course</small></h4> -->
                            <!-- begin scrollbar -->
                            <div style = "width:100%" class="table-responsive">
                            <table class="table" style="font-size:14px">
                              <tbody>
                                <tr>

                                  <th>Min. Credit Required:</th>
                                  <td id = "tot_gc" class ="pull-right"></td>
                                </tr>
                                <tr>
                                  <th>Total Credit Earned (TCE):</th>
                                  <td id = "tot_ce" class ="pull-right"></td>
                                </tr>

                                <tr>
                                  <th>Outstanding Credit:</th>
                                  <td id = "tot_oc" class ="pull-right"></td>
                                </tr>

                              <!-- <tr>
                                <th>Outstanding Credit:</th>
                                <td id = "tot_oc" class ="pull-right"></td>
                              </tr> -->

                              </tbody>
                            </table>
                            </div>
                            <!-- end scrollbar -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->

                        <!-- end col-4 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end profile-section -->
            </div>
			<!-- end profile-container -->
		</div>
		<!-- end #content -->
