<style >
.sidebar {
  background-color: green!important;
  position: fixed;
}
.sub-menu{
  background-color: green!important;
}
.sidebar-bg{
  background-color: green!important;
}
.nav-profile{
  background-color: #90ee9033!important;
}
.sidebar .nav>li.expand>a, .sidebar .nav>li>a:focus, .sidebar .nav>li>a{
    background: #008f0000!important;
    color: #ffffff94!important;
}
#footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  z-index: 99;
  /* height: 100px;
    width:100%;
    position: static;
    left: 0;
    bottom: 0;
    z-index: 9; */
}
.sidebar .sub-menu>li>a {
    padding: 5px 20px;
    display: block;
    font-weight: 300;
    color: #ffffff!important;
    text-decoration: none;
    position: relative;
}
.sidebar .nav>li.expand>a, .sidebar .nav>li>a:focus, .sidebar .nav>li>a:hover {
    background: #008f00!important;
    color: #ffffff!important;
}
.sidebar-bg{
  min-height: 100%;
  /* position:relative; */
}
.sidebar .btn-success{
    background: #008f00!important;
}
#sidebar{
  padding-bottom: 100px;    /* height of footer */
}
/* .sidebar-minify-btn.focus, .sidebar-minify-btn.hover{
  background: #008f00!important;
  color: #ffffff!important;
} */
.sidebar-minify-btn {
    /* margin: 10px 0;
    float: right;
    padding: 5px 20px 5px 10px!important;
    color: #fff; */
    background: #008f00!important;

    /* -webkit-border-radius: 20px 0 0 20px;
    -moz-border-radius: 20px 0 0 20px;
    border-radius: 20px 0 0 20px; */
}
</style>
<!-- begin #sidebar -->

		<div id="sidebar" class="sidebar" style="font-size:16px;color:white">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image " style="margin-top:25px">
							<a href="javascript:;"><img src="assets/img/user.png" alt="" /></a>
						</div>
						<div class="info " style="margin-top:25px">
						<?php echo $_SESSION['name']; ?>
							<small class="text-white"> <?php echo $_SESSION['role']; ?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav "  >
					<li class="nav-header" style="font-size:16px;color:white">Navigation</li>
					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-laptop"></i>
						    <span>Dashboard</span>
					    </a>
						<ul class="sub-menu">
						    <li><a href="mgt_dashboard">Main Dashboard</a></li>
						    <li><a href="index_v2.html">Zonal Dashboard</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<span class="badge pull-right">8</span>
							<i class="fa fa-inbox"></i>
							<span>Faculty</span>
						</a>
						<ul class="sub-menu">
              <?php
                $query="SELECT f.cfacultyid,vlegend, COUNT(p.cfacultyid)
                      FROM faculty f INNER JOIN
                      programme p ON p.cfacultyid=f.cfacultyid
                      GROUP BY f.cfacultyid,vlegend
                      ORDER BY vfacultydesc";
                  $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                  $stmt->execute();
                  while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                  {
                    echo "<li><a href=\"fac_sess.php?Returnurl=".enc($rw[0])."\"> ".$rw[1]."</a></li>";
                  }
                  $stmt->closeCursor();
              ?>

						    <li><a href="spg_dash">SPG</a></li>
						    <!-- <li><a href="email_compose.html">Compose</a></li>
						    <li><a href="email_detail.html">Detail</a></li> -->
						</ul>
					</li>

					
          <?php 
            if ($_SESSION['u_cat']=="ADMIN"){
              ?>
              <li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-file-o"></i>
						    <span>Admin</span>
						</a>
						<ul class="sub-menu" style="font-size: 16px!important">
							<li><a href="#">Manage Courses</a></li>
							<li><a href="#">Manage Program </a></li>
							<li><a href="#">Manage Faculty</a></li>
							<li><a href="#">Manage Centers</a></li>
              <!-- <li><a href="#"></a></li> -->
						</ul>
					</li>
              <li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-file-o"></i>
						    <span>Users</span>
						</a>
						<ul class="sub-menu" style="font-size: 16px!important">
							<li><a href="#modal_create_user" data-toggle ="modal" data-backdrop="static" data-keyboard="false">Create New User</a></li>
							<li><a href="mgt_vendor">Admin User</a></li>
							<li><a href="usr_mgt.php">Manage Users</a></li>
              <!--<li><a href="form_slider_switcher.html">Center Users</a></li>-->
							<!-- <li><a href="form_validation.html">Service Type</a></li> -->
						</ul>
					</li>
          <li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-file-o"></i>
						    <span>Approved Grad List</span>
						</a>
						<ul class="sub-menu" style="font-size: 16px!important">
							<li><a href="apprv_grad_list.php">All List</a></li>
              <!--<li><a href="form_slider_switcher.html">Center Users</a></li>-->
							<!-- <li><a href="form_validation.html">Service Type</a></li> -->
						</ul>
					</li>
          <?php
            }
          ?>
          

			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
              <!-- <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-sign-out"></i></a> -->

        </ul>


				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
      <ul class="nav " style="margin-top:-15px">
        <li class="has-sub">
          <a href="#modal_chpwd" data-toggle="modal" data-backdrop="static" data-keyboard="false">
              <span>Change Password</span>
          </a>

        </li>
        <!-- <a class="btn btn-success btn-block" href="#" style="margin-top:-15px"> Change Password</a> -->
        <li class="nav-profile" id="footer">

          <div class="image">
            <a href="javascript:;"><img src="assets/img/user.png" alt="" /></a>
          </div>
          <div class="info ">
            <?php echo $_SESSION['name']; ?>
            <!-- <small class="text-white">Front end developer</small> -->
            <div class="pull-right">
              <a href="./" class="btn btn-icon"><i class="fa fa-2x fa-sign-out" style="color: #ffffffb0!important;"></i></a>
            </div>
          </div>
        </li>
      </ul>
		</div>
<div id="holder" class="sidebar-bg" style="height:100%!important"></div>
<?php
include "modal/modal_chpwd.php";
 ?>
