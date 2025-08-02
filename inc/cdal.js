// $(document).ready(function() {
  function getnewid(){
  	var number = 1 + Math.floor(1000+ Math.random() * 9000);
  	var mid = number;
  	//$("#ev_txtid").val(mid);
    return mid;
  }
    $("#b_remita").click(function(){
      if ($('#t_uname').val()==''){
        //swal("Oops!","");
        swal({title:"Oops!",
             text:"No login paratmeter specified. Enter your login email!",
             type:"error",
             customClass:"swal-size-sm",
             showCancelButton: false,
             closeOnConfirm:true,
           },function(){
             location.reload();
         })
      }
      //$("#t_uname").val(<?php echo json_encode($_SESSION['email']);?>);
      var email = $("#t_uname").val();
      $.post("ajax/ajax_get_parameter.php",{email1:email},
        function(data,textStatus){
          var dr = data.split("!");
          $("#payerEmail").val(dr[0]);
          $("#payerName").val(dr[1]);
          $("#payerPhone").val(dr[2]);
        });

    })

    $("#s_faculty").change(function(){

      var id=$(this).val();
      // var id =$(this).val();
      $("#srv_no").val('NOU/CMD/'+id+'/'+getnewid());
      // alert('NOU/CMD/'+id+'/'+getnewid());
      var dataString = 'id='+ id;
     $.ajax({
       type: "POST",
       url: "ajax/ajax_fill_osl.php",
       data: dataString,
       cache: false,
         success: function(html){
          $("#tbl_osl tbody").html(html);
         }
       });
    })

    $("#s_zone").change(function(){
      var id=$(this).val();
      //var order_id=$("#billcode").val();
      var dataString = 'id='+ id;
     $.ajax({
       type: "POST",
       url: "ajax/ajax_fill_center.php",
       data: dataString,
       cache: false,
         success: function(html){
          $("#s_stcenter").html(html);
         }
       });
    })

    $("#s_state").change(function(){
      var id=$(this).val();
      var dataString = 'id='+ id;
     $.ajax({
       type: "POST",
       url: "ajax/ajax_fill_lga.php",
       data: dataString,
       cache: false,
         success: function(html){
          $("#s_lg").html(html);
         }
       });


    })



    $("#b_submit_remita").click(function(){
      var payer_Name=$("#payerName").val();
      var payer_Email=$("#payerEmail").val();
      var payer_Phone=$("#payerPhone").val();
      var pay_code =$("#s_service").val();
      //var rrr =
      $.post("ajax/ajax_add_remita.php",{pay_code1:pay_code,payer_Name1:payer_Name,payer_Email1:payer_Email,payer_Phone1:payer_Phone},
        function(data,textStatus){
          //alert(data);
          if(data == 0){
            swal({title:"Oops!",
                 text:"Something went wrong. Transaction not successful!",
                 type:"error",
                 customClass:"swal-size-sm",
                 showCancelButton: false,
                 closeOnConfirm:true,
               },function(){
                 location.reload();
             })
          }else if(data==1){
            swal({title:"Successful!",
                 text:"Remita Retrieval Reference generated successfully!",
                 type:"success",
                 customClass:"swal-size-sm",
                 showCancelButton: false,
                 closeOnConfirm:true,
               },function(){
                 //location.reload();
                 window.location.href = './';
             })
          }else{
            //alert(data);
            swal({title:"Oops!",
                 text:"Something went wrong. Transaction not successful!",
                 type:"error",
                 customClass:"swal-wide",
                 showCancelButton: false,
                 closeOnConfirm:true,
               },function(){
                 location.reload();
             })
          }
        })
    })

    $("#b_save_entries").click(function(){
      //alert("Save the record when your click here.");
      var s_state = $("#s_state").val();
      var s_lg = $("#s_lg").val();
      var s_mst  = $("#s_mst").val();
      var s_est = $("#s_est").val();
      var t_aphone = $("#t_aphone").val();
      var t_aemail = $("#t_aemail").val();
      var t_nok = $("#t_kname").val();
      var s_gender = $("#s_gender").val();
      var s_dis = $("#s_dis").val();
      var d_dob = $("#d_dob").val();
      var s_est = $("#s_est").val();
      var t_kname = $("#t_kname").val();
      var s_ktyp = $("#s_ktyp").val();
      var t_kphone = $("#t_kphone").val();
      var t_kemail = $("#t_kemail").val();
      var t_addr = $("#t_addr").val();
      var t_kaddr = $("#t_kaddr").val();
      $.post("ajax/ajax_update_application.php",{s_state1:s_state, s_lg1:s_lg,s_mst1:s_mst,s_est1:s_est,t_aphone1:t_aphone,t_aemail1:t_aemail,t_nok1:t_nok,s_gender1:s_gender,s_dis1:s_dis,d_dob1:d_dob,s_est1:s_est,t_kname1:t_kname,t_kname1:t_kname,s_ktyp1:s_ktyp,t_kphone1:t_kphone,t_kemail1:t_kemail,t_addr1:t_addr,t_kaddr1:t_kaddr},
    function(data,textStatus){

    if(data == 1){
      $("#b_save_qual").prop('disabled', false);
      $(this).prop('disabled', true);
      swal({title:"Successful!",
           text:"Remita Retrieval Reference generated successfully!",
           type:"success",
           customClass:"swal-size-sm",
           showCancelButton: false,
           closeOnConfirm:true,
         },function(){
          //window.location.href = './';
       })
    }else{
      //alert(data);
      swal({title:"Oops!",
           text:"Something went wrong. Transaction not successful!",
           type:"error",
           customClass:"swal-size-sm",
           showCancelButton: false,
           closeOnConfirm:true,
         },function(){
           //location.reload();
           exit;
       })
      }
     })

    })
    /*
    ====================================
    Creating abd Saving Store Requisition
    ====================================
    */
    $("#save_sr").click(function() {
    //alert("Saving store requisition!");
    if ($('#srv_no').val()==''){
      swal("Oops!","Invalid entry. Requisition no not specified");
      //alert("Requisition No not specified. Please requisition no.");
      $('#srv_no').focus();
      return false;
    }

    // if ($('#req_prep_by').val()===''){
    //   swal("Oops!","Invalid entry. Requesting officer not specified");
    //   $('#req_prep_by').focus();
    //   return false;
    // }
    //
    // if ($('#req_check_by').val()===''){
    //   swal("Oops!","Invalid entry. Checking officer not specified");
    //   $('#req_check_by').focus();
    //   return false;
    // }
    //
    // if ($('#req_app_by').val()===''){
    //   swal("Oops!","Invalid entry. Approving officer not specified");
    //   $('#req_app_by').focus();
    //   return false;
    // }

     var id = $("#srv_no").val();
     var fac_id = $("#s_faculty").val();
     var d_date = $("#req_date").val();

     $.post("ajax/ajax_save_sr.php",{id1: id, fac_id1: fac_id, d_date1: d_date},
       function(data, textStatus){
          if(data == 1){
            alert("Requisition successfully registered!");
          }else if (data == 2){
            alert("An error occured. Requisition not created!");
          }else{
            alert(data);
          }
        });
    });

