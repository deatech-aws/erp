
<?php

 ?>
<!-- begin #content -->
<div id="content" class="content" style="margin-top:30px">
	<!-- begin breadcrumb -->
	<!-- <ol class="breadcrumb hidden-print pull-right">
		<li><a href="#">Home</a></li>
		<li class="active">SOR</li>
	</ol> -->
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<!-- <h1 class="page-header hidden-print">Store Issue Voucher <small>Processing issue voucher</small></h1> -->
	<h1 class="page-header hidden-print" >Student Academic Performance <small>Student's Statement of Result...</small></h1>
	<!-- end page-header -->
<div class="" data-id="widget">

	<!-- begin vertical-box -->
	<div class="vertical-box with-grid with-border-top panel">
		<!-- begin vertical-box-column -->
		<!-- <div class="vertical-box-column widget-chart-content "> -->

	     <br>
	     <div class="invoice" style="background-color:#e6ecf1!important">
						<div class="invoice-company">
              <span class="pull-right hidden-print">
              <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a>
              <a id="btn_print" href="javascript:;"  class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
              <!-- <a id="btn_print" href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a> -->
              </span>
                <h1 class="text-center"><strong>STATEMENT OF RESULT <br><small> <b><?php echo $Ptitle; ?></b> </small> </strong></h1>
						</div>
            <div class="invoice-header">
								<div class="invoice-from">
										<!-- <small>Generated from</small> -->
										<address class="m-t-5 m-b-5">
												<strong>Program: <?php echo $prog; ?></strong><br />
												<strong>Matric No: <?php echo $_SESSION['Returnurl']; ?></strong><br />
                        <strong>Center: <?php echo $stcentre; ?></strong>

										</address>
								</div>

								<div class="invoice-date">
										<!-- <small> Info:</small> <br> -->
										<strong>SOR Date: <?php echo $ddate; ?></strong>
                    <div class="invoice-detail">
											<strong>	Entry Mode: <?php echo $mode; ?></strong>
										</div>
										<div class="date m-t-5">Level: <?php echo $cLevel ?></div>
										
								</div>
						</div>

						<div class="invoice-content ">
								<div class="table-responsive hidden-print">
										<table id="tbl_bin" class="table table-striped">
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
                            AND r.vMatricNo =:matricno where r.vMatricNo NOT in (select vMatricNo from misconduct_list)";

                          // echo $SQL;
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
                                $stripped = str_replace('\?', '', trim($rw[1]));
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
                                case ($gpa<1.0):
                                $gclass ="Probation";
                                break;
                               case ($gpa<1.5):
                                $gclass ="Pass";
                                break;
                              case ($gpa<2.4):
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
                                 if($gpa<2.5)
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

                    <!-- begin profile-section -->
                    <div class="profile-section">
                        <!-- begin row -->
                        <div class="row">
                          <h3 class="lead" style="margin-left:15px">Summary Statistics</h3>
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
                                  <tr>
                              <th>Current Class of Degree:</th>
                              <td id = "t_class" class ="pull-right" style="font-size:18px;font-weight:bold"><?php echo $gclass; ?></td>
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
                                    <tr>
                              <th>Cumulative Gradepoint Average (CGPA):</th>
                              <td id = "t_cgpa" class ="pull-right" style="font-size:18px;font-weight:bold"><?php echo $cgpa; ?></td>
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
								   </div>

				          </div>
                	<!-- end invoice -->


                </div>

            <!-- </div> -->
            <div class="panel vertical-box-column p-15 hidden-print"  style="width: 33%;padding-left:5px">
              <div data-scrollbar="true" style="overflow: hidden; width: auto; height:auto;">
                <!-- <h3 id ="cgpa" class=" text-center"> Student's Profile </h3> -->
                <div class="x_content">
                  <div class="profile_left">
                    <!-- <div class="profile_img text-center" style="margin-left:0px">
                      <div id="crop-avatar">

                        <img class="media-object rounded-corner " src="assets/img/user.png" alt="Avatar" title="Change the avatar">
                      </div>
                    </div>
                    <h4 class="text-center" style="margin-left:0px"><?php //echo $Ptitle;?></h4>
                    <h4 class="text-center" style="margin-left:0px"><?php //echo $_SESSION['Returnurl'];?></h4>
                    <h4 class="text-center" style="margin-left:0px"><?php //echo $stcentre;?></h4>
  -->
                    <!-- <h5 id ="cgpa" class="lead text-center" style=""> </h5> -->
                    <!-- <h5  class="text-center" style="margin-left:10px"><i class="fa fa-mortar-board"></i> <?php echo $prog;?></h5>
                    <h4  class="text-center" style="margin-left:10px"> <?php //echo $cLevel;?> Level</h4>

                    <h4  class="text-center" style="margin-left:10px"> <?php //echo $mode;?> Entry</h4>
