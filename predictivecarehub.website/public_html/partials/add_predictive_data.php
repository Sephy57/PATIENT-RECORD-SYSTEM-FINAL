 <!-- MODAL ADD DATA -->

 <div id="add_predictive_modelbg" class="w-full h-full bg-[rgba(0,0,0,.6)] top-0 z-[99] fixed hidden"></div>
 <div id="add_predictive_model" class="w-[90%] sm:w-auto flex flex-col items-center gap-2 z-[100] -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed max-h-[95vh] overflow-y-auto hidden">
     <form class="flex flex-col gap-3 overflow" id="add_predictive_data">
         <div class="overflow">
             <p class="text-lg text-gray-800 font-medium pb-2">Add Predictive Data to Display</p>
             <div class="inline-block mt-2 w-full sm:w-1/2 pr-0 sm:pr-1">
                 <label class="block text-sm text-gray-600" for="add_month">Select Month</label>
                 <select name="month" id="add_month" class="w-full px-2  py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg">
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
                 <label class="block text-sm text-gray-600" for="add_year">Select Year</label>
                 <select id="add_year" name="year" class="w-full px-2  py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg">
                     <?php
                        $year_start  = 1990;
                        $year_end = date('Y'); // current Year

                        for ($i = $year_end; $i >= $year_start; $i--) {
                            echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
                        }
                        ?>
                 </select>
             </div>
             <div id="disease_table_add">
                 <label class='block text-sm text-gray-600 mt-2'>Disease Information</label>
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
                 </table>
                 <input type='text' name='add_symptoms[]' placeholder="Sign & Symptoms (separated by comma)" class='w-full px-2 py-2 text-gray-700 bg-gray-200 rounded mt-2' required>
             </div>
             <div class="mt-2">
                 <input class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="button" onclick="add_row2()" value="Add Row">
             </div>

             <div>
                 <div class="mt-6 text-right">
                    <button class="px-4 py-1 text-gray-900 font-light tracking-wider bg-gray-200 hover:bg-gray-100 rounded close_predictive_modelbg" type="button">Cancel</button>
                     <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Save Data</button>
                 </div>
             </div>
         </div>
     </form>
 </div>