// $("#").click(function(){
$(document).on("click",".edit_reg",function(){
  var id = $(this).data('id');
  var dept =$(this).data('fac');
  var fac =$(this).data('title');
  $("#h_title").html('Faculty of '+ fac+ ' Course Material Request');
  //alert(fac);
var dataString = 'id='+ id;
$("#tbl_req").dataTable().fnDestroy();
$("#tbl_req tbody").empty();
 $.ajax({
   type: "POST",
   url: "ajax/ajax_fill_req.php",
   data: dataString,
   cache: false,
     success: function(html){
      $("#tbl_req tbody").append(html);
      $("#tbl_req").DataTable({
         "paging":   false,
         "ordering": false,
         "info":     true
      });
     }
   });
})

$("#Returnurl").keyup(function(event) {

    if (event.keyCode == 13) {
      var id = $("#Returnurl").val();
      // alert ("Search in progress!..."+id);
        // $("#submit").trigger("click")
        $.post("ajax/ajax_get_url.php",{id1:id},
          function(data,textStatus){
            if (data==1){
              window.location.href = 'sor';
          }else{

            swal({title:"Oops!",
                 text:"Invalid Matric No Specified or Access Denied!",
                 type:"error",
                 customClass:"swal-size-lg",
                 showCancelButton: false,
                 closeOnConfirm:true,
               },function(){
                 location.reload();
                 exit;
             })
          }
        });
    }
});
$("#hd_submit").click(function(){

  var id = $("#Returnurl").val();
   $.post("ajax/ajax_get_url.php",{id1:id},
     function(data,textStatus){
       if (data==1){
         window.location.href = 'hd_sor';
     }else{

       swal({title:"Oops!",
            text:"Invalid Matric No Specified or Access Denied!",
            type:"error",
            customClass:"swal-size-lg",
            showCancelButton: false,
            closeOnConfirm:true,
          },function(){
            location.reload();
            exit;
        })
     }
   });
})

