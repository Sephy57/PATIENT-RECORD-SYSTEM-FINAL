<section class="px-5 md:px-[10%] lg:px-[15%] bg-sidebar py-12 text-center" id="services">
    <h1 class="text-center mt-10 mb-5 text-3xl md:text-5xl text-white font-bold">Services</h1>
    <div class="mb-12 flex justify-center" data-aos="zoom-in">
        <p class="text-white w-full lg:w-[75%] ">At PredictiveCare Hub, we take pride in offering a diverse range of healthcare services designed to cater to your unique needs. Our dedicated team of medical professionals is committed to providing top-notch care and ensuring your well-being every step of the way. </p>
    </div>
    <div class=" flex flex-col md:flex-row justify-center gap-5 w-full text-center flex-wrap">
        <?php
        $sql = "SELECT service_name, description FROM services";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $delay = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                        <div class='w-full lg:w-[45%] xl:w-[20%] aspect-square bg-[#EFEFF1] hover:bg-[rgba(255,255,255,1)] shadow rounded-3xl p-6 flex flex-col justify-center items-center cursor-pointer services-item' data-aos='zoom-in' data-aos-delay=" . $delay . " >
                            <h1 class='font-bold mb-3 text-xl text-gray-900 uppercase'>" . $row['service_name'] . "</h1>
                            <p class='text-sm  text-gray-800'>" . $row['description'] . "</p>
                        </div>
                    ";
                if ($delay == 300) {
                    $delay = -100;
                }

                $delay += 100;
            }
        } else {
            echo "<h1 class='text-white text-xl px-5 py-3 rounded'>No Services Available</h1>";
        }
        ?>
    </div>
    <div class="mt-12 flex justify-center" data-aos="zoom-in" data-aos-delay="300">
        <p class="text-white w-full lg:w-[50%] ">At [Hospital Name], your health is our priority. We're dedicated to providing comprehensive, compassionate care that supports your overall well-being. Explore our services and let us be your partner on your healthcare journey. </p>
    </div>
</section>