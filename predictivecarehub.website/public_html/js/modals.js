$(document).ready(function () {
  //close upload modal
  $('#upload_modalbg').on('click', function () {
    $('#upload_modalbg').addClass('hidden');
    $('#upload_modal').addClass('hidden');
  });

  //close edit medical file modal
  $('#uupload_modalbg').on('click', function () {
    $('#uupload_modalbg').addClass('hidden');
    $('#uupload_modal').addClass('hidden');
    $('#file_name').removeClass('hidden');
  });

  //close edit prescription file modal
  $('#uupload_prescriptionbg').on('click', function () {
    $('#uupload_prescriptionbg').addClass('hidden');
    $('#uupload_prescription').addClass('hidden');
    $('#file_name').removeClass('hidden');
  });

  //check if doctor then show specialization select input
  $('#usertype').on('change', function () {
    let usertype = $('#usertype').val();
    if (usertype == 'doctor') {
      $('.specialization').removeClass('hidden');
    } else {
      $('.specialization').addClass('hidden');
    }
  });

  //check if request is others then show input field
  $('#request_type').on('change', function () {
    let request_type = $('#request_type').val();
    if (request_type == 'Others') {
      $('.request_type').removeClass('hidden');
    } else {
      $('.request_type').addClass('hidden');
    }
  });

  //check if others then hide specialization select input
  $('#doctor_id').on('change', function () {
    let doctor = $('#doctor_id').val();
    if (doctor == 'others') {
      $('.req').removeClass('hidden');
    } else {
      $('.req').addClass('hidden');
    }
  });

  // removing error mesage
  $('#confirm_pass').on('keydown', function () {
    $('.pwddm').addClass('hidden');
  });

  $('#password').on('keydown', function () {
    $('.pwddm').addClass('hidden');
    $('.el').addClass('hidden');
    $('.not_verified').addClass('hidden');
  });

  $('#email').on('keydown', function () {
    $('.ee').addClass('hidden');
    $('.el').addClass('hidden');
    $('.fgt').addClass('hidden');
    $('.rev').addClass('hidden');
  });

  // complete registration close modal
  $('#modal-bg').on('click', function () {
    $('#modal-box').addClass('hidden');
    $('#modal-bg').addClass('hidden');
  });

  // not verified close modal
  $('#modal-bg3').on('click', function () {
    $('#modal-box3').addClass('hidden');
    $('#modal-bg3').addClass('hidden');
  });

  // resend verification close modal
  $('#modal-bg4').on('click', function () {
    $('#modal-box4').addClass('hidden');
    $('#modal-bg4').addClass('hidden');
  });

  // forget passsword close modal
  $('#forgot_modalbg').on('click', function () {
    $('#forgot_modalbg').addClass('hidden');
    $('#forgot_modal').addClass('hidden');
  });

  // add admin modal
  $('.add_user_btn').on('click', function () {
    $('#add_user_modelbg').removeClass('hidden');
    $('#add_user_model').removeClass('hidden');
  });

  // close add user modal
  $('#add_user_modelbg').on('click', function () {
    $('#add_user_modelbg').addClass('hidden');
    $('#add_user_model').addClass('hidden');
  });

  $('.close_user').on('click', function () {
    $('#add_user_modelbg').addClass('hidden');
    $('#add_user_model').addClass('hidden');
  });

  // add physician modal
  $('#add_physician_btn').on('click', function () {
    $('#add_physician_modelbg').removeClass('hidden');
    $('#add_physician_model').removeClass('hidden');
  });

  // close add physician modal
  $('#add_physician_modelbg').on('click', function () {
    $('#add_physician_modelbg').addClass('hidden');
    $('#add_physician_model').addClass('hidden');
  });

  // close add and edit physician modal
  $('.close_physician_modelbg').on('click', function () {
    $('#add_physician_modelbg').addClass('hidden');
    $('#add_physician_model').addClass('hidden');
    $('#edit_physician_modelbg').addClass('hidden');
    $('#edit_physician_model').addClass('hidden');
  });

  // add services modal
  $('#add_services_btn').on('click', function () {
    $('#add_services_modelbg').removeClass('hidden');
    $('#add_services_model').removeClass('hidden');
  });

  // close add services modal if background clicked
  $('#add_services_modelbg').on('click', function () {
    $('#add_services_modelbg').addClass('hidden');
    $('#add_services_model').addClass('hidden');
  });

  // close modal for add and edit services
  $('.close_services_modelbg').on('click', function () {
    $('#add_services_modelbg').addClass('hidden');
    $('#add_services_model').addClass('hidden');
    $('#edit_services_modelbg').addClass('hidden');
    $('#edit_services_model').addClass('hidden');
  });

  $('#warning_deletionbg').on('click', function () {
    $('#warning_deletionbg').addClass('hidden');
    $('#warning_deletion').addClass('hidden');
  });

  $('#close_deletion').on('click', function () {
    $('#warning_deletionbg').addClass('hidden');
    $('#warning_deletion').addClass('hidden');
  });

  // close error message
  $('#username').on('keydown', function () {
    $('.uau').addClass('hidden');
    $('.el').addClass('hidden');
  });
  $('#password').on('keydown', function () {
    $('.not_verified').addClass('hidden');
  });
  $('#edit_password').on('keydown', function () {
    $('.not_verified').addClass('hidden');
  });
  $('#confirm_pass').on('keydown', function () {
    $('.not_verified').addClass('hidden');
  });
  $('#edit_username').on('keydown', function () {
    $('.uau').addClass('hidden');
  });

  // show modal
  $('.request_btn').on('click', function () {
    $('#request_modelbg').removeClass('hidden');
    $('#request_model').removeClass('hidden');
  });

  // close modal
  $('#request_modelbg').on('click', function () {
    $('#request_modelbg').addClass('hidden');
    $('#request_model').addClass('hidden');
  });

  $('.close_request').on('click', function () {
    $('#request_modelbg').addClass('hidden');
    $('#request_model').addClass('hidden');
  });

  $('#oldpassword').on('change', function () {
    $('#incorrect').addClass('hidden');
  });

  $('#password').on('change', function () {
    $('.pwddm').addClass('hidden');
  });

  $('#confirm_pass').on('change', function () {
    $('.pwddm').addClass('hidden');
  });

  // when document is not present
  $('.open_toast').on('click', function () {
    $('#toast_modal').addClass('hidden');
    $('#toast_modal').removeClass('hidden');
    setTimeout(function () {
      $('#toast_modal').addClass('hidden');
    }, 2500);
  });

  // close warning
  $('.close_warning').on('click', function () {
    $('#warning_deletionbg').addClass('hidden');
    $('#warning_deletion').addClass('hidden');
    $('#warning_archivebg').addClass('hidden');
    $('#warning_archive').addClass('hidden');
    $('#warning_unarchivebg').addClass('hidden');
    $('#warning_unarchive').addClass('hidden');
    $('#warning_deletefilebg').addClass('hidden');
    $('#warning_deletefile').addClass('hidden');
    $('#warning_deleteprescriptionbg').addClass('hidden');
    $('#warning_deleteprescription').addClass('hidden');
    $('#approve_medicalbg').addClass('hidden');
    $('#approve_medical').addClass('hidden');
    $('#warning_delete_predictivebg').addClass('hidden');
    $('#warning_delete_predictive').addClass('hidden');
  });

  $('#warning_deletionbg').on('click', function () {
    $('#warning_deletionbg').addClass('hidden');
    $('#warning_deletion').addClass('hidden');
  });

  $('#warning_archivebg').on('click', function () {
    $('#warning_archivebg').addClass('hidden');
    $('#warning_archive').addClass('hidden');
  });

  $('#warning_unarchivebg').on('click', function () {
    $('#warning_unarchivebg').addClass('hidden');
    $('#warning_unarchive').addClass('hidden');
  });

  $('#warning_deletefilebg').on('click', function () {
    $('#warning_deletefilebg').addClass('hidden');
    $('#warning_deletefile').addClass('hidden');
  });

  $('#warning_deleteprescriptionbg').on('click', function () {
    $('#warning_deleteprescriptionbg').addClass('hidden');
    $('#warning_deleteprescription').addClass('hidden');
  });

  $('#approve_medicalbg').on('click', function () {
    $('#approve_medicalbg').addClass('hidden');
    $('#approve_medical').addClass('hidden');
  });

  // edit admin modal
  // show modal
  $('.edit_admin').on('click', function () {
    let id = $(this).attr('data-id');
    let username = $(this).attr('data-username');
    let firstname = $(this).attr('data-firstname');
    let lastname = $(this).attr('data-lastname');
    let usertype = $(this).attr('data-usertype');

    $('#edit_admin_modelbg').removeClass('hidden');
    $('#edit_admin_model').removeClass('hidden');

    $('#edit_id').val(id);
    $('#edit_username').val(username);
    $('#edit_firstname').val(firstname);
    $('#edit_lastname').val(lastname);
    $('#edit_usertype').val(usertype);
  });

  // edit admin modal
  // exit modal
  $('#edit_admin_modelbg').on('click', function () {
    $('#edit_admin_modelbg').addClass('hidden');
    $('#edit_admin_model').addClass('hidden');
  });

  // edit doctor modal
  // show modal
  $('.edit_doctor').on('click', function () {
    let id = $(this).attr('data-id');
    let username = $(this).attr('data-username');
    let firstname = $(this).attr('data-firstname');
    let lastname = $(this).attr('data-lastname');
    let department = $(this).attr('data-department');

    $('#edit_doctor_modelbg').removeClass('hidden');
    $('#edit_doctor_model').removeClass('hidden');

    $('#edit_id').val(id);
    $('#edit_username').val(username);
    $('#edit_firstname').val(firstname);
    $('#edit_lastname').val(lastname);
    $('#edit_department').val(department);
  });

  // edit doctor modal
  // exit modal
  $('#edit_doctor_modelbg').on('click', function () {
    $('#edit_doctor_modelbg').addClass('hidden');
    $('#edit_doctor_model').addClass('hidden');
  });

  // edit physician modal
  // show modal
  $('.edit_physician').on('click', function () {
    let id = $(this).attr('data-id');
    let name = $(this).attr('data-name');
    let role = $(this).attr('data-role');

    $('#edit_physician_modelbg').removeClass('hidden');
    $('#edit_physician_model').removeClass('hidden');

    $('#edit_id').val(id);
    $('#edit_name').val(name);
    $('#edit_role').val(role);
  });

  // edit physician modal
  // exit modal
  $('#edit_physician_modelbg').on('click', function () {
    $('#edit_physician_modelbg').addClass('hidden');
    $('#edit_physician_model').addClass('hidden');
  });

  // edit services modal
  // show modal
  $('.edit_services').on('click', function () {
    let id = $(this).attr('data-id');
    let title = $(this).attr('data-title');
    let description = $(this).attr('data-description');

    $('#edit_services_modelbg').removeClass('hidden');
    $('#edit_services_model').removeClass('hidden');

    $('#edit_id').val(id);
    $('#edit_title').val(title);
    $('#edit_description').val(description);
  });

  // edit services modal
  // exit modal
  $('#edit_services_modelbg').on('click', function () {
    $('#edit_services_modelbg').addClass('hidden');
    $('#edit_services_model').addClass('hidden');
  });

  // edit precaution modal
  // show modal
  $('.edit_precaution').on('click', function () {
    let id = $(this).attr('data-id');
    let title = $(this).attr('data-title');
    let description = $(this).attr('data-description');

    $('#edit_precaution_modelbg').removeClass('hidden');
    $('#edit_precaution_model').removeClass('hidden');

    $('#edit_pid').val(id);
    $('#edit_ptitle').val(title);
    $('#edit_pdescription').val(description);
  });

  // edit precaution modal
  // exit modal
  $('#edit_precaution_modelbg').on('click', function () {
    $('#edit_precaution_modelbg').addClass('hidden');
    $('#edit_precaution_model').addClass('hidden');
  });
  
  // edit predictive modal
  // exit modal
  $('#edit_predictive_modelbg').on('click', function () {
    $('#edit_predictive_modelbg').addClass('hidden');
    $('#edit_predictive_model').addClass('hidden');
  });

  // add predictive modal
  // exit modal
  $('#add_predictive_modelbg').on('click', function () {
    $('#add_predictive_modelbg').addClass('hidden');
    $('#add_predictive_model').addClass('hidden');
  });

  // close edit and add in predictive
  $('.close_predictive_modelbg').on('click', function () {
    $('#add_predictive_modelbg').addClass('hidden');
    $('#add_predictive_model').addClass('hidden');
    $('#edit_predictive_modelbg').addClass('hidden');
    $('#edit_predictive_model').addClass('hidden');
  });

  // add predictive modal
  $('.add_predictive_btn').on('click', function () {
    $('#add_predictive_modelbg').removeClass('hidden');
    $('#add_predictive_model').removeClass('hidden');
  });

  // add precaution modal
  $('#add_precaution_btn').on('click', function () {
    $('#add_precaution_modelbg').removeClass('hidden');
    $('#add_precaution_model').removeClass('hidden');
  });

  // close add precaution modal if background clicked
  $('#add_precaution_modelbg').on('click', function () {
    $('#add_precaution_modelbg').addClass('hidden');
    $('#add_precaution_model').addClass('hidden');
  });

  // close modal for add and edit precaution
  $('.close_precaution_modelbg').on('click', function () {
    $('#add_precaution_modelbg').addClass('hidden');
    $('#add_precaution_model').addClass('hidden');
    $('#edit_precaution_modelbg').addClass('hidden');
    $('#edit_precaution_model').addClass('hidden');
  });
  
  // exit modal
  $('#warning_delete_predictivebg').on('click', function () {
    $('#warning_delete_predictivebg').addClass('hidden');
    $('#warning_delete_predictive').addClass('hidden');
  });
});

// show password
function showPassword(id) {
    var doc = document.getElementById(id);
    if (doc.type === "password") {
        doc.type = "text";
    } else {
         doc.type = "password";
    }
}
