<!-- APPROVE MEDICAL REQUEST MODAL -->
<div id="approve_medicalbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden z-[99]"></div>
<div id="approve_medical" class="w-[90%] lg:w-auto flex flex-col items-center gap-2  z-[100] -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-green-500 w-11 p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7" />
    </svg>
    <span class="mt-2 text-xl font-medium">Are you sure you want to approve this medical request?</span>
    <div class="flex gap-5">
        <button class="mt-3 p-3 bg-green-500 hover:bg-green-600 rounded-full px-12 text-gray-50 text-center shadow approve_medical" id="approve_medicalid">Approve</button>
        <button class="mt-3 p-3 bg-gray-500 hover:bg-gray-600 rounded-full px-12 text-gray-50 text-center shadow close_warning">Cancel</button>
    </div>
</div>