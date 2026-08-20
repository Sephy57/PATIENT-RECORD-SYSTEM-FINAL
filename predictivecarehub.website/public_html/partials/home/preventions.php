<section class="px-5 md:px-[10%] lg:px-[15%] pt-16 pb-[150px] bg-sidebar overflow-x-hidden">
    <h1 class="text-center my-10 text-5xl text-[#EFEFF1] font-bold"><span class="text-orange-500">Precaution &</span> Prevention</h1>

    <div class="flex flex-col lg:flex-row text-gray-50 flex-wrap">
        <?php
        $sql = "SELECT title, description FROM precaution_information";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $delay = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                    <div class='w-full lg:w-1/3 px-5 my-5' data-aos='zoom-in' data-aos-delay=" . $delay . " >
                        <h1 class='text-2xl font-bold'>" . $row['title'] . "</h1>
                        <p>" . $row['description'] . "</p>
                    </div>
                    ";
                if ($delay == 300) {
                    $delay = -100;
                }

                $delay += 100;
            }
            echo "</div>";
        } else {
            echo "
            </div><center><h1 class='text-white text-center text-xl px-5 py-3 rounded'>No Precautions Available</h1></center>";
        }
        ?>
</section>