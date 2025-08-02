<!-- #modal-dialog -->
<div class="modal left fade" id="modal_grad_approved">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info modal-sm" role= "document" style="width:45%;">
  <!-- <div class="modal-dialog modal-ml" style="width:65%;"> -->
		<div class="modal-content">
			<div class="modal-header">
        <h4><b>YOU ARE VIEWING:</b></h4>
				<h3 id ="issue_title" class="modal-title" style="margin-top:-10px">APPROVED GRADUANT LIST </h3>
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
						</tr>
					</thead>
					<tbody>
						<?php
						 $query="SELECT t.vMatricNo,Name,Center,TCC,TCE,CGPE,CGPA,t.cProgrammeId,courses,entrylevel
                			FROM tbl_details t inner join
                			students s ON s.vmatricno=t.vMatricNo AND t.cprogrammeid='".$_SESSION['prob_id']."' AND grad_approved=1";

								// echo $query
								 $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));                
								 $stmt->execute();

									 while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
									 {
										echo
											"<tr>
											 <td>".($rw[0])."</td>
											 <td>".($rw[1])."</td>
											 <td>".($rw[2])."</td>
											 <td>".($rw[3])."</td>
                       <td>".($rw[4])."</td>
											 <td>".($rw[5])."</td>
                       <td>".number_format($rw[6],"2")."</td>
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
