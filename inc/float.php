<style>
.theme-panel {
    position: fixed;
    right: -175px;
    top: 150px;
    z-index: 1020;
    background: #008f00;
    padding: 15px;
    box-shadow: 0 0 2px rgb(0 0 0 / 40%);
    -webkit-box-shadow: 0 0 2px rgb(0 0 0 / 40%);
    -moz-box-shadow: 0 0 2px rgba(0,0,0,.4);
    width: 175px;
    -webkit-transition: right .2s linear;
    -moz-transition: right .2s linear;
    transition: right .2s linear;
}
.theme-panel .theme-panel-content {
    margin: -15px;
    padding: 15px;
    background: #008f00;
    position: relative;
    z-index: 1020;
    min-width: 500px;
}
</style>
<div class="theme-panel" style="width:400px;margin-top:180px">
    <!-- <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn" style="margin-top:0px"><i class="fa fa-search"></i></a> -->
    <div class="theme-panel-content" style="width:800px;margin-top:-10px">
      <h5 class="m-t-0 text-white">Search...</h5>
       <div class="divider" ></div>
         <form class="navbar-form full-width" autocomplete="off" action="m_sess.php">
           <div class="form-group" >
             <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
             <input type="text" class="form-control" style="margin-left:-25px" name = "Returnurl" placeholder="Enter Matric No" />

           </div>
         </form>
    </div>
</div>
