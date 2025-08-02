
<!-- begin #content -->
		<div id="content" class="content" style="margin-top:30px">

			<!-- begin page-header -->
			<h1 class="page-header">Manageing Users <small>Manageing registered application users</small></h1>
			<!-- end page-header -->
			<p class="pull-right" style="margin-top:-30px">
					<a href="#modal_create_user" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-success">
							<i class="fa fa-user-plus"></i> Create New User
					</a>
			</p>
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
						<div class="panel " data-sortable-id="index-1">
			        <div class="panel-heading bg-green ">

			          <h4 class="text-white">User List</h4>
			        </div>
			      <div class="panel-body" >
			        <div class="table-responsive">
			           <div>
					   	 <table id="data-table" class="table table-striped " style="width:100%">
			              <thead >
			              <tr>
			              <th>Account Name</th>
			              <th>User Name</th>
										 <th>User Phone</th>
			              <th>Category</th>
										<th>Action</th>
			              </tr>
			              </thead>
			                <tbody>
			                <?php
			                //$glbYear="2014";
			                $k=1;
			            	$query ="SELECT acct_name,usr_name,usr_mob,usr_cat
								      from usr_acct
								      ";

			                //echo $query;

			                  $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			                  //$stmt->bindParam(':vyear', $glbYear, PDO::PARAM_STR,12);
			                  $stmt->execute();
			                  while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {

			                  //$stmt->bindParam(':vyear', $glbYear, PDO::PARAM_STR,12);

												$desc="
												
												<a class = \" btn btn-white del_usr btn-xs\" href = \"#\" data-id=".$rw[1]."><i class=\"fa fa-trash-o\"></i> Delete </a>
												<a class = \" btn btn-white usr_reset btn-xs\" href = \"#\" data-id=".$rw[1]."><i class=\"fa fa-key\"></i> Reset </a>
												";

			                    echo"
			                      <tr style=\"font-size:17px\">
			                        <td>".$rw[0]."</td>
			                        <td>
			                        <div class = \"view_result \">
			                          ".$rw[1]."
			                          </div>
			                        </td>
			                        <td><div class = \"view_result\">
			                          <a>".$rw[2]."</a>
			                          </div>
																</td>
			                        <td>
			                        <div>
			                          <a>".$rw[3]."</a>
			                          </div>
			                        </td>
															<td>".$desc."</td>


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
		      &copy; 2021 National Open University of Nigeria
		  </div>
		</div>
		<!-- end #content -->
