<!-- begin #content -->
<?php
$query="SELECT DISTINCT coursecode,creditunit,CONCAT(SUBSTRING(Coursecode,4,1),'00')
    FROM resultsheet r INNER JOIN
    students s ON s.vMatricNo=r.vMatricNo
    AND cprogrammeid ='4202' AND ilevel='400'
    ORDER BY SUBSTRING(Coursecode,4,1) desc
    ";
$l_course=array();
$o_courses=array();
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->execute();
while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
  if ($rw[3]=400){
    $l_course[]=$rw[0];
  }else{
    $o_course[]=$rw[0];
  }
}
$stmt->closeCursor();
$l_query="";
$o_query="";
for($i = 0;($i<=count($l_course)-1);$i++){
$l_query.="SUM(CASE  WHEN coursecode='$l_course[$i]' THEN tscore END) AS '$l_course[$i]',";
}

for ($i = 0;($i<=count($o_course)-1);$i++){
$o_query.="SUM(CASE  WHEN coursecode='$o_query[$i]' THEN tscore END) AS '$o_query[$i]',";
}
$query="SELECT r.vmatricno,
$l_query
$o_query
";
// echo $query;
// SUM(CASE  WHEN coursecode='BIO301' THEN tscore END)  'BIO301',
// SUM(CASE  WHEN coursecode='BIO303' THEN tscore END)  'BIO303',
// SUM(CASE  WHEN coursecode='BIO311' THEN tscore END)  'BIO311',
// SUM(CASE  WHEN coursecode='BIO412' THEN tscore END)  'BIO412',
// SUM(CASE  WHEN coursecode='BIO411' THEN tscore END)  'BIO411',
// SUM(CASE  WHEN coursecode='EDU421' THEN tscore END)  'EDU421',
// SUM(CASE  WHEN coursecode='EDU423' THEN tscore END)  'EDU423',
// SUM(CASE  WHEN coursecode='BIO413' THEN tscore END)  'BIO413',
// SUM(CASE  WHEN coursecode='EDU332' THEN tscore END)  'EDU332',
// SUM(CASE  WHEN coursecode='EDU412' THEN tscore END)  'EDU412',
// SUM(CASE  WHEN coursecode='SED413' THEN tscore END)  'SED413',
// SUM(CASE  WHEN coursecode='BIO403' THEN tscore END)  'BIO403',

$query ="SELECT
    COUNT(CASE WHEN CGPA  BETWEEN 0 AND 1.49 THEN r.vMatricNo END) AS Fail,
    COUNT(CASE WHEN CGPA  BETWEEN 1.5 AND 2.49 THEN r.vMatricNo END) AS Third_Class,
    COUNT(CASE WHEN CGPA  BETWEEN 2.5 AND 3.49 THEN r.vMatricNo END) AS Second_Class_lower,
    COUNT(CASE WHEN CGPA  BETWEEN 3.5 AND 4.49 THEN r.vMatricNo END) AS Second_Class_upper,
    COUNT(CASE WHEN CGPA  BETWEEN 4.5 AND 5 THEN r.vMatricNo END) AS First_Class
    FROM released_summary r ";

$query="SELECT SUM(fail) AS fail,
    SUM(third_class) AS third_class,
    SUM(sec_lower) AS sec_lower,
    SUM(sec_upper)AS sec_upper,
    SUM(first_class)AS first_class
    FROM class_of_degree
    WHERE cfacultyid='".$_SESSION['fac_id']."'";

$query="SELECT
    	SUM(fail) AS fail,SUM(third_class) AS third_class,
    	SUM(sec_lower) AS sec_lower,
    	SUM(sec_upper)AS sec_upper,
    	SUM(first_class)AS first_class
    FROM prog_class_of_degree
    GROUP BY cprogrammeid
    HAVING cprogrammeid='".$_SESSION['prog_id']."'";

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
  }
  $stmt->closeCursor();
 ?>
<div id="content" class="content" style="margin-top:30px">
  <!-- begin breadcrumb -->
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active">Dashboard</li>
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
      <!-- <div class="panel panel-inverse" data-sortable-id="index-1"> -->

        <div class="">
          <div class="table-responsive" >
          <table id="tbl_rst" class="table table-bordered table-striped " >
            <thead>
              <tr style="font-size:12px">
                <th>#</th>
                <th style="width:60px">Matric No</th>
                <th>BIO412</th>
                <th>BIO411</th>
                <th>EDU421</th>
                <th>BIO412</th>
                <th>EDU423</th>
                <th>BIO413</th>
                <th>EDU332</th>
                <th>EDU412</th>
                <th>BIO403</th>
                <th>BIO301</th>
                <th>BIO303</th>
                <th>BIO311</th>
                <th>GPA</th>
                <th>CGPA</th>
                <th>TCC</th>
                <th>TCE</th>
                <th>Outstanding</th>
              </tr>
            </thead>
            <tbody>
        <?php
