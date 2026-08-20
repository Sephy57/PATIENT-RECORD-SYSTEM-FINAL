<!-- UPLOAD FILE MODAL -->
<div id="upload_modalbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden"></div>
<div id="upload_modal" class="w-[90%] sm:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <form class="flex flex-col gap-3" id="upload_file" enctype="multipart/form-data">
        <div>
            <p class="text-lg text-gray-800 font-medium pb-2">Upload File</p>
            <input class="hidden" value="upload_file" name="action" type="text">
            <input class="hidden" id="id" name="id" type="number">
            <div class="mt-2">
                <label class=" block text-sm text-gray-600" for="file_document">Document</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="file_document" name="file_document" type="file" required placeholder="Document" aria-label="Document" accept=".pdf">
            </div>
            <div>
                <div class="mt-6 text-right">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Upload</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- EDIT MEDICAL FILE MODAL -->
<div id="uupload_modalbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden z-[9]"></div>
<div id="uupload_modal" class="w-[90%] sm:w-auto flex flex-col items-center gap-2 z-[10] -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <form class="flex flex-col gap-3" id="edit_file" enctype="multipart/form-data">
        <div>
            <p class="text-lg text-gray-800 font-medium pb-2">Edit File</p>
            <input class="hidden" value="edit_file" name="action" type="text">
            <input class="hidden" id="edit_id" name="edit_id" type="number">
            <div class="mt-2">
                <label class=" block text-sm text-gray-600" for="edit_document">Document</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="edit_document" name="edit_document" type="file" required placeholder="Document" aria-label="Document" accept=".pdf">
                <p class="text-sm w-full px-3 py-2 bg-blue-200 mt-2 rounded " id="file_name"></p>
            </div>
            <div>
                <div class="mt-6 text-right">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-red-600 hover:bg-red-500 rounded remove_medical" type="button" id="remove_medical" data-id="">Remove</button>
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Upload</button>
                </div>
            </div>
        </div>
    </form>
</div>


<!-- EDIT PRESCRIPTION FILE MODAL -->
<div id="uupload_prescriptionbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden z-[9]"></div>
<div id="uupload_prescription" class="w-[90%] sm:w-auto flex flex-col items-center gap-2 z-[10] -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <form class="flex flex-col gap-3" id="edit_prescription" enctype="multipart/form-data">
        <div>
            <p class="text-lg text-gray-800 font-medium pb-2">Edit Prescription</p>
            <input class="hidden" value="edit_prescription" name="action" type="text">
            <input class="hidden" id="prescription_id" name="prescription_id" type="number">
            <div class="mt-2">
                <label class=" block text-sm text-gray-600" for="prescription">Document</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="prescription" name="prescription" type="file" required placeholder="Document" aria-label="Document" accept=".pdf">
                <p class="text-sm w-full px-3 py-2 bg-blue-200 mt-2 rounded " id="prescription_name"></p>
            </div>
            <div>
                <div class="mt-6 text-right">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-red-600 hover:bg-red-500 rounded remove_prescription" type="button" id="remove_prescription" data-id="">Remove</button>
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Upload</button>
                </div>
            </div>
        </div>
    </form>
</div>