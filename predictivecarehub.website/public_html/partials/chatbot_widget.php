<style>
    #chatbot-widget .chatbot-msg { line-height: 1.5; font-size: 0.9rem; }
    #chatbot-widget .chatbot-msg p { margin: 0 0 0.5em; }
    #chatbot-widget .chatbot-msg p:last-child { margin-bottom: 0; }
    #chatbot-widget .chatbot-msg ol,
    #chatbot-widget .chatbot-msg ul { margin: 0.25em 0 0.5em; padding-left: 1.25em; }
    #chatbot-widget .chatbot-msg ol { list-style: decimal; }
    #chatbot-widget .chatbot-msg ul { list-style: disc; }
    #chatbot-widget .chatbot-msg li { margin-bottom: 0.25em; }
    #chatbot-widget .chatbot-msg li:last-child { margin-bottom: 0; }
    #chatbot-widget .chatbot-msg strong { font-weight: 700; }
</style>
<!-- Help assistant widget -->
<div id="chatbot-widget" class="fixed bottom-6 right-6 z-[1000] font-family-karla">
    <button id="chatbot-toggle" class="w-14 h-14 rounded-full bg-sidebar text-white shadow-lg flex items-center justify-center hover:opacity-90 focus:outline-none" aria-label="Open help assistant">
        <i class="fas fa-comment-dots text-xl"></i>
    </button>

    <div id="chatbot-panel" class="hidden flex flex-col absolute bottom-16 right-0 w-[90vw] max-w-sm h-[70vh] max-h-[520px] bg-white rounded-lg shadow-2xl overflow-hidden border border-gray-200">
        <div class="bg-sidebar text-white px-4 py-3 flex items-center justify-between">
            <span class="font-semibold">PredictiveCareHub Assistant</span>
            <button id="chatbot-close" class="text-white hover:opacity-75" aria-label="Close help assistant">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="chatbot-messages" class="flex-1 overflow-y-auto p-3 space-y-2 bg-gray-50 text-sm">
            <div class="chatbot-msg chatbot-msg-bot bg-gray-200 text-gray-800 rounded-lg px-3 py-2 max-w-[85%]">
                Hi! I can help you use this website &mdash; registering, logging in, requesting documents, or finding your way around your dashboard. What do you need help with?
            </div>
        </div>
        <form id="chatbot-form" class="border-t border-gray-200 p-2 flex gap-2">
            <input id="chatbot-input" type="text" maxlength="1000" placeholder="Ask about using this site..." class="flex-1 px-3 py-2 text-sm bg-gray-100 rounded focus:outline-none" autocomplete="off" required>
            <button type="submit" class="bg-sidebar text-white px-3 rounded hover:opacity-90" aria-label="Send message">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </div>
</div>

<script src="/js/chatbot.js?v=<?php echo time(); ?>"></script>
