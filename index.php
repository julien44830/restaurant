<?php
include 'config/start_session.php';
include 'config/conn_bdd.php';
include 'templates/head.php';
include 'templates/nav.php';

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    include 'index_admin.php';
} else {
    $sql = "SELECT id, file_path, legend FROM images";
    $result = $conn->query($sql);
?>

<main class="pb-5">
    <div class="text-center ">
        <h1 class="pt-5"></h1>
    </div>

		<div class="container height_img">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h2 class="mt-5">Bienvenue chez nous !</h2>
            <p>Le quai antique vous accueille dans une ambiance chaleureuse et traditionnelle.</p>
        </div>
    </div>

    <div class="row pb-5 gx-3">
		<div class="swiper-container text-center" style="overflow-x: hidden;">
            <div class="swiper-wrapper">
                <?php
                // Place the result pointer at the beginning of the results
                mysqli_data_seek($result, 0);

                // Generate <img> tags for each image path
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="swiper-slide">';
                        echo '<div class="photo-container">';
                        echo '<img src="' . $row["file_path"] . '" alt="' . $row["legend"] . '" title="' . $row["legend"] . '" name="" class="img-fluid img-thumbnail custom-image">';
                        echo '<span class="title">' . $row["legend"] . '</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                };
                ?>
            </div>
        </div>
    </div>
</main>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>


<script>
            const title = document.querySelector("h1");
            const text = "Le Quai Antique";

            function typewriter(text, index) {
                if (index < text.length) {
                    setTimeout(() => {
                        title.innerHTML += `<span>${text[index]}</span>`;
                        typewriter(text, index + 1);
                    }, 123);
                }
            }

            setTimeout(() => {
                typewriter(text, 0);
            }, 10);
        </script>


<?php
}

include 'templates/footer.php';
?>