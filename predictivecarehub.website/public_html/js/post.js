// CSRF token: fetched once per page load, attached to every same-origin
// POST so each AJAX handler below doesn't need its own token wiring.
var CSRF_TOKEN = null;
$.get('../functions/csrf_token.php').done(function (token) {
  CSRF_TOKEN = token;
});

$(document).ajaxSend(function (event, jqxhr, settings) {
  if (
    CSRF_TOKEN &&
    settings.type &&
    settings.type.toUpperCase() === 'POST' &&
    settings.url &&
    settings.url.indexOf('://') === -1
  ) {
    jqxhr.setRequestHeader('X-CSRF-Token', CSRF_TOKEN);
  }
});

$(document).ready(function () {
  // patient login
  $('#login_patient').submit(function (e) {
    e.preventDefault();
    let email = $('#email').val();
    let password = $('#password').val();
    let action = 'login';
    const data = {
      email,
      password,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'unverified') {
          notVerified();
        } else if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        } else {
          failedLogin();
        }
      },
    });
  });

  // admin login
  $('#login_admin').submit(function (e) {
    e.preventDefault();
    let username = $('#username').val();
    let password = $('#password').val();
    let action = 'login_admin';
    const data = {
      username,
      password,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'it' || res == 'mrm' || res == 'him') {
          setTimeout(function () {
            window.location.href = '/admin/' + res;
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        } else {
          failedLogin();
        }
      },
    });
  });

  // doctor login
  $('#login_doctor').submit(function (e) {
    e.preventDefault();
    let username = $('#username').val();
    let password = $('#password').val();
    let action = 'login_doctor';
    const data = {
      username,
      password,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.href = '/doctor/dashboard';
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        } else {
          failedLogin();
        }
      },
    });
  });

  // admin login
  $('#add_admin').submit(function (e) {
    e.preventDefault();
    let username = $('#username').val();
    let firstname = $('#firstname').val();
    let lastname = $('#lastname').val();
    let usertype = $('#usertype').val();
    let department = $('#department').val();
    let password = $('#password').val();

    let verify = verifyPassword(password);
    if (!verify) {
      $('.not_verified').removeClass('hidden');
      return;
    }

    let action;
    if (usertype == 'doctor') {
      action = 'add_doctor';
    } else {
      action = 'add_admin';
    }
    const data = {
      username,
      firstname,
      lastname,
      usertype,
      department,
      password,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        } else if (res == 'exists') {
          failedAddAdmin();
        }
      },
    });
  });

  // patient registration
  $('#register_account').submit(function (e) {
    e.preventDefault();

    let firstname = $('#firstname').val();
    let lastname = $('#lastname').val();
    let number = $('#number').val();
    let email = $('#email').val();
    let birthday = $('#birthday').val();
    let age = $('#age').val();
    let address = $('#address').val();
    let password = $('#password').val();
    let confirm_pass = $('#confirm_pass').val();
    let weight = $('#weight').val();
    let height = $('#height').val();
    let bloodtype = $('#bloodtype').val();
    let gender = $("input[name='gender']:checked").val() || '';
    let action = 'register';

    let verify = verifyPassword(password);
    if (!verify) {
      $('.not_verified').removeClass('hidden');
      return;
    }

    if (password != confirm_pass) {
      $('.pwddm').removeClass('hidden');
      return;
    }

    const data = {
      firstname,
      lastname,
      number,
      email,
      birthday,
      age,
      gender,
      address,
      password,
      weight,
      height,
      bloodtype,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      beforeSend: function () {
        $('.loading-screen').removeClass('hidden');
      },
      success: function (res) {
        if (res == 'exists') {
          failedFunction();
        } else {
          $('.loading-screen').addClass('hidden');
          successFunction();
        }
      },
    });
  });

  // add physician
  $('#add_physician').submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        }
      },
    });
  });

  // add services
  $('#add_services').submit(function (e) {
    e.preventDefault();

    let title = $('#title').val();
    let description = $('#description').val();
    let action = 'add_services';

    const data = {
      title,
      description,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        }
      },
    });
  });

  // add precaution
  $('#add_precaution').submit(function (e) {
    e.preventDefault();

    let title = $('#title').val();
    let description = $('#description').val();
    let action = 'add_precaution';

    const data = {
      title,
      description,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        }
      },
    });
  });

  // resend email verification to user
  $('#reverify').submit(function (e) {
    e.preventDefault();
    let email = $('#email').val();
    let action = 'reverify';

    const data = {
      email,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'verified') {
          alreadyVerified();
        } else if (res == 'success') {
          reverifySuccess();
        } else {
          reverifyFailed();
        }
      },
    });
  });

  // resend email verification to user
  $('#forgot_password').submit(function (e) {
    e.preventDefault();
    let email = $('#email').val();
    let action = 'forgot';

    const data = {
      email,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'success') {
          forgotSuccess();
        } else {
          forgotFailed();
        }
      },
    });
  });

  // create new password
  $('#change_password').submit(function (e) {
    e.preventDefault();

    let email = $('#reset_email').val();
    let signature = $('#reset_signature').val();
    let password = $('#password').val();
    let confirm_pass = $('#confirm_pass').val();
    let action = 'new_password';

    let verify = verifyPassword(password);
    if (!verify) {
      $('.not_verified').removeClass('hidden');
      return;
    }

    if (password != confirm_pass) {
      return $('.pwddm').removeClass('hidden');
    }

    const data = {
      email,
      signature,
      password,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.href = '/login';
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        }
      },
    });
  });

  // request document
  $('#request_document').submit(function (e) {
    e.preventDefault();
    let patient_id = $('#patient_id').val();
    let request = $('#request_type').val();
    let doctor_id = $('#doctor_id').val();
    let patient_name = $('#patient_name').val();
    let name;
    let request_type;
    let action = 'request_document';
    if (request === 'Others') {
      request_type = $('#request_others').val();
    } else {
      request_type = $('#request_type option:selected').text();
    }

    if (doctor_id == 'others') {
      name = $('#name').val();
    } else {
      name = $('#doctor_id option:selected').text();
    }

    const data = {
      patient_id,
      patient_name,
      request_type,
      doctor_id,
      name,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        setTimeout(function () {
          window.location.reload();
        }, 3000);

        $('.loading-screen').removeClass('hidden');
      },
    });
  });

  // upload document
  $('#upload_file').submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        }
      },
    });
  });

  // upload document
  $('#edit_file').submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        }
      },
    });
  });

  // upload document
  $('#edit_prescription').submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        }
      },
    });
  });

  // approve medical request
  $('#approve_medicalid').on('click', function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let action = 'approve_request';
    let data = {
      id,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        }
      },
    });
  });

  $('#add_predictive_data').submit(function (e) {
    e.preventDefault();

    let month = parseInt($('#add_month').val());
    let year = parseInt($('#add_year').val());
    let name = $("input[name='add_name[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cjanuary = $("input[name='add_january_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cfebruary = $("input[name='add_february_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cmarch = $("input[name='add_march_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let capril = $("input[name='add_april_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cmay = $("input[name='add_may_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cjune = $("input[name='add_june_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cjuly = $("input[name='add_july_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let caugust = $("input[name='add_august_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cseptember = $("input[name='add_september_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let coctober = $("input[name='add_october_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cnovember = $("input[name='add_november_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cdecember = $("input[name='add_december_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pjanuary = $("input[name='add_january_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pfebruary = $("input[name='add_february_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pmarch = $("input[name='add_march_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let papril = $("input[name='add_april_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pmay = $("input[name='add_may_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pjune = $("input[name='add_june_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pjuly = $("input[name='add_july_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let paugust = $("input[name='add_august_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pseptember = $("input[name='add_september_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let poctober = $("input[name='add_october_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pnovember = $("input[name='add_november_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pdecember = $("input[name='add_december_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();

    let prec_prev = $("input[name='add_symptoms[]']")
      .map(function () {
        return $(this).val();
      })
      .get();

    let contruct_data = [];
    for (let i = 0; i < name.length; i++) {
      let pp = prec_prev[i].trim().split(',').filter(Boolean);
      contruct_data.push({
        disease: name[i],
        current: [
          parseInt(cjanuary[i]),
          parseInt(cfebruary[i]),
          parseInt(cmarch[i]),
          parseInt(capril[i]),
          parseInt(cmay[i]),
          parseInt(cjune[i]),
          parseInt(cjuly[i]),
          parseInt(caugust[i]),
          parseInt(cseptember[i]),
          parseInt(coctober[i]),
          parseInt(cnovember[i]),
          parseInt(cdecember[i]),
        ],
        previous: [
          parseInt(pjanuary[i]),
          parseInt(pfebruary[i]),
          parseInt(pmarch[i]),
          parseInt(papril[i]),
          parseInt(pmay[i]),
          parseInt(pjune[i]),
          parseInt(pjuly[i]),
          parseInt(paugust[i]),
          parseInt(pseptember[i]),
          parseInt(poctober[i]),
          parseInt(pnovember[i]),
          parseInt(pdecember[i]),
        ],
        prec_prev: pp,
      });
    }
    let action = 'add_predictive_data';

    const data = {
      month,
      year,
      data: contruct_data,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/post_function.php',
      data: data,
      success: function (res) {
        if (res == 'success') {
          setTimeout(function () {
            window.location.reload();
          }, 3000);

          $('.loading-screen').removeClass('hidden');
        }
      },
    });
  });

  // upload file
  $('.upload_medical').on('click', function (e) {
    let id = $(this).attr('data-id');

    uploadFile(id);
  });

  // edit medical file
  $('.uupload_medical').on('click', function (e) {
    let id = $(this).attr('data-id');
    let filename = $(this).attr('data-file-name');
    let style = $(this).attr('data-style');

    uuploadFile(id, filename, style);
  });

  // edit prescription file
  $('.uupload_prescription').on('click', function (e) {
    let id = $(this).attr('data-id');
    let filename = $(this).attr('data-file-name');
    let style = $(this).attr('data-style');

    uuploadPrescription(id, filename, style);
  });

  // approve medical request
  $('.approve_medical').on('click', function (e) {
    let id = $(this).attr('data-id');

    approveMedical(id);
  });

  // edit predictive
  $('.edit_predictive').on('click', function (e) {
    let id = $(this).attr('data-id');
    let month = $(this).attr('data-month');
    let year = $(this).attr('data-year');
    let datas = $(this).attr('data-datas');

    editPredictive(id, month, year, datas);
  });
});

// success register
function successFunction() {
  setTimeout(() => {
    document.getElementById('register_account').reset();
    document.getElementById('modal-box').classList.remove('hidden');
    document.getElementById('modal-bg').classList.remove('hidden');
  }, 1000);
}

// when email exists
function failedFunction() {
  $('.ee').removeClass('hidden');
}

// failed loging in
function failedLogin() {
  $('.el').removeClass('hidden');
}

function notVerified() {
  document.getElementById('login_patient').reset();
  document.getElementById('modal-box3').classList.remove('hidden');
  document.getElementById('modal-bg3').classList.remove('hidden');
}

function reverifySuccess() {
  document.getElementById('reverify').reset();
  document.getElementById('modal-box4').classList.remove('hidden');
  document.getElementById('modal-bg4').classList.remove('hidden');
}

function forgotSuccess() {
  document.getElementById('forgot_password').reset();
  document.getElementById('forgot_modalbg').classList.remove('hidden');
  document.getElementById('forgot_modal').classList.remove('hidden');
}

function alreadyVerified() {
  document.getElementById('reverify').reset();
  document.getElementById('modal-box5').classList.remove('hidden');
  document.getElementById('modal-bg5').classList.remove('hidden');
}

function reverifyFailed() {
  $('.rev').removeClass('hidden');
}

function forgotFailed() {
  $('.fgt').removeClass('hidden');
}

function uploadFile(id) {
  document.getElementById('id').value = id;
  document.getElementById('upload_modalbg').classList.remove('hidden');
  document.getElementById('upload_modal').classList.remove('hidden');
}

function uuploadFile(id, filename, style) {
  document.getElementById('file_name').classList.add(style);
  document.getElementById('file_name').textContent = filename + '.pdf';
  document.getElementById('edit_id').value = id;
  document.getElementById('remove_medical').dataset.id = id;
  document.getElementById('uupload_modalbg').classList.remove('hidden');
  document.getElementById('uupload_modal').classList.remove('hidden');
}

function uuploadPrescription(id, filename, style) {
  document.getElementById('prescription_name').classList.add(style);
  document.getElementById('prescription_name').textContent = filename + '.pdf';
  document.getElementById('prescription_id').value = id;
  document.getElementById('remove_prescription').dataset.id = id;
  document.getElementById('uupload_prescriptionbg').classList.remove('hidden');
  document.getElementById('uupload_prescription').classList.remove('hidden');
}

function approveMedical(id) {
  document.getElementById('approve_medicalid').dataset.id = id;
  document.getElementById('approve_medicalbg').classList.remove('hidden');
  document.getElementById('approve_medical').classList.remove('hidden');
}

function failedAddAdmin() {
  $('.uau').removeClass('hidden');
}

function editPredictive(id, month, year, datas) {
  document.getElementById('edit_id').value = id;
  document.getElementById('edit_month').value = month;
  document.getElementById('edit_year').value = year;
  setPredictiveData(datas);
  document.getElementById('edit_predictive_modelbg').classList.remove('hidden');
  document.getElementById('edit_predictive_model').classList.remove('hidden');
}

// set predictive edit data
var tf = false;
function setPredictiveData(datas) {
  let data = JSON.parse(datas);
  // console.log(data.length);
  if (tf) return;
  tf = true;
  for (let i = 0; i < data.length; i++) {
    let rowno;
    rowno = $('#disease_table_edit div').length;
    rowno = 'add' + (rowno + 1);
    rowno = rowno.trim();
    let del =
      i == 0
        ? ''
        : `<input type='button' class='px-4 py-1 text-white font-light tracking-wider bg-gray-950 hover:bg-gray-900 rounded mt-2' value='Delete' onclick="delete_row2('${rowno}')">`;
    $('#disease_table_edit').append(`<div id='${rowno}'>
      <label class='block text-sm text-gray-600 mt-6'>Disease Information</label>
      <input type='text' value='${data[i].disease}' name='edit_name[]' placeholder='Disease Name' class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required>
      <table class="w-full">
           <thead class="w-full">
               <th><label class='block text-sm text-gray-600 mt-2'>Previous Year</label></th>
               <th><label class='block text-sm text-gray-600 mt-2'>Current Year</label></th>
           </thead>
           <tbody>
               <tr>
                   <td><input type='number' value='${data[i].previous[0]}' name='edit_january_previous[]' placeholder="January" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[0]}' name='edit_january_current[]' placeholder="January" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[1]}' name='edit_february_previous[]' placeholder="February" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[1]}' name='edit_february_current[]' placeholder="February" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[2]}' name='edit_march_previous[]' placeholder="March" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[2]}' name='edit_march_current[]' placeholder="March" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[3]}' name='edit_april_previous[]' placeholder="April" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[3]}' name='edit_april_current[]' placeholder="April" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[4]}' name='edit_may_previous[]' placeholder="May" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[4]}' name='edit_may_current[]' placeholder="May" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[5]}' name='edit_june_previous[]' placeholder="June" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[5]}' name='edit_june_current[]' placeholder="June" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[6]}' name='edit_july_previous[]' placeholder="July" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[6]}' name='edit_july_current[]' placeholder="July" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[7]}' name='edit_august_previous[]' placeholder="August" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[7]}' name='edit_august_current[]' placeholder="August" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[8]}' name='edit_september_previous[]' placeholder="September" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[8]}' name='edit_september_current[]' placeholder="September" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[9]}' name='edit_october_previous[]' placeholder="October" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[9]}' name='edit_october_current[]' placeholder="October" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[10]}' name='edit_november_previous[]' placeholder="November" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[10]}' name='edit_november_current[]' placeholder="November" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' value='${data[i].previous[11]}' name='edit_december_previous[]' placeholder="December" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' value='${data[i].current[11]}' name='edit_december_current[]' placeholder="December" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
           </tbody>
       </table><input type='text' value='${data[i].prec_prev}' name='edit_symptoms[]' placeholder='Sign & Symptoms (separated by comma ',')' class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded mt-2' required>
        ${del}
      </div>`);
  }
}

// function for verifying password
function verifyPassword(password) {
  // Check if the password length is at least 8 characters.
  if (password.length < 8) {
    return false;
  }

  // Check if the password contains at least one special character and one digit.
  const specialCharacterRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/\-]/;
  const digitRegex = /\d/;

  if (!specialCharacterRegex.test(password) || !digitRegex.test(password)) {
    return false;
  }

  // If all conditions are met, return true to indicate a valid password.
  return true;
}
