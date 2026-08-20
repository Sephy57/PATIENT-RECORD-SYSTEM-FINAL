// CSRF token bootstrap — see js/post.js for the same block. Pages load one
// or both of these two files, so it's duplicated here to guarantee coverage.
if (typeof CSRF_TOKEN === 'undefined') {
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
}

document.addEventListener('DOMContentLoaded', function () {
  const burger = document.querySelectorAll('.navbar-burger');
  const menu = document.querySelectorAll('.navbar-menu');

  if (burger.length && menu.length) {
    for (var i = 0; i < burger.length; i++) {
      burger[i].addEventListener('click', function () {
        for (var j = 0; j < menu.length; j++) {
          menu[j].classList.toggle('hidden');
        }
      });
    }
  }

  // close
  const close = document.querySelectorAll('.navbar-close');
  const backdrop = document.querySelectorAll('.navbar-backdrop');

  if (close.length) {
    for (var i = 0; i < close.length; i++) {
      close[i].addEventListener('click', function () {
        for (var j = 0; j < menu.length; j++) {
          menu[j].classList.toggle('hidden');
        }
      });
    }
  }

  if (backdrop.length) {
    for (var i = 0; i < backdrop.length; i++) {
      backdrop[i].addEventListener('click', function () {
        for (var j = 0; j < menu.length; j++) {
          menu[j].classList.toggle('hidden');
        }
      });
    }
  }
});

$(document).ready(function () {
  $('#contact_form').submit(function (e) {
    e.preventDefault();
    let name = $('#name').val();
    let email = $('#email').val();
    let message = $('#message').val();

    const data = {
      name,
      email,
      message,
    };

    $.ajax({
      type: 'POST',
      url: '../functions/contact_form.php',
      data: data,
      success: function (res) {
        sent();
      },
    });
  });

  $('#contact_modalbg').on('click', function () {
    $('#contact_modalbg').addClass('hidden');
    $('#contact_modal').addClass('hidden');
  });

  $('#contact_button').on('click', function () {
    $('#contact_modalbg').addClass('hidden');
    $('#contact_modal').addClass('hidden');
  });

  $('.home-btn').click(function () {
    const top = $('#home');
    if (top.length) {
      $('html,body').animate(
        {
          scrollTop: top.offset().top,
        },
        'slow'
      );
    }
  });

  $('.about-btn').click(function () {
    const top = $('#about');
    if (top.length) {
      $('html,body').animate(
        {
          scrollTop: top.offset().top,
        },
        'slow'
      );
    }
  });

  $('.services-btn').click(function () {
    const top = $('#services');
    if (top.length) {
      $('html,body').animate(
        {
          scrollTop: top.offset().top,
        },
        'slow'
      );
    }
  });

  $('.physician-btn').click(function () {
    const top = $('#physician');
    if (top.length) {
      $('html,body').animate(
        {
          scrollTop: top.offset().top,
        },
        'slow'
      );
    }
  });

  $('.precprev-btn').click(function () {
    const top = $('#precprev');
    if (top.length) {
      $('html,body').animate(
        {
          scrollTop: top.offset().top,
        },
        'slow'
      );
    }
  });

  $('.contact-btn').click(function () {
    const top = $('#contact');
    if (top.length) {
      $('html,body').animate(
        {
          scrollTop: top.offset().top,
        },
        'slow'
      );
    }
  });
});

function sent() {
  setTimeout(() => {
    document.getElementById('contact_form').reset();
    document.getElementById('contact_modalbg').classList.remove('hidden');
    document.getElementById('contact_modal').classList.remove('hidden');
  }, 1000);
}

// dynamic carousel
const buttons = document.querySelectorAll('[data-carousel-button]');

buttons.forEach((button) => {
  button.addEventListener('click', () => {
    const offset = button.dataset.carouselButton === 'next' ? 1 : -1;
    const slides = button
      .closest('[data-carousel]')
      .querySelector('[data-slides]');

    const activeSlide = slides.querySelector('[data-active]');
    let newIndex = [...slides.children].indexOf(activeSlide) + offset;
    if (newIndex < 0) newIndex = slides.children.length - 1;
    if (newIndex >= slides.children.length) newIndex = 0;

    slides.children[newIndex].dataset.active = true;
    delete activeSlide.dataset.active;
  });
});

