<!-- begin #content -->
<div id="content" class="content" style="margin-top:-35px" >
<!-- begin profile-container -->
<div class="profile-container">

	<div class="invoice-header">
		<div class="image text-center" style="margin-top:0px">
			<a href="javascript:;"><img src="assets/img/nlogo.png" alt="" class="center" style="width:20%"/></a>
		</div>
		<h1 class="text-center"> <strong>NATIONAL OPEN UNIVERSITY OF NIGERIA</strong> </h1>
			<h4 class="text-center"> <strong>PLOT 91, CADASTRAL ZONE, NNAMDI AZIKIWE EXPRESS WAY, JABI-ABUJA</strong> </h4>
			<h4 class="text-center"><strong>(OFFICE OF THE REGISTRAR)</strong></h4>
		<h3 class="text-center"><strong>STUDENT'S ACADEMIC TRANSCRIPT</strong></h3>
			<div class="invoice-from">
					<!-- <small>Generated from</small> -->
					<address>
							<strong>Matric No: <?php echo $id; ?></strong><br />
							<strong>Name: <?php echo $Ptitle; ?></strong><br />
							<strong>Faculty:  Faculty of <?php echo $faculty; ?></strong><br />
							<strong>Program: <?php echo $prog; ?></strong>

					</address>
			</div>

			<div class="invoice-from pull-right" style="margin-right:-520px;width:750px;margin-top:-110px">
					<!-- <small>Generated from</small> -->
					<address>
							<strong>Date: <?php echo $ddate; ?></strong><br />
							<strong>Date of Birth: <?php echo $dob; ?></strong><br />
							<strong>Exit Year: <?php echo Date("Y",strtotime(NOW)); ?></strong><br />
							<!-- <strong>Program: <?php //echo $prog; ?></strong> -->

					</address>
			</div>
  <div class="profile-section">

      <!-- <div class="profile-right"> -->
          <!-- begin profile-info -->
          <div class="profile-info">

              <!-- begin table -->
							<div class="">


              <div class="table-responsive">
                  <div class="" >
                    <table id="tb_sheet" class="table table-striped table-bordered myTableBg4" style="width:100%!important">
                    <thead>
                    <tr style ="font-size:11px">
											<th colspan="6">
                      <div class="invoice-note" style="margin-top:0px">
                        * This Transcript is Address To: [Institution Name]<br />
                        * All listed courses were thought in English Language<br />
                        * If you have any questions concerning this Transcript, contact  [Name, Phone Number, Email]
                    </div>
                    <div id="tbl_content" class="pull-right">
                    <div id="pageFooter"> </div>  
                  </div>
                      </th>                                     
                    </tr>
                    <tr style ="font-size:11px">
											<th>Level</th>
                      <th style ="width:0px!important">ID</th>
                      <th>Course Title</th>
                      <th>Grade</th>
                      <th>Units</th>
                      <th>Remarks</th>
                      
                    </tr>

                    </thead>
                      <tbody>
                        <?php
						include "inc/pdo_connectdb.php";
						$query ="SELECT r.coursecode,coursetitle,grade,r.creditunit,points,gpoints,
                CASE  
                WHEN grade='A' THEN 'Excellent'
                WHEN grade='B' THEN 'Very Good'
                WHEN grade='C' THEN 'Good' 
                WHEN grade='D' THEN 'Fair' 
                WHEN grade='E' THEN 'Pass' 
                ELSE 'Fail' END AS remark, batchno,substr(r.coursecode,4,1)*100
                FROM releasedresults r inner join
                availablecourse a ON a.coursecode = r.coursecode  AND vmatricno =:matricno
							  ORDER BY substr(r.coursecode,4,1)
							";
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

                    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                          $stmt->bindParam(':matricno', $_SESSION['Returnurl'], PDO::PARAM_STR,4);
                           $stmt->execute();
                           $k=1;
                    $arrBatchNo = array();
                    $result= array();
                    $arrGrade = array();
                    $arrRset = array();
                    $rec="";
                    $grade="";
                    while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                            {
                              $rec = $rw[0]."|".trim($rw[1])."|".$rw[2]."|".$rw[3]."|".$rw[4]."|".$rw[5]."|".$rw[6];
                              $stripped = str_replace('\?', '', $rw[1]);
                            
                              echo"
                              <tr style=\"font-size:12px\">

																 <td>".$rw[8]."</td>
																 <td>".$rw[0]."</td>
                                 <td>".$stripped. "</td>
                                 <td>".$rw[2]. "</td>
                                 <td>".$rw[3]."</td>
                                 <td>".$rw[6]."</td>
                                

                              </tr>";
                            $arrBatchNo[] = $rw[6];
                            $arrGrade[] = $rw[3];
                            $arrRset[]=$rec;
                            $rec="";
                            $tc+=1;
                            $tcc += $rw[3];
                            $ttcc += $rw[3];
                              if($rw[3]<>"F"){
                                $p_crs[]=$rw[0];
                              }
                              if($rw[5]>0){
                                $tce += $rw[3];
                                $ttce += $rw[3];
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
										<p  class="lead" style="margin-top:35px">Summary Statistics</p>
									  <!-- begin profile-section -->
									  <div class="profile-section">
									      <!-- begin row -->
									      <div class="row">
									          <!-- begin col-4 -->

									          <!-- end col-4 -->
									          <!-- begin col-4 -->
									          <div class="col-md-6">
									              <!-- <h4 class="title">Failed Courses <small>3 course</small></h4> -->
									              <!-- begin scrollbar -->
									              <div style = "width:100%" class="table-responsive">
									              <table class="table" style="font-size:14px">
									                <tbody>

									                  <tr>
									                    <th>Total Credit Carried (TCC):</th>
									                    <td id = "stcc" class =""></td>
									                  </tr>

									                  <tr>
									                    <th>Total Credit Earned:</th>
									                    <td id = "tot_ce" class =""></td>
									                  </tr>
																		<tr>

																			<th>Total Grade Point Earned:</th>
																			<td id = "tot_gp" class =""></td>
																		</tr>

																		<tr>

																			<th>Cumulativ Gtade Point Average (CGPA):</th>
																			<td id = "cgpa" class =""></td>
																		</tr>

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
							 <!-- <br> -->
							 <!-- <br>
							 <br> -->
                <!-- </div> -->
                <!-- <hr> -->
								<!-- <div class="invoice-note" style="margin-top:0px">
					           * Make all cheques payable to [Your Company Name]<br />
					           * Payment is due within 30 days<br />
					           * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
					       </div>-->
					      <div class="invoice-footer text-muted">
					          <!-- <p class="text-center m-b-5">
					               THANK YOU FOR YOUR BUSINESS
					           </p> -->
					          <p class="text-center">
					              <span class="m-r-10"><i class="fa fa-globe"></i> www.nou.edu.ng</span>
					              <span class="m-r-10"><i class="fa fa-phone"></i> T:+234-0802629830 </span>
					              <span class="m-r-10"><i class="fa fa-envelope"></i> registrar@noun.edu.ng</span>
					          </p>
					      </div>

           </div>
					 </div>
              <!-- end table -->
          </div>
          <!-- end profile-info -->
      <!-- </div> -->
      <!-- end profile-right -->

  </div>
  <!-- <hr style="margin-top:0px"> -->
  <!-- end profile-section -->

</div>
<!-- end profile-container -->
</div>
<!-- end #content -->
