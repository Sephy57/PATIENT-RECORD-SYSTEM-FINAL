<!-- MODAL ADD PHYSICIAN -->

<div id="add_physician_modelbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden  z-[998]"></div>
<div id="add_physician_model" class="w-[90%] sm:w-auto flex flex-col items-center gap-2 -translate-y-1/2  z-[999] py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <form class="flex flex-col gap-3" id="add_physician" enctype="multipart/form-data">
        <div>
            <p class="text-lg text-gray-800 font-medium pb-2">Add Physician</p>
            <input class="hidden" id="action" name="action" value="add_physician">
            <div class="mt-2">
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="fullname" name="fullname" type="text" required placeholder="Full name" aria-label="Full name">
            </div>
            <div class="mt-2">
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="role" name="role" type="text" required placeholder="Specialization" aria-label="Specialization">
            </div>
            <div class="mt-2">
                <label class=" block text-sm text-gray-600" for="profile">Profile</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="profile" name="profile" type="file" required placeholder="Profile" aria-label="Profile" accept="image/*">
            </div>
            <div>
                <div class="mt-6 text-right">
                    <button class="px-4 py-1 text-gray-900 font-light tracking-wider bg-gray-200 hover:bg-gray-100 rounded close_physician_modelbg" type="button">Cancel</button>
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>