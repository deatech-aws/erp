<!-- begin #content -->

<div id="content" class="">
  <!-- begin breadcrumb -->

  <div class="row">
    <div class="" style="float:left;position:fixed;width:400px;margin-top: 20%;margin-left:5%">
      <!-- <div class="input-group-btn" style="height:100vh"> -->
      <h2 class="" style="margin-left:0px"> <strong>Search Student </strong> </h2>
      <div class="input-group m-b-20 " style="width:450px" >
        <input id="search-div" type="text" class="form-control input-lg" style="font-weight:bold;font-size:18px" placeholder="Enter Matric No here...">
        <div class="input-group-btn">
            <button id="btn_track" type="button" class="btn btn-success input-lg"><i class="fa fa-search"></i> Search</button>
        </div>
      <!-- </div> -->
    </div>
    <div class="">
        <span class="userimage" style=";position:fixed;bottom:0;margin-bottom:15px"><img src="assets/img/login-bg/Logo-2B3.png" alt="">
    </div>


  </span>

  </div>
    <a href="./" class="btn btn-icon btn-success pull-bottom"  style="margin-top:10px;margin-left:15px;position:fixed"><i class="fa fa-sign-out"></i></a>
<?php
    if(isset($_SESSION['matric_id'])){
    ?>
      <div class="right-content" style="float: right;width: 970px;">

      <ul class="timeline" id="his">

            <!-- <h5 class="text-left" style="margin-left:-120px;position:fixed"> <strong>Name: <?php //echo  $Ptitle; ?></strong> </h5> -->
        <br>
          <li>

              <div class="timeline-time">
                  <span class="date">Academic</span>
                  <span class="time">Result</span>
              </div>
              <div class="timeline-icon active">
                  <a href="javascript:;"><i class="fa fa-2x fa-check"></i></a>
              </div>
              <div class="timeline-body" style="width:650px">
                  <h4 class="text-left" style="p"> <strong>Matric #: <?php echo $_SESSION['matric_id'] ."<br> Name: ". $Ptitle ."<br> Program: ". $prog; ?></strong> </h4>
                  <!-- <br><br> -->
                  <hr>
                  <div class="timeline-content">
                    <div class="table-responsive">
                    <table id="tb_sheet" class="table table-striped table-bordered " style="width:100%!important">
                    <thead>
                   <tr style ="font-size:12px">
                      <th style ="width:10px!important">ID</th>
                      <th> Title</th>
                      <th>Unit</th>
                      <th>Limit</th>
                      <th>Action</th>

                    </tr>
                    </thead>
                      <tbody>
                        <?php
                          include "inc/pdo_connectdb.php";
                        $query ="SELECT r.coursecode,coursetitle,r.creditunit,grade,points,gpoints,batchno,substr(r.coursecode,4,1)*100
                          FROM releasedresults r inner join
                          availablecourse a ON a.coursecode = r.coursecode inner JOIN
                          students s ON s.vMatricNo = r.vMatricNo AND s.vmatricno ='".$_SESSION['matric_id']."'
                          ORDER BY substr(r.coursecode,4,1)
                          ";
                         
                           $query ="SELECT r.coursecode,coursetitle,a.creditunit 
                          FROM resultsheet r INNER JOIN 
                          availablecourse a ON a.coursecode=r.CourseCode AND vMatricNo =='".$_SESSION['matric_id']."'";
                        
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

                            // var_dump($_SESSION['Returnurl']);
                            // exit;

                     $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    //  $stmt->bindParam(':matricno', $_SESSION['matric_id'], PDO::PARAM_STR,4);
                    //  $stmt = $conn->prepare($query);
                          // $stmt->bindParam(':matricno', $_SESSION['Returnurl'], PDO::PARAM_STR,4);
                           $stmt->execute();
                           $k=1;
                    $arrBatchNo = array();
                    $result= array();
                    $arrGrade = array();
                    $arrRset = array();
                    $rec="";

                    //$rw = $stmt->fetch();
                    //$result = $stmt->fetch(PDO::FETCH_ASSOC);
                    //var_dump($result); exit;
                    // echo $query;
                    //      exit;
                         
                    while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                            {
                              $rec = $rw[0]."|".trim($rw[1])."|".$rw[2];
                              // echo  $rec;
                              $stripped = str_replace('\?', '', $rw[1]);
                              $btn="<a class =\"btn btn-success btn-xs\" href =\"#\" download> <i class=\"fa fa-download\"></i> Download </a>";
                              echo"
                              <tr style=\"font-size:12px\">
                                 <td>".$rw[0]."</td>
                                 <td>".$stripped. "</td>
                                 <td>".$rw[2]. "</td>
                                 <td>3</td>
                                 <td>".$btn."</td>

                              </tr>";
                            $arrBatchNo[] = $rw[6];
                            $arrGrade[] = $rw[3];
                            $arrRset[]=$rec;
                            $rec="";
                            $tc+=1;
                            // $ceductgid=$rw[8];
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
                            // $otcr =
                            // $_SESSION['Returnurl']=enc($_SESSION['Returnurl']);

                        ?>
                      <tbody>
                    </table>

                  </div>

              </div>
          </li>
          <li>
              <!-- begin timeline-time -->
              <div class="timeline-time">
                  <span class="date">Summary</span>
                  <span class="time">Statistics</span>
              </div>
              <!-- end timeline-time -->
              <!-- begin timeline-icon -->
              <div class="timeline-icon">
                  <a href="javascript:;"><i class="fa fa-2x fa-check"></i></a>
              </div>
              <!-- end timeline-icon -->
              <!-- begin timeline-body -->

              <div class="timeline-body">
                  <p class="lead" style="">Result Summary</p>
                  <!-- <div class="timeline-header">
                      <span class="userimage"><img src="assets/img/user-2.jpg" alt="" /></span>
                      <span class="username">Darren Parrase</span>
                      <span class="pull-right text-muted">82 Views</span>
                  </div> -->
                  <div class="timeline-content">
                    <div class="profile-section">
                        <!-- begin row -->
                        <div class="row">
                            <!-- begin col-4 -->

                            <!-- end col-4 -->
                            <!-- begin col-4 -->
                            <div class="col-md-12">
                                <!-- <h4 class="title">Failed Courses <small>3 course</small></h4> -->
                                <!-- begin scrollbar -->
                                <div style = "width:100%" class="table-responsive">
                                <table class="table" style="font-size:14px">
                                  <tbody>

                                    <tr>
                                      <th>Total Credit Carried (TCC):</th>
                                      <td id = "stcc" class =""> <?php  echo $tcc ; ?></td>
                                    </tr>

                                    <tr>
                                      <th>Total Credit Earned:</th>
                                      <td id = "tot_ce" class =""><?php  echo $tce ; ?></td>
                                    </tr>
                                    <tr>

                                      <th>Total Grade Point Earned:</th>
                                      <td id = "tot_gp" class =""><?php  echo $tgp ; ?></td>
                                    </tr>

                                    <tr>

                                      <th>Cumulativ Gtade Point Average (CGPA):</th>
                                      <td id = "cgpa" class =""><?php  echo $cgpa ; ?></td>
                                    </tr>

                                  </tbody>
                                </table>
                                </div>
                                <!-- end scrollbar -->

                                <p class="lead" style="">Grade statisitics</p>
                                 

                            </div>
                            <!-- end col-4 -->
                            <!-- begin col-4 -->

                            <!-- end col-4 -->
                        </div>
                        <!-- end row -->
                    </div>
                     </div>
               
              </div>
              <!-- end timeline-body -->
          </li>

          <li>
              <!-- begin timeline-icon -->
              <div class="timeline-time">
                  <span class="date">Previous </span>
                  <span class="time">Courses</span>
              </div>
              <div class="timeline-icon">
                  <a href="javascript:;"><i class="fa fa-spinner"></i></a>
              </div>
              <!-- end timeline-icon -->
              <!-- begin timeline-body -->
              <div class="timeline-body">
                  <!-- Loading... -->
                  <!-- <div class="panel-group m-b-0" id="accordion"> -->
                      <!-- <div class="panel panel-default"> -->

                          <!-- <div id="collapseOne" class="panel-collapse"> -->
                              <!-- <div class="panel-body"> -->
                              <p class="lead" style="">Outstanding Courses</p>
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
                            //       <?php
                            //       include "inc/pdo_connectdb.php";
                            //       $oscr="";
                            //       $out_crs=array_values(array_diff($core_arry,$p_crs));
                            //       if (count($out_crs)>0){
                            //         for ($j=0;$j<=count($out_crs)-1;$j++){
                            //           if($oscr==""){
                            //             $oscr = "'".$out_crs[$j]."'";
                            //           }else{
                            //             $oscr .= ",'".$out_crs[$j]."'";
                            //           }
                            //         }
                            //       }

                            // if ($oscr!=""){
                            // $query ="SELECT coursecode, coursetitle,creditunit,cStatus
                            //         FROM availablecourse
                            //         WHERE coursecode IN($oscr)";
                            //       //echo $query;
                            //       $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            //       $stmt->execute();

                            //       while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                            //       {
                            //         echo "
                            //         <tr>
                            //         <td>".$rw[0]. "</td>
                            //         <td>".$rw[1]. "</td>
                            //         <td>".$rw[2]."</td>
                            //         <td>".$rw[3]."</td>
                            //         </tr>";
                            //       }

                            //       $stmt->closeCursor();
                            //       }
                            //        ?>
                                  </tbody>
                               </table>
                             <!-- </div> -->
                         <!-- </div> -->
                      <!-- </div> -->
                    <!-- </div> -->
              </div>
              <!-- begin timeline-body -->
          </li>
      </ul>
      <!-- end timeline -->
    </div>

    </div>
  <?php
  }
  ?>

</div>
</div>
<!-- end #content -->