<hr>
                    <h5  class="text-center" ><i class="fa fa-envelope">: </i><?php //echo $email;?></h5>
                    <h5  class="text-center"><i class="fa fa-phone">: </i><?php //echo $phon;?></h5> -->

<!-- <hr> -->
                  <h3 class="lead" style="margin-left:15px">Performance Standing</h3>
                      <!-- begin col-4 -->
                      <!-- <div class="col-md-6"> -->
                          <!-- <h4 class="title">Passed Courses <small>56 Courses</small></h4> -->
                          <!-- begin scrollbar -->
                          <div style = "width:100%" class="table-responsive">
                          <table class="table" style="font-size:14px">
                            <tbody>
                            <tr>
                            <th >Total Credit Carried (TCC):</th>
                              <td id = "tot_cc" class ="pull-right"><?php echo $tcc; ?></td>
                            </tr>
                            <tr>
                              <th>Total Credit Earned (TCE):</th>
                              <td id = "tot_tce" class ="pull-right" ><?php echo $tce; ?></td>
                            </tr>
                            <tr>
                              <th>Cumulative Gradepoint Average (CGPA):</th>
                              <td id = "t_cgpa" class ="pull-right" style="font-size:18px;font-weight:bold"><?php echo $cgpa; ?></td>
                            </tr>
                            <tr>
                              <th>Current Class of Degree:</th>
                              <td id = "t_class" class ="pull-right" style="font-size:18px;font-weight:bold"><?php echo $gclass; ?></td>
                            </tr>

                            </tbody>
                          </table>
                          </div>
                          <!-- end scrollbar -->
                      <!-- </div> -->
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
                <br>
              <div class="panel-group m-b-0" id="accordion">
                  <div class="panel panel-default">
                      <div class="panel-heading ">
                          <h3 class="panel-title">
                              <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" style="height:40px">
                                  <i class="fa fa-plus-circle pull-right text-success"></i>
                                  <h4 class="" style="margin-top:-3px">Outstanding Courses</h4>
                              </a>
                          </h3>
                      </div>
                      <div id="collapseOne" class="panel-collapse">
                          <div class="panel-body">
                          <table id="tbl_os" class="table table-striped hidden-print bg-black-transparent-2" style="font-size:12px">
                            <thead>
                              <tr>
                                <th style="font-size:16px"><b>Code</b></th>
                                <th><b>Course Title</b></th>
                                <th><b>Unit</b></th>
                                <th><b>Status</b></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              include "inc/pdo_connectdb.php";
                              $oscr="";
                              $out_crs=array_values(array_diff($core_arry,$p_crs));
                              if (count($out_crs)>0){
                                for ($j=0;$j<=count($out_crs)-1;$j++){
                                  if($oscr==""){
                                    $oscr = "'".$out_crs[$j]."'";
                                  }else{
                                    $oscr .= ",'".$out_crs[$j]."'";
                                  }
                                }
                              }
                                if ($oscr!=""){
                              $query ="SELECT coursecode, coursetitle,creditunit,cstatus
                                FROM availablecourse
                                WHERE coursecode IN($oscr) ";
                              //echo $query;
                              $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                              $stmt->execute();

                              while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                              {
                                echo "
                                <tr>
                                <td>".$rw[0]. "</td>
                                <td>".$rw[1]. "</td>
                                <td>".$rw[2]."</td>
                                <td>".$rw[3]."</td>
                                </tr>";
                              }

                              $stmt->closeCursor();
                                }
                               ?>
                              </tbody>
                           </table>
                         </div>
                     </div>
                  </div>
                </div>
              <hr>
              </div>
              </div>
          </div>

        </div>
      </div>
  <!-- end #content -->
