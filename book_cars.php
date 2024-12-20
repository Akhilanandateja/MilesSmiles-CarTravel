<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Cars</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <!-- Custom CSS styles -->
    <style>
        body {
            background-color: black;
        }
        .filter-section {
            margin-bottom: 20px;
            max-width: 76%;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .filter-section label {
            margin-right: 10px;
            color: white;
        }
        .filter-section select {
            margin-right: 20px;
        }
        .card {
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border-style: none !important;
            height: 100%;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .card-img-top {
            padding: 10px;
            height: auto;
            object-fit: cover;
            transition: transform .5s;
        }
        .card-img-top:hover {
            transform: scale(1.1);
        }
        .btn-book-now {
            margin-top: auto;
            width: 100%;
            background-color: #FF4C4C;
            border: none;
            color: white;
        }
        .body {
            padding: 20px;
            background-color: black;
        }
        .about-section {
            display: flex;
            padding: 50px;
            text-align: center;
            background-image: url('images/benz1.png');
            height: 50%;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: black;
        }
        .about-section h1 {
            color: white;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            color: white;
            font-family: 'Times New Roman', Times, serif;
        }
        i {
            color: #B2ACAC;
        }
        @media (max-width: 768px) {
            .filter-section {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
<div class="about-section">
    <h1>Book A Car</h1>
</div>
<br><br><br>
<div class="filter-section">
    <label for="price-filter"><b>Price (₹/day):</b></label>
    <select id="price-filter">
        <option value="all">All</option>
        <option value="1600.00">₹1600</option>
        <option value="2000.00">₹2000</option>
        <option value="2500.00">₹2500</option>
        <option value="3000.00">₹3000</option>
        <option value="3500.00">₹3500</option>
        <option value="4000.00">₹4000</option>
        <option value="7000.00">₹7000</option>
    </select>

    <label for="seating-filter"><b>Seating Capacity:</b></label>
    <select id="seating-filter">
        <option value="all">All</option>
        <option value="4">4 persons</option>
        <option value="6">6 persons</option>
        <option value="11">11 persons</option>
    </select>

    <label for="ac-filter"><b>AC/Non-AC:</b></label>
    <select id="ac-filter">
        <option value="all">All</option>
        <option value="ac">AC</option>
        <option value="non-ac">Non-AC</option>
    </select>
</div>
<br>
<h1><b>Choose the best here.</b></h1>
<br>
<div class="body">
    <div class="row" id="car-list">
        <?php
        include 'connect.php';

        $query = "SELECT car_id, car_name, price_per_day, seating_capacity, ac_status, image_url FROM cars";
        $result = mysqli_query($conn, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $car_id = $row['car_id'];
                $car_name = $row['car_name'];
                $price_per_day = $row['price_per_day'];
                $seating_capacity = $row['seating_capacity'];
                $ac_status = $row['ac_status'];
                $image_url = $row['image_url'];

                echo '<div class="col-md-4 mb-4 car-item" data-price="' . $price_per_day . '" data-seating="' . $seating_capacity . '" data-ac="' . strtolower($ac_status) . '">';
                echo '<div class="card">';
                echo '<img src="' . $image_url . '" class="card-img-top" alt="' . $car_name . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title"><i class="fa-solid fa-car"></i>&nbsp&nbsp' . $car_name . '</h5>';
                echo '<p class="card-text"><i class="fa-solid fa-fan"></i>&nbsp&nbsp&nbspAC status: ' . $ac_status . '</p>';
                echo '<p class="card-text"><i class="fa-solid fa-money-bill-1-wave"></i>&nbsp&nbsp&nbspPrice: ₹' . $price_per_day . '</p>';
                echo '<p class="card-text"><i class="fa-solid fa-users"></i>&nbsp&nbsp&nbspCapacity: ' . $seating_capacity . '</p>';
                // Book Now button to redirect to details page
                echo '<form action="car_details.php" method="GET">';
                echo '<input type="hidden" name="car_id" value="' . $car_id . '">';
                echo '<button type="submit" class="btn btn-book-now">Book Now</button>';
                echo '</form>';
                echo '</div>'; // close card-body
                echo '</div>'; // close card
                echo '</div>'; // close col-md-4
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
        ?>
    </div> <!-- close row -->
</div> <!-- close container -->

<?php include 'footer.php'; ?>

<!-- JavaScript for filtering -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#price-filter, #seating-filter, #ac-filter').change(function() {
            var price = $('#price-filter').val();
            var seating = $('#seating-filter').val();
            var ac = $('#ac-filter').val();

            $('.car-item').each(function() {
                var carPrice = $(this).data('price');
                var carSeating = $(this).data('seating');
                var carAc = $(this).data('ac');

                var show = true;

                if (price !== 'all' && carPrice !== price) {
                    show = false;
                }

                if (seating !== 'all' && carSeating != seating) {
                    show = false;
                }

                if (ac !== 'all' && carAc !== ac) {
                    show = false;
                }

                $(this).toggle(show);
            });
        });
    });
</script>
</body>
</html>