//22282999476
        $query="SELECT s.vname,
              SUM(CASE  WHEN coursecode='BIO412' THEN tscore END)  'BIO412',
              SUM(CASE  WHEN coursecode='BIO411' THEN tscore END)  'BIO411',
              SUM(CASE  WHEN coursecode='EDU421' THEN tscore END)  'EDU421',
              SUM(CASE  WHEN coursecode='EDU423' THEN tscore END)  'EDU423',
              SUM(CASE  WHEN coursecode='BIO413' THEN tscore END)  'BIO413',
              SUM(CASE  WHEN coursecode='EDU332' THEN tscore END)  'EDU332',
              SUM(CASE  WHEN coursecode='EDU412' THEN tscore END)  'EDU412',
              SUM(CASE  WHEN coursecode='SED413' THEN tscore END)  'SED413',
              SUM(CASE  WHEN coursecode='BIO403' THEN tscore END)  'BIO403',
            	SUM(CASE  WHEN coursecode='BIO301' THEN tscore END)  'BIO301',
            	SUM(CASE  WHEN coursecode='BIO303' THEN tscore END)  'BIO303',
            	SUM(CASE  WHEN coursecode='BIO311' THEN tscore END)  'BIO311',
              r.vmatricno
            FROM resultsheet r inner join
            students s on s.vmatricno=r.vmatricno
            GROUP BY r.vmatricno,s.vname,cprogrammeid,iyrlevel
            HAVING cprogrammeid ='4201'";

          $query="SELECT r.vmatricno,
            	SUM(CASE  WHEN coursecode='BIO301' THEN tscore END)  'BIO301',
            	SUM(CASE  WHEN coursecode='BIO303' THEN tscore END)  'BIO303',
            	SUM(CASE  WHEN coursecode='BIO311' THEN tscore END)  'BIO311',
            	SUM(CASE  WHEN coursecode='BIO412' THEN tscore END)  'BIO412',
            	SUM(CASE  WHEN coursecode='BIO411' THEN tscore END)  'BIO411',
            	SUM(CASE  WHEN coursecode='EDU421' THEN tscore END)  'EDU421',
            	SUM(CASE  WHEN coursecode='EDU423' THEN tscore END)  'EDU423',
            	SUM(CASE  WHEN coursecode='BIO413' THEN tscore END)  'BIO413',
            	SUM(CASE  WHEN coursecode='EDU332' THEN tscore END)  'EDU332',
            	SUM(CASE  WHEN coursecode='EDU412' THEN tscore END)  'EDU412',
            	SUM(CASE  WHEN coursecode='SED413' THEN tscore END)  'SED413',
            	SUM(CASE  WHEN coursecode='BIO403' THEN tscore END)  'BIO403',
                TCC, TCE, CGPE,r.vmatricno
            FROM resultsheet r inner join
            cum_result_summary s on s.vmatricno=r.vmatricno
            GROUP BY r.vmatricno,cprogrammeid,iYrlevel
            HAVING cprogrammeid='4202'";

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
                       for ($i = 0;($i<=4);$i++){
                         if(!is_null($rw[$i])){
                          $rtotal +=$rw[$i];
                          }
                        }


                     echo "<tr>
                          <td>$j</td>
                           <td  style=\"font-size:12px\">
                           <div class = \"view_result\">
                             <a href=\"fac_sess.php?Returnurl=".enc($rw[0])."\" target =\"_blank\"><b> ".$rw[0]."</b></a>
                             <div class =\"pull-bottom\">
                             <a class = \"viewresult btn btn-success btn-xs\" target = \"_blank\" href = \"#\" >View Result Sheet</a>
                             </div>
                            </div>
                           </td>";
                      echo "
                         <td>".$rw[1]." ".generate_grade($rw[1])."</td>
                         <td>".$rw[2]." ".generate_grade($rw[2])."</td>
                         <td>".$rw[3]." ".generate_grade($rw[3])."</td>
                         <td>".$rw[4]." ".generate_grade($rw[4])."</td>
                         <td>".$rw[5]." ".generate_grade($rw[5])."</td>
                         <td>".$rw[6]." ".generate_grade($rw[6])."</td>
                         <td>".$rw[7]." ".generate_grade($rw[7])."</td>
                         <td>".$rw[8]." ".generate_grade($rw[8])."</td>
                         <td>".$rw[9]." ".generate_grade($rw[9])."</td>
                         <td>".$rw[10]." ".generate_grade($rw[10])."</td>
                         <td>".$rw[11]." ".generate_grade($rw[11])."</td>
                         <td>".$rw[12]." ".generate_grade($rw[12])."</td>
                         <td>0</td>
                         <td>".number_format($rw[15]/$rw[13],"2")."</td>
                         <td>".$rw[13]."</td>
                         <td>".$rw[14]."</td>
                         <td>0</td>

                       </tr>";

                     }
                 ?>
            </tbody>

          </table>
        </div>
        </div>
        <!-- </div> -->
      </div>
      <!--  -->
    </div>
    <!-- end col-4 -->
  </div>
  <hr>
  <br>
  <!-- end row -->

<!-- end #content -->
