<!-- WARNING DELETION -->
<div id="warning_deletionbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden"></div>
<div id="warning_deletion" class="w-[90%] lg:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-orange-500 w-11 p-1 fill-white" viewBox="0 0 64 512">
        <path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
    </svg>
    <span class="mt-2 text-2xl font-medium">Are you sure you want to delete this item?</span>
    <p class="text-center">Deleting items cannot be undone.</p>
    <div class="flex gap-5">
        <button class="mt-3 p-3 bg-red-500 hover:bg-red-600 rounded-full px-12 text-gray-50 text-center shadow" id="delete_data" data-delete-type='' data-delete-id=''>Delete</button>
        <button class="mt-3 p-3 bg-gray-500 hover:bg-gray-600 rounded-full px-12 text-gray-50 text-center shadow close_warning">Cancel</button>
    </div>
</div>

<!-- WARNING ARCHIVE MEDICAL RECORDS MODAL -->
<div id="warning_archivebg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden"></div>
<div id="warning_archive" class="w-[90%] lg:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-orange-500 w-11 p-1 fill-white" viewBox="0 0 64 512">
        <path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
    </svg>
    <span class="mt-2 text-xl font-medium">Are you sure you want to move this medical record to archive?</span>
    <div class="flex gap-5">
        <button class="mt-3 p-3 bg-orange-500 hover:bg-orange-600 rounded-full px-12 text-gray-50 text-center shadow" id="archive_data" data-delete-type='' data-delete-id=''>Archive</button>
        <button class="mt-3 p-3 bg-gray-500 hover:bg-gray-600 rounded-full px-12 text-gray-50 text-center shadow close_warning">Cancel</button>
    </div>
</div>

<!-- WARNING UNARCHIVE MEDICAL RECORDS MODAL -->
<div id="warning_unarchivebg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden"></div>
<div id="warning_unarchive" class="w-[90%] lg:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-orange-500 w-11 p-1 fill-white" viewBox="0 0 64 512">
        <path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
    </svg>
    <span class="mt-2 text-xl font-medium">Are you sure you want to unarchive this medical record?</span>
    <div class="flex gap-5">
        <button class="mt-3 p-3 bg-orange-500 hover:bg-orange-600 rounded-full px-12 text-gray-50 text-center shadow" id="unarchive_data" data-delete-type='' data-delete-id=''>Unarchive</button>
        <button class="mt-3 p-3 bg-gray-500 hover:bg-gray-600 rounded-full px-12 text-gray-50 text-center shadow close_warning">Cancel</button>
    </div>
</div>

<!-- WARNING DELETE FILE IN RECORD MODAL -->
<div id="warning_deletefilebg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden z-[99]"></div>
<div id="warning_deletefile" class="w-[90%] lg:w-auto flex flex-col items-center gap-2  z-[100] -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-orange-500 w-11 p-1 fill-white" viewBox="0 0 64 512">
        <path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
    </svg>
    <span class="mt-2 text-2xl font-medium">Are you sure you want to remove this medical file?</span>
    <p class="text-center">Removing medical file cannot be undone.</p>
    <div class="flex gap-5">
        <button class="mt-3 p-3 bg-orange-500 hover:bg-orange-600 rounded-full px-12 text-gray-50 text-center shadow remove_file" id="remove_file">Remove</button>
        <button class="mt-3 p-3 bg-gray-500 hover:bg-gray-600 rounded-full px-12 text-gray-50 text-center shadow close_warning">Cancel</button>
    </div>
</div>

<!-- WARNING DELETE PRESCRIPTION IN RECORD MODAL -->
<div id="warning_deleteprescriptionbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden z-[99]"></div>
<div id="warning_deleteprescription" class="w-[90%] lg:w-auto flex flex-col items-center gap-2  z-[100] -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-orange-500 w-11 p-1 fill-white" viewBox="0 0 64 512">
        <path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
    </svg>
    <span class="mt-2 text-2xl font-medium">Are you sure you want to remove this precription file?</span>
    <p class="text-center">Removing precription file cannot be undone.</p>
    <div class="flex gap-5">
        <button class="mt-3 p-3 bg-orange-500 hover:bg-orange-600 rounded-full px-12 text-gray-50 text-center shadow remove_prescription" id="remove_prescription">Remove</button>
        <button class="mt-3 p-3 bg-gray-500 hover:bg-gray-600 rounded-full px-12 text-gray-50 text-center shadow close_warning">Cancel</button>
    </div>
</div>

<!-- WARNING DELETE DATA IN PREDICTIVE MODAL -->
<div id="warning_delete_predictivebg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden z-[99]"></div>
<div id="warning_delete_predictive" class="w-[90%] lg:w-auto flex flex-col items-center gap-2  z-[100] -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-orange-500 w-11 p-1 fill-white" viewBox="0 0 64 512">
        <path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
    </svg>
    <span class="mt-2 text-2xl font-medium">Are you sure you want to delete this item?</span>
    <p class="text-center">Deleting items cannot be undone.</p>
    <div class="flex gap-5">
        <button class="mt-3 p-3 bg-red-500 hover:bg-red-600 rounded-full px-12 text-gray-50 text-center shadow remove_predictive_data" id="remove_predictive_data">Remove</button>
        <button class="mt-3 p-3 bg-gray-500 hover:bg-gray-600 rounded-full px-12 text-gray-50 text-center shadow close_warning">Cancel</button>
    </div>
</div>