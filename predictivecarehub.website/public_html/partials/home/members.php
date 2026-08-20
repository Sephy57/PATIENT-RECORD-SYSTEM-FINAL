<section class="px-5 md:px-[10%] lg:px-[15%] py-12" id="physician">
    <h1 class="text-center my-10 text-3xl md:text-5xl text-gray-900 font-bold">Physician</h1>
    <div class=" flex flex-col lg:flex-row w-full gap-5">
        <div class="flex flex-col lg:flex-row flex-wrap justify-center gap-5 items-center">

            <?php

            $sql = "SELECT physician_name, physician_role, physician_profile FROM physicians";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $delay = 0;
                while ($row = mysqli_fetch_assoc($result)) {
            ?>

                    <div data-aos="zoom-in" data-aos-delay="<?php echo $delay; ?>" class="w-full lg:w-[23%] bg-doctor text-center aspect-[9/16] rounded-md overflow-hidden group">
                        <div class="member-background h-[100%] flex flex-col justify-end items-between">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['physician_profile']); ?>" class="object-cover group-hover:scale-150 transition" loading="lazy">
                            <div class="py-5 px-2 bg-sidebar group-hover:opacity-0 transition">
                                <h1 class="text-[#EFEFF1] text-xl font-bold capitalize"><?php echo $row['physician_name']; ?></h1>
                                <p class="text-gray-400 font-bold text-medium"><?php echo $row['physician_role']; ?></p>
                            </div>
                        </div>
                    </div>

            <?php
                    $delay += 100;
                }
            } else {
                echo "<center><div class='text-gray-900 text-xl px-5 py-3 rounded text-center w-100'>No Physicians Available</div><center>";
            }
            ?>

        </div>
    </div>
</section>