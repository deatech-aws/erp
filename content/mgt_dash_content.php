<?php
$query ="SELECT
    COUNT(CASE WHEN CGPA  BETWEEN 0 AND 1.49 THEN r.vMatricNo END) AS Fail,
    COUNT(CASE WHEN CGPA  BETWEEN 1.5 AND 2.49 THEN r.vMatricNo END) AS third_class,
    COUNT(CASE WHEN CGPA  BETWEEN 2.5 AND 3.49 THEN r.vMatricNo END) AS sec_lower,
    COUNT(CASE WHEN CGPA  BETWEEN 3.5 AND 4.49 THEN r.vMatricNo END) AS sec_upper,
    COUNT(CASE WHEN CGPA  BETWEEN 4.5 AND 5 THEN r.vMatricNo END) AS first_class
    FROM released_summary r
    GROUP BY batchno
    HAVING batchno = '".$_SESSION['sess']."'";

  $query ="SELECT SUM(fail) AS fail,SUM(third_class) AS third_class,
  SUM(sec_lower) AS sec_lower,
  SUM(sec_upper)AS sec_upper,
  SUM(first_class)AS first_class
  FROM rst_class_of_degree
  GROUP BY batchno
  HaVING   batchno = '".$_SESSION['sess']."'";

  //echo  $query;
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
    $json_array['label']='Sec. Class Lower';
    $json_array['value']=$rw[2];
    array_push($json_data,$json_array);
    $json_array['label']='Sec. Class Upper';
    $json_array['value']=$rw[3];
    array_push($json_data,$json_array);
    $json_array['label']='First Class';
    $json_array['value']=$rw[4];
    array_push($json_data,$json_array);
  }
  $stmt->closeCursor();
 ?>
<div id="content" class="content" style="margin-top:15px">
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
  <h1 class="page-header"><?php echo $_SESSION['sess'] ?> Semester Overall Result Analytics Dashboard <small>Academic Performance Distribution...</small></h1>
  <!-- end page-header -->
  <div class="row tile_count">
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-users"></i> Total Numbers of Students</span>
                <div class="count text-info"><?php echo number_format($cTotal,"0"); ?></div>
                <span class="count_bottom"><i class="green"> </i> Students Record</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-warning"></i> Students on Probation</span>
                <div class="count text-danger"><?php echo number_format(($fail/$cTotal)*100,"2"); ?>%</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i> <?php echo number_format($fail); ?> </i> Records</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i><b> 3rd Class Division</b></span>
                <div class="count text-warning"><?php echo number_format(($rdC/$cTotal)*100,"2"); ?>%</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($rdC); ?></b></i> Students</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i><b> 2nd Class Lower Division</b></span>
                <div class="count"><?php echo number_format(($ndL/$cTotal)*100,"2"); ?>%</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndL); ?></b></i> Students</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> 2nd Class Upper Division</span>
                <div class="count text-primary"><?php echo number_format(($ndU/$cTotal)*100,"2"); ?>%</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($ndU); ?></b></i> Students</span>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"> First Class Division</i></span>
                <div class="count text-success"><?php echo number_format(($stC/$cTotal)*100,"2"); ?>%</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-graduation-cap"></i><b> <?php echo number_format($stC); ?></b></i> Students</span>
              </div>
            </div>

