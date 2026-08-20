<!-- MODAL EDIT PHYSICIAN -->

<div id="edit_physician_modelbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden  z-[998]"></div>
<div id="edit_physician_model" class="w-[90%] sm:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6  z-[999] px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <form class="flex flex-col gap-3" id="edit_physician" enctype="multipart/form-data">
        <div>
            <p class="text-lg text-gray-800 font-medium pb-2">Edit Physician</p>
            <input class="hidden" name="action" value="edit_physician">
            <input class="hidden" id="edit_id" name="id">
            <div class="mt-2">
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="edit_name" name="fullname" type="text" required placeholder="Full name" aria-label="Full name">
            </div>
            <div class="mt-2">
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="edit_role" name="role" type="text" required placeholder="Specialization" aria-label="Specialization">
            </div>
            <div class="mt-2">
                <label class=" block text-sm text-gray-600" for="profile">Profile</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" name="profile" type="file" placeholder="Profile" aria-label="Profile" accept="image/*">
                <span class="text-sm text-green-500">Leave blank if you don't want to change.</span>
            </div>
            <div>
                <div class="mt-6 text-right">
                    <button class="px-4 py-1 text-gray-900 font-light tracking-wider bg-gray-200 hover:bg-gray-100 rounded close_physician_modelbg" type="button">Cancel</button>
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>