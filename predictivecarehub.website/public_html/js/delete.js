$(document).ready(function () {
  // delete post request
  $('#delete_data').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    const data = {
      id,
      action: type,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/delete_function.php',
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

  // archive post request
  $('#archive_data').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    const data = {
      id,
      action: type,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/delete_function.php',
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

  // unarchive post request
  $('#unarchive_data').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    const data = {
      id,
      action: type,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/delete_function.php',
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

  // remove file request
  $('#remove_file').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    const data = {
      id,
      action: type,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/delete_function.php',
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

  // remove prescription file request
  $('#remove_prescription').on('click', function (e) {
    let id = $(this).attr('data-id');
    let type = $(this).attr('data-delete-type');

    const data = {
      id,
      action: type,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/delete_function.php',
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

  // remove predictive data
  $('#remove_predictive_data').on('click', function (e) {
    let id = $(this).attr('data-delete-id');

    const data = {
      id,
      action: 'delete_predictive_data',
    };

    $.ajax({
      type: 'POST',
      url: '../functions/delete_function.php',
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

  // delete service
  $('.delete_service').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    deleteItem(id, type);
  });

  // delete precaution
  $('.delete_precaution').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    deleteItem(id, type);
  });
  // delete physician
  $('.delete_physician').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    deleteItem(id, type);
  });

  // delete patient
  $('.delete_patient').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    deleteItem(id, type);
  });

  // delete admin
  $('.delete_admin').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    deleteItem(id, type);
  });

  // delete doctor
  $('.delete_doctor').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    deleteItem(id, type);
  });

  // delete medical record
  $('.delete_medical').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    deleteItem(id, type);
  });

  // archive medical record
  $('.archive_medical').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    archiveItem(id, type);
  });

  // unarchive medical record
  $('.unarchive_medical').on('click', function (e) {
    let id = $(this).attr('data-delete-id');
    let type = $(this).attr('data-delete-type');

    unarchiveItem(id, type);
  });

  // remove medical file
  $('.remove_medical').on('click', function (e) {
    let id = $(this).attr('data-id');

    removeFile(id);
  });

  // remove prescription file
  $('.remove_prescription').on('click', function (e) {
    let id = $(this).attr('data-id');

    removePrescription(id);
  });

  // remove prescription file
  $('.delete_predictive').on('click', function (e) {
    let id = $(this).attr('data-delete-id');

    deletePredictive(id);
  });
});

// delete items(all)
function deleteItem(id, type) {
  document.getElementById('warning_deletionbg').classList.remove('hidden');
  document.getElementById('warning_deletion').classList.remove('hidden');
  document.getElementById('delete_data').dataset.deleteId = id;
  document.getElementById('delete_data').dataset.deleteType = type;
}

// archive medical records
function archiveItem(id, type) {
  document.getElementById('warning_archivebg').classList.remove('hidden');
  document.getElementById('warning_archive').classList.remove('hidden');
  document.getElementById('archive_data').dataset.deleteId = id;
  document.getElementById('archive_data').dataset.deleteType = type;
}

// unarchive medical records
function unarchiveItem(id, type) {
  document.getElementById('warning_unarchivebg').classList.remove('hidden');
  document.getElementById('warning_unarchive').classList.remove('hidden');
  document.getElementById('unarchive_data').dataset.deleteId = id;
  document.getElementById('unarchive_data').dataset.deleteType = type;
}

// remove medical file
function removeFile(id) {
  document.getElementById('warning_deletefilebg').classList.remove('hidden');
  document.getElementById('warning_deletefile').classList.remove('hidden');
  document.getElementById('remove_file').dataset.deleteId = id;
  document.getElementById('remove_file').dataset.deleteType = 'remove_file';
}

// delete predictive data
function deletePredictive(id) {
  document
    .getElementById('warning_delete_predictivebg')
    .classList.remove('hidden');
  document
    .getElementById('warning_delete_predictive')
    .classList.remove('hidden');
  document.getElementById('remove_predictive_data').dataset.deleteId = id;
}

// remove precription file
function removePrescription(id) {
  document
    .getElementById('warning_deleteprescriptionbg')
    .classList.remove('hidden');
  document
    .getElementById('warning_deleteprescription')
    .classList.remove('hidden');
  document.getElementById('remove_prescription').dataset.deleteId = id;
  document.getElementById('remove_prescription').dataset.deleteType =
    'remove_prescription';
}
