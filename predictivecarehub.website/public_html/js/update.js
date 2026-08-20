$(document).ready(function () {
  // update account information
  $('#update_account').submit(function (e) {
    e.preventDefault();

    let firstname = $('#firstname').val();
    let lastname = $('#lastname').val();
    let email = $('#email').val();
    let birthday = $('#birthday').val();
    let age = $('#age').val();
    let address = $('#address').val();
    let weight = $('#weight').val();
    let height = $('#height').val();
    let bloodtype = $('#bloodtype').val();
    let gender = $("input[name='gender']:checked").val() || '';

    const data = {
      firstname,
      lastname,
      email,
      birthday,
      age,
      gender,
      address,
      weight,
      height,
      bloodtype,
      type: 'profile',
    };

    $.ajax({
      type: 'POST',
      url: '../functions/patient_profile_update.php',
      data: data,
      success: function (res) {
        if (res == 1) {
          updateProfile();
        }
      },
    });
  });

  // update password
  $('#update_password').submit(function (e) {
    e.preventDefault();

    let email = $('#email').val();
    let oldpass = $('#oldpassword').val();
    let password = $('#password').val();
    let confirm_pass = $('#confirm_pass').val();

    if (password != confirm_pass) {
      $('.pwddm').addClass('block');
      $('.pwddm').removeClass('hidden');
      return;
    }

    const data = {
      email,
      oldpass,
      password,
      type: 'password',
    };

    $.ajax({
      type: 'POST',
      url: '../functions/patient_profile_update.php',
      data: data,
      success: function (res) {
        if (res == 2) {
          updatePassword();
        } else {
          incorrect();
        }
      },
    });
  });

  // update admin account
  $('#update_admin').submit(function (e) {
    e.preventDefault();

    let id = $('#edit_id').val();
    let username = $('#edit_username').val();
    let firstname = $('#edit_firstname').val();
    let lastname = $('#edit_lastname').val();
    let usertype = $('#edit_usertype').val();
    let password = $('#edit_password').val();
    let action = 'update_admin';

    if (password.length == 0) {
      password = $('#edit_password').val();
    } else {
      let verify = verifyPassword(password);
      if (!verify) {
        $('.not_verified').removeClass('hidden');
        return;
      }
    }

    const data = {
      id,
      username,
      firstname,
      lastname,
      usertype,
      password,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/update_function.php',
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

  // update admin account
  $('#update_doctor').submit(function (e) {
    e.preventDefault();

    let id = $('#edit_id').val();
    let username = $('#edit_username').val();
    let firstname = $('#edit_firstname').val();
    let lastname = $('#edit_lastname').val();
    let department = $('#edit_department').val();
    let password = $('#edit_password').val();
    let action = 'update_doctor';

    if (password.length == 0) {
      password = $('#edit_password').val();
    } else {
      let verify = verifyPassword(password);
      if (!verify) {
        $('.not_verified').removeClass('hidden');
        return;
      }
    }

    const data = {
      id,
      username,
      firstname,
      lastname,
      department,
      password,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/update_function.php',
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

  // update physician
  $('#edit_physician').submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: '../functions/update_function.php',
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

  // update services
  $('#edit_services').submit(function (e) {
    e.preventDefault();
    let id = $('#edit_id').val();
    let title = $('#edit_title').val();
    let description = $('#edit_description').val();
    let action = 'edit_services';

    const data = {
      id,
      title,
      description,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/update_function.php',
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

  // update precaution
  $('#edit_precaution').submit(function (e) {
    e.preventDefault();
    let id = $('#edit_pid').val();
    let title = $('#edit_ptitle').val();
    let description = $('#edit_pdescription').val();
    let action = 'edit_precaution';

    const data = {
      id,
      title,
      description,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/update_function.php',
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
  
  //update predictive data

  $('#update_predictive_data').submit(function (e) {
    e.preventDefault();

    let id = $('#edit_id').val();
    let month = parseInt($('#edit_month').val());
    let year = parseInt($('#edit_year').val());
    let name = $("input[name='edit_name[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cjanuary = $("input[name='edit_january_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cfebruary = $("input[name='edit_february_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cmarch = $("input[name='edit_march_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let capril = $("input[name='edit_april_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cmay = $("input[name='edit_may_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cjune = $("input[name='edit_june_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cjuly = $("input[name='edit_july_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let caugust = $("input[name='edit_august_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cseptember = $("input[name='edit_september_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let coctober = $("input[name='edit_october_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cnovember = $("input[name='edit_november_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let cdecember = $("input[name='edit_december_current[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pjanuary = $("input[name='edit_january_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pfebruary = $("input[name='edit_february_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pmarch = $("input[name='edit_march_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let papril = $("input[name='edit_april_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pmay = $("input[name='edit_may_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pjune = $("input[name='edit_june_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pjuly = $("input[name='edit_july_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let paugust = $("input[name='edit_august_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pseptember = $("input[name='edit_september_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let poctober = $("input[name='edit_october_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pnovember = $("input[name='edit_november_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();
    let pdecember = $("input[name='edit_december_previous[]']")
      .map(function () {
        return $(this).val();
      })
      .get();

    let prec_prev = $("input[name='edit_symptoms[]']")
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
    let action = 'edit_predictive_data';

    const data = {
      id,
      month,
      year,
      data: contruct_data,
      action,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/update_function.php',
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

  $('.select_data').on('click', function (e) {
    e.preventDefault();

    let id = $(this).attr('data-id');

    const data = {
      id,
      action: 'select_data',
    };

    $.ajax({
      type: 'POST',
      url: '../functions/update_function.php',
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
});

// patient profile update success
function updateProfile() {
  document.getElementById('profu').classList.remove('hidden');

  setTimeout(() => {
    document.getElementById('profu').classList.add('hidden');
  }, 3000);
}

// patient password update success
function updatePassword() {
  document.getElementById('passu').classList.remove('hidden');
  document.getElementById('update_password').reset();

  setTimeout(() => {
    document.getElementById('passu').classList.add('hidden');
  }, 3000);
}

// password did not match
function incorrect() {
  document.getElementById('incorrect').classList.remove('hidden');
}

// when username already exists
function failedAddAdmin() {
  $('.uau').removeClass('hidden');
}
