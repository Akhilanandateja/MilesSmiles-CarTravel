<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <title>Homepage</title>
    <style>
        /* Reset and General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: black; /* Set background color to black */
            color: white; /* Set text color to white */
            line-height: 1.6;
        }

        /* Header Styles (Assuming styles are in header.php) */
        /* Modify as per your header styling */

        /* Slider Styles */
        .slider {
            width: 100%;
            overflow: hidden;
            height: 300px; /* Set initial height of slider */
            position: relative;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease;
            height: 100%; /* Ensure slides occupy full height of slider */
        }

        .slides img {
            width: 50%; /* Display two images side by side */
            height: auto;
            flex-shrink: 0; /* Prevent images from shrinking */
        }

        /* Section Styles */
        .image-text-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px;
        }

        .image-text-section1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 20px;
            padding-right: 20px;
        }

        .section-img {
            width: 50%;
            height: auto;
        }

        .section-text {
            width: 45%;
            color: white;
        }

        .section-text h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #FF4C4C;
        }

        .section-text p {
            font-size: 20px;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .p {
            font-size: 40px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .section-text .b {
            color: #FF4C4C;
        }

        /* Infinite Loop Styles */
        .infinite-loop {
            width: 100%;
            overflow: hidden;
            height: 200px; /* Adjust height as needed */
            position: relative;
        }

        .loop-images {
            display: flex;
            width:auto;
            transition: transform 0.5s ease;
            height: 100%; /* Ensure images occupy full height of loop */
            animation: loop-animation 20s linear infinite;
        }
        .loop-images img {
            width: auto;
            height: 100%;
            flex-shrink: 0; /* Prevent images from shrinking */
            margin-right: 0; /* No space between images */
        }

        @keyframes loop-animation {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Media Queries (Adjust as needed) */
        @media (max-width: 1024px) {
            .image-text-section {
                flex-direction: column;
            }

            .image-text-section1 {
                flex-direction: column;
                align-items: center;
            }

            .section-img {
                width: 100%;
                margin-bottom: 20px;
            }

            .section-text {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .slider {
                height: 200px; /* Adjust slider height for smaller screens */
            }

            .slides img {
                width: 100%; /* Display one image at a time on small screens */
            }

            .image-text-section,
            .image-text-section1 {
                flex-direction: column;
                align-items: center;
            }

            .section-img {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>


    <div class="slider">
        <div class="slides">
            <img src="images/1.png" alt="Slide 1">
            <img src="images/2.png" alt="Slide 2">
            <img src="images/ford.png" alt="Slide 3">
            <img src="images/hyundai.png" alt="Slide 4">
            <img src="images/mahindra.png" alt="Slide 5">
            <img src="images/3.png" alt="Slide 6">
            <img src="images/4.png" alt="Slide 7">
        </div>
    </div>

    <section class="image-text-section">
        <img src="images/home1.png" alt="Section Image" class="section-img">
        <div class="section-text">
            <h2>Welcome to Our Service</h2>
            <p>Miles & Smiles Travels, nestled in the coastal beauty of Vizag, invites you to embark 
                on unforgettable journeys across India. Whether you're dreaming of exploring the serene 
                beaches of Goa, experiencing the vibrant culture of Rajasthan, or trekking through the 
                Himalayan foothills, we curate journeys that resonate with your spirit of adventure.
                 With a passion for travel and a commitment to quality service, Miles & Smiles Travels 
                 ensures that every trip is a seamless blend of comfort, 
                 discovery, and cherished memories. Our meticulously planned itineraries and experienced guides 
                 make your travel experience smooth and hassle-free. 
From luxurious accommodations to authentic local experiences, we cater to all your travel needs. Imagine savoring
 delicious regional cuisines, immersing yourself in the rich history and traditions of ancient cities.
</p>
        </div>
    </section>

    <section class="image-text-section">

        <div class="section-text">
            <h2>MOST RELIABLE CAR RENTAL SERVICE IN INDIA</h2><br>
            <p>🔸Miles & Smiles Car Travels & rentals Service is the best 
            car travel and rental service in India. With affordable rates
            and 24/7 customer service, it is the ideal platform for tourists 
            exploring India.
            </p>
            <p>🔸Save yourself some time by scheduling services right here. 
            After clicking on BOOK NOW, we will be in touch to confirm 
            your service appointment and vehicle reservation.
             It does not get much easier than that.</p>
        </div>
        <img src="images/2car1.png" alt="Section Image" class="section-img">
    </section>

    <section class="image-text-section1">
        <img src="images/book1.png" alt="section image" class="section-img">
        <div class="p">
            <p><b class="p"><i class="fa-solid fa-grip-lines-vertical"></i></b> Airport Pickup<br><b class="p">
            <i class="fa-solid fa-grip-lines-vertical"></i></b> Breakdown Assistance<br><b class="p">
            <i class="fa-solid fa-grip-lines-vertical"></i></b> Emergency Service</p>
        </div>
    </section>

    <!-- Infinite Loop Section -->
    <div class="infinite-loop">
        <div class="loop-images">
            <img src="images/breeza.png" alt="Loop Image 1">
            <img src="images/freestyle.png" alt="Loop Image 2">
            <img src="images/i20.png" alt="Loop Image 3">
            <img src="images/swift.png" alt="Loop Image 4">
            <img src="images/scorpio.png" alt="Loop Image 5">
            <img src="images/hexa.png" alt="Loop Image 1"> <!-- Repeat images for seamless looping -->
            <img src="images/tiago.png" alt="Loop Image 2">
            <img src="images/creat.png" alt="Loop Image 3">
            <img src="images/skoda.png" alt="Loop Image 4">
            <img src="images/innova.png" alt="Loop Image 5">
            <img src="images/breeza.png" alt="Loop Image 1">
            <img src="images/freestyle.png" alt="Loop Image 2">
            <img src="images/i20.png" alt="Loop Image 3">
            <img src="images/swift.png" alt="Loop Image 4">
            <img src="images/scorpio.png" alt="Loop Image 5">
            <img src="images/hexa.png" alt="Loop Image 1"> <!-- Repeat images for seamless looping -->
            <img src="images/tiago.png" alt="Loop Image 2">
            <img src="images/creat.png" alt="Loop Image 3">
            <img src="images/skoda.png" alt="Loop Image 4">
            <img src="images/innova.png" alt="Loop Image 5">
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- JavaScript for slider -->
    <script>
        const slides = document.querySelector('.slides');
        const slideImages = document.querySelectorAll('.slides img');
        let index = 0;
        const slideCount = slideImages.length;
        const intervalTime = 3000;

        function updateSlidePosition() {
            const slideWidth = slideImages[0].clientWidth;
            slides.style.transform = `translateX(${-index * slideWidth}px)`;
        }

        function nextSlide() {
            if (index >= slideCount - 2) {
                index = 0;
            } else {
                index++;
            }
            updateSlidePosition();
        }

        setInterval(nextSlide, intervalTime); // Change slide every 3 seconds (3000 milliseconds)

        window.addEventListener('resize', updateSlidePosition); // Update slide position on window resize
    </script>
</body>
</html>
