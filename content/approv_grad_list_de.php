
<!-- begin #content -->
		<div id="content" class="content" style="margin-top:30px">

			<!-- begin page-header -->
			<h1 class="page-header">Approve Graduating List <small>List of Approve Graduating Students </small></h1>
			<!-- end page-header -->
		<!--	<p class="pull-right" style="margin-top:-30px">
					<a href="#modal_create_user" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-success">
							<i class="fa fa-user-plus"></i> Create New User
					</a>
			</p>--->
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
						<div class="panel " data-sortable-id="index-1">
			        <div class="panel-heading bg-green ">

			          <h4 class="text-white">Grdauating Students List</h4>
			        </div>
			      <div class="panel-body" >
			        <div class="table-responsive">
			           <div>
					   	 <table id="data-table" class="table table-striped " style="width:100%">
			              <thead >
			              <tr>
			              <th>Matric Number</th>
			              <th>Name</th>
										 
			              <th>Approved Email</th>
						  <th>Approved Staff</th>
						  <th>Programme</th>
						   <th>Approve Date</th>
										<th>Approval Status</th>
			              </tr>
			              </thead>
			                <tbody>
			                <?php
			                //$glbYear="2014";
			                $k=1;
			            	$query ="SELECT s.vmatricno,concat(s.vlastname,' ',s.vothernames),a.approve_by,u.acct_name,s.vProgrammeDesc,a.approve_on,a.approve_remove
								      from students s, approve_grad_logs a,usr_acct u 
									  where s.vmatricno=a.student and a.approve_by=u.usr_name
								      ";

			                //echo $query;

			                  $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			                  //$stmt->bindParam(':vyear', $glbYear, PDO::PARAM_STR,12);
			                  $stmt->execute();
			                  while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {

			                  //$stmt->bindParam(':vyear', $glbYear, PDO::PARAM_STR,12);

												// $desc="
												
												// <a class = \" btn btn-white del_usr btn-xs\" href = \"#\" data-id=".$rw[1]."><i class=\"fa fa-trash-o\"></i> Delete </a>
												// <a class = \" btn btn-white usr_reset btn-xs\" href = \"#\" data-id=".$rw[1]."><i class=\"fa fa-key\"></i> Reset </a>
												// ";

			                    echo"
			                      <tr style=\"font-size:17px\">
			                        <td>".$rw[0]."</td>
									<td>".$rw[1]."</td>
									<td>".$rw[2]."</td>
			                        <td>".$rw[3]."</td>
									<td>".$rw[4]."</td>
									<td>".$rw[5]."</td>
									<td>".$rw[6]."</td>


			                      </tr>";
			                    $k+=1;
			                  }
			                  $stmt->closeCursor();
			                ?>
			                </tbody>
			            </table>
					   </div>
			          </div>
			        </div>
			      </div>
			    </div>
			    <!-- end col-12 -->
			</div>
			<!-- end row -->
			<p>
					<a href="javascript:history.back(-1);" class="btn btn-success">
							<i class="fa fa-arrow-circle-left"></i> Back to previous page
					</a>
			</p>
			<div id="footer" class="footer">
		      &copy; 2022 National Open University of Nigeria
		  </div>
		</div>
		<!-- end #content -->
