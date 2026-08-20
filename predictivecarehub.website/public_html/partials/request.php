<!-- REQUEST DOCUMENT MODAL -->
<div id="request_modelbg" class=" z-[9] w-full h-full bg-[rgba(0,0,0,.6)] top-0 fixed hidden"></div>
<div id="request_model" class=" z-[10] w-[90%] sm:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
    <form class="flex flex-col gap-3" id="request_document">
        <div>
            <p class="text-lg text-gray-800 font-medium pb-2">Request Document</p>

            <input class="hidden" value="<?php echo $_SESSION['user_id']; ?>" id="patient_id" name="patient_id" type="text" readonly disabled>
            <div class="mt-2">
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="patient_name" name="patient_name" type="text" required placeholder="Name of patient" aria-label="Username">
            </div>
            <div class="mt-2">
                <label class="block text-sm text-gray-600" for="request_type">Select Type of Request</label>
                <select name="request_type" id="request_type" class="w-full px-2  py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" required>
                    <option value="Birth Certificate">Birth Certificate</option>
                    <option value="Death Certificate">Death Certificate</option>
                    <option value="Discharge Summary">Discharge Summary</option>
                    <option value="Medication List">Medication List</option>
                    <option value="Operative Reports">Operative Reports</option>
                    <option value="Laboratory and Diagnostic Test Result">Laboratory and Diagnostic Test Result</option>
                    <option value="Treatment Details">Treatment Details</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="mt-2 hidden request_type">
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="request_others" name="request_others" type="text" placeholder="Document to Request" aria-label="Username">
            </div>
            <div class="mt-2">
                <label class="block text-sm text-gray-600" for="doctor_id">Select Incharge Doctor</label>
                <select name="doctor_id" id="doctor_id" class="w-full px-2  py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" required>
                    <?php
                    $sql = "SELECT doctor_id, firstname, lastname FROM doctors";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row['firstname'] . " " . $row['lastname'];
                            echo "<option value=" . $row['doctor_id'] . ">" . $name . "</option>";
                        }
                    }
                    ?>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="mt-2 hidden req">
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="name" name="name" type="text" placeholder="Name of Doctor" aria-label="Doctor">
            </div>
            <div x-data="{ agreed: false }">
                <div class="mt-2">
                    <label for="agree" x-on:click="agreed = !agreed">
                        <input type="checkbox" id="agree" x-model="agreed"> <span>I have read and agree to </span><a href="/legal/terms" class="text-blue-500 hover:text-blue-600" target="_blank">Terms and Conditions.</a></span>
                    </label>
                </div>
                <div class="mt-6 text-right">
                    <button class="px-4 py-1 text-gray-900 font-light tracking-wider bg-gray-200 hover:bg-gray-100 rounded close_request" type="button">Cancel</button>
                    <button x-bind:class="agreed ? 'px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded' : 'px-4 py-1 text-white font-light tracking-wider bg-gray-500 rounded disable-button'" type="submit" x-bind:disabled="!agreed">Request</button>
                </div>
            </div>
        </div>
    </form>
</div>