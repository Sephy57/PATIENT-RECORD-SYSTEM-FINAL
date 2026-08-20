 <!-- MODAL LOGIN SUCCESS -->

 <div id="edit_doctor_modelbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 z-[99] fixed hidden"></div>
 <div id="edit_doctor_model" class="w-[90%] sm:w-auto flex flex-col items-center gap-2 z-[100] -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
     <form class="flex flex-col gap-3" id="update_doctor">
         <div>
             <p class="text-lg text-gray-800 font-medium pb-2">Edit Doctor</p>
             <input class="hidden" id="edit_id" name="edit_doctor">
             <div class="mt-2">
                 <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="edit_username" name="username" type="text" required placeholder="Username" aria-label="Username">
                 <span class="hidden text-sm text-red-500 uau">Username already exists.</span>
             </div>
             <div class="inline-block mt-2 w-full sm:w-1/2 pr-0 sm:pr-1">
                 <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="edit_firstname" name="firstname" type="text" required placeholder="First name" aria-label="First name">
             </div>
             <div class="inline-block mt-2 -mx-0  sm:-mx-1 pl-0 sm:pl-1 w-full sm:w-1/2">
                 <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="edit_lastname" name="lastname" type="text" required placeholder="Last name" aria-label="Last name">
             </div>
             <div class="mt-2">
                 <label class="block text-sm text-gray-600" for="department">Select Doctor Department</label>
                 <select name="department" id="edit_department" class="w-full px-2  py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg">
                     <option value="Cardiology">Cardiology Department</option>
                     <option value="Orthopedics">Orthopedics Department</option>
                     <option value="General Surgery">General Surgery Department</option>
                     <option value="Plastic and Reconstructive Surgery">Plastic and Reconstructive Surgery Department</option>
                     <option value="Obstetrics and Gynecology">Obstetrics and Gynecology Department</option>
                     <option value="Pediatrics">Pediatrics Department</option>
                     <option value="Neurology">Neurology Department</option>
                     <option value="Gastroenterology">Gastroenterology Department</option>
                     <option value="Psychiatry">Psychiatry Department</option>
                     <option value="Radiology">Radiology Department</option>
                 </select>
             </div>
             <div class="mt-2">
                 <span class="text-sm text-green-500">Leave blank if you don't want to change.</span>
                 <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="edit_password" name="lastname" type="password" placeholder="Password" aria-label="Password">
                 <p class="hidden text-sm text-red-500 not_verified">Password must contain 8 characters or longer,</p>
                 <p class="hidden text-sm text-red-500 not_verified">one special character and one number.</p>
             </div>
             <div>
                 <div class="mt-6 text-right">
                     <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Update</button>
                 </div>
             </div>
         </div>
     </form>
 </div>