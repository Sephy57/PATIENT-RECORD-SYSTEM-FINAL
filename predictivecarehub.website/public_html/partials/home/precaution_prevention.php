<section class="px-5 md:px-[10%] lg:px-[15%] pt-16 pb-[150px] bg-sidebar overflow-x-hidden" id="precprev">
    <h1 class="text-center my-10 text-5xl text-[#EFEFF1] font-bold">Predictive Analytics</h1>

    <div class="carousel" data-carousel>
        <?php
        $monthWords = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
        $sql = "SELECT id, selected, year, month, createdAt FROM predictive_information ORDER BY CAST(year AS SIGNED) DESC, MONTH(month) DESC LIMIT 20";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

        ?>
            <label class=" block text-md text-gray-50" for="analysis_date">Select Date:</label>
            <select name="analysis_date" id="analysis_date" class="px-2  mb-5 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" required>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = $row['selected'] == 1 ? 'selected' : '';

                    echo "<option value=" . $row['id'] . " " . $selected . ">" . $monthWords[$row['month']] . " " . $row['year'] . "</option>";
                }

                ?>
            </select>
        <?php
        }
        ?>

        <!-- <input class="px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="analysis_date" name="analysis_date" type="date" required aria-label="Birthday"> -->
        <div class="flex justify-between mt-5">
            <button class="carousel-button prev" data-carousel-button="prev"><i class="fas fa-solid fa-arrow-left"></i></button>
            <button class="carousel-button next" data-carousel-button="next"><i class="fas fa-solid fa-arrow-right"></i></button>
        </div>
        <div data-slides id="carousel" class="transition-opacity duration-500 ease-in-out slider">

        </div>
        </div>
</section>