$("#submit").click(function(){

  var id = $("#Returnurl").val();
   $.post("ajax/ajax_get_url.php",{id1:id},
     function(data,textStatus){
       if (data==1){
         window.location.href = 'sor';
     }else{

       swal({title:"Oops!",
            text:"Invalid Matric No Specified or Access Denied!",
            type:"error",
            customClass:"swal-size-lg",
            showCancelButton: false,
            closeOnConfirm:true,
          },function(){
            location.reload();
            exit;
        })
     }
   });
})

$("#btn_usr").click(function(){
  var acct_name=$("#acct_name").val();
  var usr_name=$("#acct_email").val();
  var usr_mob=$("#acct_phone").val();
  var usr_cat=$("#usr_role").val();
  var usr_unit=$("#usr_unit").val();
  var usr_pwd = Math.random().toString(36).slice(-8);
// alert (usr_name);
  $.post("ajax/ajax_add_usr.php",{usr_name1: usr_name, acct_name1: acct_name, usr_mob1: usr_mob,usr_cat1:usr_cat,usr_pwd1:usr_pwd,usr_unit1:usr_unit},
    function(data, textStatus){
      if(data == 1){       
        swal({title:"Successful!",
             text:"User account successfully created \n Password has been sent to the email provided!",
             type:"success",
             customClass:"swal-size-sm",
             showCancelButton: false,
             closeOnConfirm:true,
           },function(){
             location.reload();
         })
      }else{
         //alert(data);
        swal({title:"Oops!",
             text:"Something went wrong. Account creation not successful!",
             type:"error",
             customClass:"swal-size-sm",
             showCancelButton: false,
             closeOnConfirm:true,
           },function(){
             location.reload();
             exit;
         })
        }
     });
})

/*
DELETE User Account
*/
$(document).on("click", ".del_usr", function ()
 {
   var id = $(this).data('id');
  swal({
    title:'DELETE USER!',
    text: 'This action is not reversible. Are you sure you want to continue?',
    type:'warning',
    customClass:'swal-size-sm',
    showCancelButton: true,
    confirmButtonClass: "btn-primary",
    cancelButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel pls!",
    closeOnConfirm: false,
    closeOnCancel: false,
    titleClass:"text-red"
  },
  function(isConfirm){
    if (isConfirm){
      $.post("ajax/ajax_delete_usr.php",{id1: id},
      function(data, textStatus){
        if(data == 1){
          swal({
            position:'top-end',
            type: 'success',
            title: 'User successfully deleted!',
            showConfirmButton: true,
          },
          function(isConfirm){
             location.reload();
          });
          
         }else if (data == 2){
           swal("Oops!","An error occured. User not deleted.","error");
         }else if(data==0){
           swal("Oops!","User has items and cannot be deleted.","error");
       }else{
           swal("Error!",data,"error");
         }
       });
  }else{
    swal({
      title:'Cancelled!',
      text:'Action cancelled by you.',
       type:"success",
      showConfirmButton: false,
      timer: 2500
    });
  }
});
});