<hr style="border-top: dotted 3px;margin-top:-20px" />
  <!-- begin row -->
			<!--  -->
			<!-- end row -->
  <!-- begin row -->
  <div class="row">
    <!-- begin col-8 -->
    <div class="col-md-8">
      <div class="panel panel-inverse " data-sortable-id="index-1">
        <div class="panel-heading bg-green">
          <div class="panel-heading-btn ">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h4 class="panel-title responsive"><?php echo $_SESSION['sess'];?> Class of Degree Distribution Chart By Faculty</h4>
        </div>
        <div class="panel-body responsive">
          <div id="echart_line" class="height-sm"></div>
        </div>
      </div>

      <ul id="tabs" class="nav nav-tabs nav-tabs nav-justified nav-justified-mobile " data-sortable-id="index-2">
        <li class="active" ><a href="#latest-post" class="text-black anchor" data-toggle="tab" ><i class="fa fa-graduation-cap m-r-5"></i> <span class="hidden-xs">Class of Degree Distribution Details by Faculty</span></a></li>
        <!-- <li class=""><a href="#purchase" class="text-black anchor" data-toggle="tab"><i class="fa fa-shopping-cart m-r-5"></i> <span class="hidden-xs">Probable Graduating Students By Faculty</span></a></li>
        <li class=""><a href="#email" class="text-black anchor" data-toggle="tab"><i class="fa fa-envelope m-r-5"></i> <span class="hidden-xs">Email</span></a></li> -->
      </ul>
      <div class="tab-content" data-sortable-id="index-3">
        <div class="tab-pane fade active in" id="latest-post">
          <div class="height-sl" data-scrollbar="true">
            <ul class="media-list media-list-with-divider">
              <li class="media media-lg">
              <!-- <a href="javascript:;" class="pull-left">
                  <img class="media-object" src="assets/img/gallery/gallery-1.jpg" alt="" />
                </a> -->
              <!-- <div class="media-body"> -->
                  <div class="responsive" style="overflow-x:auto;">
                  <table id="tbl_fac" class="table table-striped responsive table-valign-middle m-b-0">
                    <thead>
                      <tr style="font-size:12px">
                        <th>Faculty</th>
                        <th>Probation</th>
                        <th>3<sup>rd</sup> Class</th>
                        <th>2<sup>nd</sup> Class <i class="fa fa-long-arrow-down"></i></th>
                        <th>2<sup>nd</sup> Class <i class="fa fa-long-arrow-up"></i></th>
                        <th>1<sup>st</sup> Class </th>
                      </tr>
                    </thead>
                    <tbody>
                <?php


              $query="SELECT c.cfacultyid,vlegend,
                        SUM(fail) AS fail,SUM(third_class) AS third_class,
                        SUM(sec_lower) AS sec_lower,
                        SUM(sec_upper)AS sec_upper,
                        SUM(first_class)AS first_class
          							FROM rst_class_of_degree c INNER JOIN
          							faculty p ON p.cfacultyid=c.cfacultyid
          							GROUP BY p.cfacultyid,vfacultydesc";
                          // echo $query
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
                             echo "<tr style=\"font-size:12px\">
                                   <td style=\"font-size:14px\">
                                     <div class = \"view_result\">
                                      <a href=\"fac_sess.php?Returnurl=".enc($rw[0])."\" ><b> ".$rw[1]."</b></a>
                                     </div>
                                   </td>";

                                   $ZoneStr[]=$rw[1];
                                   $fag[] = number_format(($rw[2]/$rtotal)*100,"2");
                                   $foa[] = number_format(($rw[3]/$rtotal)*100,"2");
                                   $foe[] = number_format(($rw[4]/$rtotal)*100,"2");
                                   $foh[] = number_format(($rw[5]/$rtotal)*100,"2");
                                   $fol[] = number_format(($rw[6]/$rtotal)*100,"2");


                                   echo "
                                   <td>".number_format(($rw[2]/$rtotal)*100,"2")."% (".number_format($rw[2],"0").")</td>
                                   <td>".number_format(($rw[3]/$rtotal)*100,"2")."% (".number_format($rw[3],"0").")</td>
                                   <td>".number_format(($rw[4]/$rtotal)*100,"2")."% (".number_format($rw[4],"0").")</td>
                                   <td>".number_format(($rw[5]/$rtotal)*100,"2")."% (".number_format($rw[5],"0").")</td>
                                   <td>".number_format(($rw[6]/$rtotal)*100,"2")."% (".number_format($rw[6],"0").")</td>


                               </tr>";
                               $rtotal=0;
                             }
                         ?>
                    </tbody>

                  </table>
                  </div>

              </li>

            </ul>
          </div>
        </div>
        <div class="tab-pane fade" id="purchase">
          <div class="height-sm" data-scrollbar="true">
            <table class="table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Total Quantity</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>13/02/2013</td>
                  <td class="hidden-sm">
                    Faculty of Science Material Request of 15/05/2021
                  </td>
                  <td>
                    32,970
                  </td>
                  <td>In Transit</td>
                  <td><a href="javascript:;">Derick Wong</a></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="email">
          <div class="height-sm" data-scrollbar="true">
            <ul class="media-list media-list-with-divider">
              <li class="media media-sm">
                <a href="javascript:;" class="pull-left">
                  <img src="assets/img/user-1.jpg" alt="" class="media-object rounded-corner" />
                </a>
                <div class="media-body">
                  <a href="javascript:;"><h4 class="media-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4></a>
                  <p class="m-b-5">
                    Aenean mollis arcu sed turpis accumsan dignissim. Etiam vel tortor at risus tristique convallis. Donec adipiscing euismod arcu id euismod. Suspendisse potenti. Aliquam lacinia sapien ac urna placerat, eu interdum mauris viverra.
                  </p>
                  <i class="text-muted">Received on 04/16/2013, 12.39pm</i>
                </div>
              </li>
              <li class="media media-sm">
                <a href="javascript:;" class="pull-left">
                  <img src="assets/img/user-2.jpg" alt="" class="media-object rounded-corner" />
                </a>
                <div class="media-body">
                  <a href="javascript:;"><h4 class="media-heading">Praesent et sem porta leo tempus tincidunt eleifend et arcu.</h4></a>
                  <p class="m-b-5">
                    Proin adipiscing dui nulla. Duis pharetra vel sem ac adipiscing. Vestibulum ut porta leo. Pellentesque orci neque, tempor ornare purus nec, fringilla venenatis elit. Duis at est non nisl dapibus lacinia.
                  </p>
                  <i class="text-muted">Received on 04/16/2013, 12.39pm</i>
                </div>
              </li>
              <li class="media media-sm">
                <a href="javascript:;" class="pull-left">
                  <img src="assets/img/user-3.jpg" alt="" class="media-object rounded-corner" />
                </a>
                <div class="media-body">
                  <a href="javascript:;"><h4 class="media-heading">Ut mi eros, varius nec mi vel, consectetur convallis diam.</h4></a>
                  <p class="m-b-5">
                    Ut mi eros, varius nec mi vel, consectetur convallis diam. Nullam eget hendrerit eros. Duis lacinia condimentum justo at ultrices. Phasellus sapien arcu, fringilla eu pulvinar id, mattis quis mauris.
                  </p>
                  <i class="text-muted">Received on 04/16/2013, 12.39pm</i>
                </div>
              </li>
              <li class="media media-sm">
                <a href="javascript:;" class="pull-left">
                  <img src="assets/img/user-4.jpg" alt="" class="media-object rounded-corner" />
                </a>
                <div class="media-body">
                  <a href="javascript:;"><h4 class="media-heading">Aliquam nec dolor vel nisl dictum ullamcorper.</h4></a>
                  <p class="m-b-5">
                    Aliquam nec dolor vel nisl dictum ullamcorper. Duis vel magna enim. Aenean volutpat a dui vitae pulvinar. Nullam ligula mauris, dictum eu ullamcorper quis, lacinia nec mauris.
                  </p>
                  <i class="text-muted">Received on 04/16/2013, 12.39pm</i>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
    <!-- end col-8 -->
    <!-- begin col-4 -->
    <div class="col-md-4">


      <div class="panel panel-inverse" data-sortable-id="index-7">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h4 class="panel-title">Class of Degree Pie Chart</h4>
        </div>
        <div class="panel-body">
          <!-- <div id="donut-chart" class="height-sm"></div> -->
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

      <div class="panel panel-inverse" data-sortable-id="index-6">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h4 class="panel-title">Probable 1<sup>st</sup> Class Graduant By Faculty </h4>
        </div>
        <div class="panel-body p-t-0 ">
          <div style="overflow-x:auto;">
          <table id="tbl_zone" class="table table-striped table-valign-middle m-b-0" >
            <thead>
              <tr style="font-size:12px">
                <th>ID</th>
                <th>Faculty</th>
                <th>Count</th>
                <!-- <th>2<sup>nd</sup> Class <i class="fa fa-long-arrow-down"></i></th>
                <th>2<sup>nd</sup> Class <i class="fa fa-long-arrow-up"></i></th>
                <th>1<sup>st</sup> Class </th> -->


              </tr>
            </thead>
            <tbody>
        <?php

      $query="SELECT f.cfacultyid, vfacultydesc,SUM(tot) AS Tot
              FROM tbl_best_result t inner join
              faculty f ON f.cfacultyid = t.cfacultyid
              GROUP BY f.cfacultyid, vfacultydesc";
                                // echo $query
                   $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                   $stmt->execute();
                   $j=0;

                     while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                     {
                       $j++;
                     echo "<tr style=\"font-size:12px\">
                           <td>$rw[0]</td>
                           <td style=\"font-size:14px\">
                             <div class = \"view_result\">
                              <a href=\"fac_sess.php?Returnurl=".enc($rw[0])."\" ><b> ".$rw[1]."</b></a>
                             </div>
                           </td>

                            <td>$rw[2]</td>
                          </tr>";




                       $rtotal=0;
                     }
                 ?>
            </tbody>

          </table>
          </div>
        </div>
      </div>
    </div>
    <!-- end col-4 -->
  </div>
  <!-- end row -->
</div>
<!-- end #content -->
