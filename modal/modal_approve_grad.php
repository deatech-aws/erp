<!-- #modal-dialog -->
<div class="modal left fade" id="modal_grad_approved">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info modal-lg" role= "document" >
  <!-- <div class="modal-dialog modal-ml" style="width:65%;"> -->
		<div class="modal-content">
			<div class="modal-header">
      <div class="invoice-company">
              <span class="pull-right hidden-print">
              <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a>
              <a id="btn_print" href="javascript:;"  class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
              <!-- <a id="btn_print" href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a> -->
              </span>
			  </div>
        <h4><b>YOU ARE VIEWING:</b><?php echo $prog_desc; ?></h4>
        
				<h3 id ="issue_title" class="modal-title" style="margin-top:-10px">APPROVED PROBABLE GRADUANT LIST</h3>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top:-30px">×</button>
			</div>
			<div class="modal-body">
      <fieldset>
				<table id="tbl_gp" class="table table-striped ">
					<thead>
						<tr>
							<th style="width:20px">Matric No</th>
							<th style="width:150px">Name</th>
							<th style="width:20px">Center</th>
							<th style="width:20px">TCC</th>
              <th style="width:20px">TCE</th>
              <th style="width:20px">TGPC</th>
              <th style="width:20px">CGPA</th>
              <th style="width:20px">Class of Degree</th>
						</tr>
					</thead>
					<tbody>
						<?php
						  $query="SELECT t.vMatricNo,Name,Center,TCC,TCE,CGPE,CGPA,t.cProgrammeId,courses,entrylevel
                			FROM tbl_details t inner join
                			students s ON s.vmatricno=t.vMatricNo AND t.cprogrammeid='".$_SESSION['prob_id']."' AND grad_approved=1 and gradstatus!='YES' order by CGPA desc";

							//echo $query;
							$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));                
							$stmt->execute();
              
              

									 while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
									 {
                     $gpa = $rw[6];
              switch ($gpa){
                                case ($gpa<1.0):
                                $gclass ="Probation";
                                break;
                               case ($gpa<1.5):
                                $gclass ="Pass";
                                break;
                              case ($gpa<2.4):
                                $gclass ="Third Class";
                                break;
                              case ($gpa<3.5):
                                $gclass ="Second Class Lower";
                                break;
                              case ($gpa<4.5):
                                $gclass ="Second Class Upper";
                                break;
                              case ($gpa>=4.5):
                              $gclass ="First Class";
                              }
										  $dsc ="<div class = \"view_result\">
													<a href=\"rst_sess.php?Returnurl=".enc($rw[0])."\"><b> ".$rw[1]."</b></a>
													<div class =\"pull-bottom\">
													<a class = \"viewresult btn btn-success btn-xs\"  href=\"rst_sess.php?Returnurl=".enc($rw[0])."\">Review </a>
													<a class = \"viewresult btn_remove btn btn-primary  btn-xs\" data-id =".$rw[0]."> Remove From List</a>
													</div>
												</div>";
										echo
											"<tr>
											 <td>".($rw[0])."</td>
											<td style =\"width:200px\">
              								".$dsc."</td>
											 <td>".($rw[2])."</td>
											 <td>".($rw[3])."</td>
                       						 <td>".($rw[4])."</td>
											 <td>".($rw[5])."</td>
                       						<td>".number_format($rw[6],"2")."</td>
                                    <td>".$gclass."</td>
											</tr>
											";
									 }
							 ?>
					</tbody>
				</table>
      </fieldset>
			<hr>
			<!-- <h2 class="lead">Note!</h2> -->
			<p class="lead " style="text-align:center">
				Any request for modification should be directed to the Directorate of Examination and Assessment (DEA)
			 </p>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
				<!-- <a href="javascript:;" id="submit_issue" class="btn btn-success">Save Changes</a> -->
			</div>
      </div>


	</div>
</div>
</div>