/*
Reset User Account Password
*/
$(document).on("click", ".usr_reset", function ()
 {
   var usr_pwd = Math.random().toString(36).slice(-8);
   var id = $(this).data('id');
  swal({
    title:'RESET USER PASSWORD!',
    text: 'This action is not reversible. Are you sure you want to continue?',
    type:'warning',
    customClass:'swal-size-sm',
    showCancelButton: true,
    confirmButtonClass: "btn-primary",
    cancelButtonClass: "btn-danger",
    confirmButtonText: "Yes, Reset!",
    cancelButtonText: "No, cancel pls!",
    closeOnConfirm: false,
    closeOnCancel: false,
    titleClass:"text-red"
  },
  function(isConfirm){
    if (isConfirm){
      $.post("ajax/ajax_reset_usr.php",{id1: id,usr_pwd1:usr_pwd},
      function(data, textStatus){
        if(data == 1){
          swal({
            position:'top-end',
            type: 'success',
            customClass:'swal-size-sm',
            title: 'User password successfully reset!',
            showConfirmButton: true,
          }, function(isConfirm){
             location.reload();
          });
         }else if (data == 2){
           swal("Oops!","An error occured. User password not reset.","error");
         }else if(data==0){
           swal("Oops!","User account does not exist.","error");
         }else{
           swal("Error!",data,"error");
         }
       });
  }else{
    swal({
      title:'Cancelled!',
      text:'Action cancelled by you.',
       type:"success",
      showConfirmButton: false,
      timer: 2500
    });
  }
});
});

$("#usr_role").change(function (){
   var id = $(this).val();
   dataString="id="+id;
   $.ajax({
     type: "POST",
     url: "ajax/ajax_fill_obj.php",
     data: dataString,
     cache: false,
       success: function(html){
        $("#usr_unit").html(html);
       }
     });
})

$("#btn_chnpwd").click(function()
{
  var c_pwd = $("#c_pwd").val();
  var n_pwd = $("#n_pwd").val();
  var cn_pwd = $("#cn_pwd").val();
  //  alert('current pwd: '+ c_pwd + ' New Pwd: '+ n_pwd + ' and the confirm pwd is: '+cn_pwd);
  if (n_pwd!==cn_pwd){
    swal({
      position:'top-end',
      type: 'warning',
      customClass:'swal-size-sm',
      title: 'Your new paswword does not match!',
      showConfirmButton: true,
    }, function(isConfirm){
       location.reload();
       exit;
    });
  }else{
    swal({
      title:'CHANGE MY PASSWORD!',
      text: 'This action is not reversible. Are you sure you want to continue?',
      type:'warning',
      customClass:'swal-size-sm',
      showCancelButton: true,
      confirmButtonClass: "btn-primary",
      cancelButtonClass: "btn-danger",
      confirmButtonText: "Yes, Change it!",
      cancelButtonText: "No, cancel pls!",
      closeOnConfirm: false,
      closeOnCancel: false,
      titleClass:"text-red"
    },
    function(isConfirm){
      if (isConfirm){
        $.post("ajax/ajax_chng_pwd.php",{c_pwd1: c_pwd,n_pwd1:n_pwd,cn_pwd1:cn_pwd},
        function(data, textStatus){
          if(data == 1){
            swal({
              position:'top-end',
              type: 'success',
              title: 'User password successfully changed!',
              showConfirmButton: true,
            }, function(isConfirm){
               location.href="../";
            });
           }else if (data == 2){
             swal("Oops!","Invalid current password specified!.","error");
           }else if(data==0){
             swal("Oops!","Something went wrong. Password not changed.","error");
         }else{
             swal("Error!",data,"error");
           }
         });
    }else{
      swal({
        title:'Cancelled!',
        text:'Action cancelled by you.',
         type:"success",
        showConfirmButton: false,
        timer: 2500
      });
    }
   });
  }

});
