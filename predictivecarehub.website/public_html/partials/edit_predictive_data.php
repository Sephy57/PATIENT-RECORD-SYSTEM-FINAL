<div id="edit_predictive_modelbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 z-[99] fixed hidden"></div>
 <div id="edit_predictive_model" class="w-[90%] sm:w-auto flex flex-col items-center gap-2 z-[100] -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed max-h-[95vh] overflow-y-auto hidden">
     <form class="flex flex-col gap-3 overflow" id="update_predictive_data">
         <div class="overflow">
             <p class="text-lg text-gray-800 font-medium pb-2">Edit Predictive Data</p>
             <input class="hidden" id="edit_id" name="edit_id">
             <div class="inline-block mt-2 w-full sm:w-1/2 pr-0 sm:pr-1">
                 <label class="block text-sm text-gray-600" for="edit_month">Select Month</label>
                 <select name="month" id="edit_month" class="w-full px-2  py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" required>
                     <option value="1">January</option>
                     <option value="2">February</option>
                     <option value="3">March</option>
                     <option value="4">April</option>
                     <option value="5">May</option>
                     <option value="6">June</option>
                     <option value="7">July</option>
                     <option value="8">August</option>
                     <option value="9">September</option>
                     <option value="10">October</option>
                     <option value="11">November</option>
                     <option value="12">December</option>
                 </select>
             </div>
             <div class="inline-block mt-2 -mx-0  sm:-mx-1 pl-0 sm:pl-1 w-full sm:w-1/2">
                 <label class="block text-sm text-gray-600" for="edit_year">Select Year</label>
                 <select id="edit_year" name="year" class="w-full px-2  py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg">
                     <option value="">Select Year</option>
                     <?php
                        $year_start  = 1990;
                        $year_end = date('Y'); // current Year

                        for ($i = $year_start; $i <= $year_end; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
                        }
                        ?>
                 </select>
             </div>
             <div id="disease_table_edit">

             </div>
             <div class="mt-2">
                 <input class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="button" onclick="add_row()" value="Add Row">
             </div>

             <div>
                 <div class="mt-6 text-right">
                     <button class="px-4 py-1 text-gray-900 font-light tracking-wider bg-gray-200 hover:bg-gray-100 rounded close_predictive_modelbg" type="button">Cancel</button>
                     <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Update</button>
                 </div>
             </div>
         </div>
     </form>
 </div>