// add new form for predictive data add mode
function add_row() {
  let rowno;
  rowno = $('#disease_table_edit div').length;
  rowno = 'add' + (rowno + 1);
  rowno = rowno.trim();
  $('#disease_table_edit').append(`<div id='${rowno}'>
      <label class='block text-sm text-gray-600 mt-6'>Disease Information</label>
      <input type='text' name='edit_name[]' placeholder='Disease Name' class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required>
      <table class="w-full">
           <thead class="w-full">
               <th><label class='block text-sm text-gray-600 mt-2'>Previous Year</label></th>
               <th><label class='block text-sm text-gray-600 mt-2'>Current Year</label></th>
           </thead>
           <tbody>
               <tr>
                   <td><input type='number' name='edit_january_previous[]' placeholder="January" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_january_current[]' placeholder="January" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_february_previous[]' placeholder="February" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_february_current[]' placeholder="February" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_march_previous[]' placeholder="March" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_march_current[]' placeholder="March" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_april_previous[]' placeholder="April" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_april_current[]' placeholder="April" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_may_previous[]' placeholder="May" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_may_current[]' placeholder="May" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_june_previous[]' placeholder="June" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_june_current[]' placeholder="June" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_july_previous[]' placeholder="July" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_july_current[]' placeholder="July" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_august_previous[]' placeholder="August" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_august_current[]' placeholder="August" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_september_previous[]' placeholder="September" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_september_current[]' placeholder="September" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_october_previous[]' placeholder="October" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_october_current[]' placeholder="October" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_november_previous[]' placeholder="November" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_november_current[]' placeholder="November" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='edit_december_previous[]' placeholder="December" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='edit_december_current[]' placeholder="December" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
           </tbody>
       </table><input type='text' name='edit_symptoms[]' placeholder='Sign & Symptoms (separated by comma ',')' class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded mt-2' required>
      <input type='button' class='px-4 py-1 text-white font-light tracking-wider bg-gray-950 hover:bg-gray-900 rounded mt-2' value='Delete' onclick="delete_row2('${rowno}')">
      </div>`);
}

function delete_row(rowno) {
  $(`#${rowno}`).remove();
}

// add form for predictive data edit mode
function add_row2() {
  let rowno;
  rowno = $('#disease_table_add div').length;
  rowno = 'add' + (rowno + 1);
  rowno = rowno.trim();
  $('#disease_table_add').append(`<div id='${rowno}'>
      <label class='block text-sm text-gray-600 mt-6'>Disease Information</label>
      <input type='text' name='add_name[]' placeholder='Disease Name' class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required>
      <table class="w-full">
           <thead class="w-full">
               <th><label class='block text-sm text-gray-600 mt-2'>Previous Year</label></th>
               <th><label class='block text-sm text-gray-600 mt-2'>Current Year</label></th>
           </thead>
           <tbody>
               <tr>
                   <td><input type='number' name='add_january_previous[]' placeholder="January" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_january_current[]' placeholder="January" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_february_previous[]' placeholder="February" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_february_current[]' placeholder="February" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_march_previous[]' placeholder="March" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_march_current[]' placeholder="March" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_april_previous[]' placeholder="April" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_april_current[]' placeholder="April" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_may_previous[]' placeholder="May" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_may_current[]' placeholder="May" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_june_previous[]' placeholder="June" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_june_current[]' placeholder="June" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_july_previous[]' placeholder="July" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_july_current[]' placeholder="July" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_august_previous[]' placeholder="August" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_august_current[]' placeholder="August" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_september_previous[]' placeholder="September" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_september_current[]' placeholder="September" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_october_previous[]' placeholder="October" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_october_current[]' placeholder="October" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_november_previous[]' placeholder="November" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_november_current[]' placeholder="November" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
               <tr>
                   <td><input type='number' name='add_december_previous[]' placeholder="December" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
                   <td><input type='number' name='add_december_current[]' placeholder="December" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded' required></td>
               </tr>
           </tbody>
       </table><input type='text' name='add_symptoms[]' placeholder='Sign & Symptoms (separated by comma ',')' class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded mt-2' required>
      <input type='button' class='px-4 py-1 text-white font-light tracking-wider bg-gray-950 hover:bg-gray-900 rounded mt-2' value='Delete' onclick="delete_row2('${rowno}')">
      </div>`);
}

function delete_row2(rowno) {
  $(`#${rowno}`).remove();
}
