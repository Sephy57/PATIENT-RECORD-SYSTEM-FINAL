(function () {
  function ready(fn) {
    if (document.readyState !== 'loading') fn();
    else document.addEventListener('DOMContentLoaded', fn);
  }

  ready(function () {
    var toggle = document.getElementById('chatbot-toggle');
    var panel = document.getElementById('chatbot-panel');
    var closeBtn = document.getElementById('chatbot-close');
    var form = document.getElementById('chatbot-form');
    var input = document.getElementById('chatbot-input');
    var messages = document.getElementById('chatbot-messages');

    if (!toggle || !panel || !form) return;

    toggle.addEventListener('click', function () {
      panel.classList.toggle('hidden');
      if (!panel.classList.contains('hidden')) input.focus();
    });

    closeBtn.addEventListener('click', function () {
      panel.classList.add('hidden');
    });

    function escapeHtml(text) {
      var div = document.createElement('div');
      div.textContent = text;
      return div.innerHTML;
    }

    // Minimal, safe markdown: escapes all HTML first, then only ever
    // introduces tags we author ourselves (never raw model output as HTML).
    function renderBotText(text) {
      var lines = text.replace(/\r\n/g, '\n').split('\n');
      var html = '';
      var listItems = [];
      var listType = null;

      function flushList() {
        if (listItems.length) {
          html += '<' + listType + '>' + listItems.join('') + '</' + listType + '>';
          listItems = [];
          listType = null;
        }
      }

      function inline(escaped) {
        return escaped.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
      }

      lines.forEach(function (rawLine) {
        var line = rawLine.trim();
        if (line === '') {
          flushList();
          return;
        }

        var numbered = line.match(/^\d+[.)]\s+(.*)$/);
        var bulleted = line.match(/^[-*]\s+(.*)$/);

        if (numbered) {
          if (listType !== 'ol') flushList();
          listType = 'ol';
          listItems.push('<li>' + inline(escapeHtml(numbered[1])) + '</li>');
        } else if (bulleted) {
          if (listType !== 'ul') flushList();
          listType = 'ul';
          listItems.push('<li>' + inline(escapeHtml(bulleted[1])) + '</li>');
        } else {
          flushList();
          html += '<p>' + inline(escapeHtml(line)) + '</p>';
        }
      });
      flushList();

      return html;
    }

    function addMessage(text, who) {
      var div = document.createElement('div');
      div.className =
        'chatbot-msg chatbot-msg-' +
        who +
        ' rounded-lg px-3 py-2 max-w-[85%] ' +
        (who === 'bot'
          ? 'bg-gray-200 text-gray-800'
          : 'bg-sidebar text-white ml-auto');

      if (who === 'bot') {
        div.innerHTML = renderBotText(text);
      } else {
        div.textContent = text;
      }

      messages.appendChild(div);
      messages.scrollTop = messages.scrollHeight;
    }

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var message = input.value.trim();
      if (!message) return;

      addMessage(message, 'user');
      input.value = '';
      input.disabled = true;

      var typing = document.createElement('div');
      typing.className =
        'chatbot-msg chatbot-msg-bot bg-gray-200 text-gray-500 rounded-lg px-3 py-2 max-w-[85%] italic';
      typing.textContent = 'Typing...';
      messages.appendChild(typing);
      messages.scrollTop = messages.scrollHeight;

      $.ajax({
        type: 'POST',
        url: '/functions/chatbot.php',
        data: { message: message },
        dataType: 'json',
      })
        .done(function (res) {
          typing.remove();
          if (res && res.reply) {
            addMessage(res.reply, 'bot');
          } else {
            addMessage(
              (res && res.error) || 'Something went wrong. Please try again.',
              'bot'
            );
          }
        })
        .fail(function (xhr) {
          typing.remove();
          var msg = 'Something went wrong. Please try again.';
          try {
            var parsed = JSON.parse(xhr.responseText);
            if (parsed && parsed.error) msg = parsed.error;
          } catch (err) {}
          addMessage(msg, 'bot');
        })
        .always(function () {
          input.disabled = false;
          input.focus();
        });
    });
  });
})();
