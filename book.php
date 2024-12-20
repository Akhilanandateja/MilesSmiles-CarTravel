<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miles & smiles</title>
<link rel="stylesheet" href="book.css"><!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Open+Sans&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
// script for filter
      document.addEventListener('DOMContentLoaded', () => {
    const priceFilter = document.getElementById('price-filter');
    const seatingFilter = document.getElementById('seating-filter');
    const acFilter = document.getElementById('ac-filter');
    const carCards = document.querySelectorAll('.card-wrapper');
  
    priceFilter.addEventListener('change', filterCards);
    seatingFilter.addEventListener('change', filterCards);
    acFilter.addEventListener('change', filterCards);
  
    function filterCards() {
      const price = priceFilter.value;
      const seating = seatingFilter.value;
      const ac = acFilter.value;
  
      carCards.forEach(card => {
        const cardPrice = card.getAttribute('data-price');
        const cardSeating = card.getAttribute('data-seating');
        const cardAC = card.getAttribute('data-ac');
  
        let show = true;
  
        if (price !== 'all' && cardPrice !== price) {
          show = false;
        }
  
        if (seating !== 'all' && cardSeating !== seating) {
          show = false;
        }
  
        if (ac !== 'all' && cardAC !== ac) {
          show = false;
        }
  
        card.style.display = show ? 'block' : 'none';
      });
    }
  });
// script for fixed message
// script.js
// function toggleMessage() {
//     const messageBox = document.getElementById('messageBox');
//     const toggleIcon = document.getElementById('toggleIcon');

//     if (messageBox.style.display === 'none') {
//         messageBox.style.display = 'block';
//         toggleIcon.innerHTML = '((🔔))'; // Display toggle icon ☰
//     } else {
//         messageBox.style.display = 'none';
//         toggleIcon.innerHTML = '((🔔))'; // Display open option
//     }
// }

// Show the message when the page is loaded
// document.addEventListener('DOMContentLoaded', () => {
//     const messageBox = document.getElementById('messageBox');
//     messageBox.style.display = 'block';
// });
// document.addEventListener('DOMContentLoaded', function() {
//     const container = document.querySelector('.container');
//     container.classList.add('loaded');
// });

// script for move top
let atTop = true;

function toggleScroll() {
    const rotation = document.querySelector('.back-to-top').style.transform;
    const newRotation = rotation === 'rotate(360deg)' ? 'rotate(0deg)' : 'rotate(360deg)';
    
    document.querySelector('.back-to-top').style.transform = newRotation;

    if(atTop) {
        window.scrollTo({top: document.body.scrollHeight, behavior: 'smooth'});
    } else {
        window.scrollTo({top: 0, behavior: 'smooth'});
    }
    
    atTop = !atTop;
}

// common username
function updateNavBar() {
    var loggedInUser = localStorage.getItem('loggedInUser');
    if (loggedInUser) {
        var authLink = document.getElementById('authLink');
        if (authLink) {
            authLink.innerHTML = loggedInUser;
            authLink.href = '#';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateNavBar();
});
// 
function updateNavBar() {
    var loggedInUser = localStorage.getItem('loggedInUser');
    var authLink = document.getElementById('authLink');

    if (loggedInUser) {
        authLink.innerHTML = '<span style="color: white; cursor: pointer;" onclick="showLogoutMessage()">' + loggedInUser + '</span>';
        authLink.href = '#'; // Optionally set the href attribute
    } else {
        // If not logged in, replace with signup link
        authLink.innerHTML = '#';
    }
}

// Function to show logout confirmation message (if needed)
function showLogoutMessage() {
    // Implement if you need a logout confirmation message
}

// Initialize navbar state on page load
document.addEventListener('DOMContentLoaded', function() {
    updateNavBar();
});
    </script>
</head>
<body>
  <?php include 'header.php'; ?>
  <!-- <div class="header">
    <img src="images/smiles.png" height="50" width="150" alt="kissan">
    <div class="header-right">
        <a href="index.html">Home</a>
        <a  href="about.html">About</a>
        <a href="contact.html">Contact Us</a>
        <a class="active" href="book.html">Book A Car</a>
        <span id="authLink"></span>
    </div>
</div> -->
    <br>
<br>
<div class="section">
  <div class="imgcontainer"><img src="images/multi1.png"></div>
  <div class="textcontainer">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem ratione commodi fugiat ex enim asperiores. Explicabo quas cupiditate est iste consequuntur nemo nesciunt dignissimos illo! Sed, illum! Nihil, excepturi eligendi. ipsum dolor sit amet consectetur adipisicing elit. Qui recusandae consequuntur aliquid cum nihil exercitationem repudiandae quis nostrum dolor perferendis? Beatae, quos accusamus quaerat aut voluptatem saepe unde cum porro!
  </div>

</div>
<br>
<br>
<br>

  <div class="filter-section">
    <label for="price-filter"><b>Price (₹/day):</b></label>
    <select id="price-filter">
      <option value="all">All</option>
      <option value="1600">₹1600</option>
      <option value="2000">₹2000</option>
      <option value="2500">₹2500</option>
      <option value="3000">₹3000</option>
      <option value="3500">₹3500</option>
      <option value="4000">₹4000</option>
      <option value="6000">₹6000</option>
      <option value="10000">₹10000</option>
      <option value="12000">₹12000</option>
    </select>
    
    <label for="seating-filter"><b>Seating Capacity:</b></label>
    <select id="seating-filter">
      <option value="all">All</option>
      <option value="4">4 persons</option>
      <option value="6">6 persons</option>
      <option value="11">11 persons</option>
      <option value="24">24 persons</option>
    </select>
    
    <label for="ac-filter"><b>AC/Non-AC:</b></label>
    <select id="ac-filter">
      <option value="all">All</option>
      <option value="ac">AC</option>
      <option value="non-ac">Non-AC</option>
    </select>
  </div>

<h1 class="text-center"><b>Choose the best here.</b></h1>

<div class="row car-section" id="car-cards">
 <!-- breeza ac -->
  <div class="col-lg-4 mb-5 card-wrapper" data-price="2000" data-seating="4" data-ac="ac">
    <div class="card shadow rounded">
      <img src="images/breeza.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Breeza (ac)</h5> <hr>
        <p class="card-text">👨‍👨‍👧‍👧 4 persons </p> <hr>
        <p class="card-text">₹2000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
      </div>
    </div>
  </div>

<!-- freestyle ac -->
  <div class="col-lg-4 mb-5 card-wrapper" data-price="2000" data-seating="4" data-ac="ac">
    <div class="card shadow rounded">
      <img src="images/freestyle.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Freestyle (ac)</h5> <hr>
        <p class="card-text">👨‍👨‍👧‍👧 4 persons </p> <hr>
        <p class="card-text">₹2000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
      </div>
    </div>
  </div>

<!-- i20 ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="2000" data-seating="4" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/i20.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">i20 (ac)</h5> <hr>
<p class="card-text">👨‍👨‍👧‍👧 4 persons </p> <hr>
            <p class="card-text">₹2000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>

<!-- swift ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="2000" data-seating="4" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/swift.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Swift (ac)</h5><hr>
<p class="card-text">👨‍👨‍👧‍👧 4 persons </p> <hr>
            <p class="card-text">₹2000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>


<!-- scorpio ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="3500" data-seating="6" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/scorpio.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Mahindra Scorpio (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦👨‍👩 6 persons </p> <hr>
            <p class="card-text">₹3500/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>

<!-- hexa ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="3500" data-seating="6" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/hexa.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Hexa (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦👨‍👩 6 persons </p> <hr>
            <p class="card-text">₹3500/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>

<!-- tiago ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="2000" data-seating="4" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/tiago.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Tata Tiago (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
            <p class="card-text">₹2000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>

<!-- baleno ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="2000" data-seating="4" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/baleno.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Baleno (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
            <p class="card-text">₹2000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>

<!-- creta ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="3000" data-seating="4" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/creat.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Hyundai Creta (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
           <p class="card-text">₹3000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>

<!-- menza ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="2000" data-seating="4" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/menza.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Tata Manza (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
            <p class="card-text">₹2000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>


<!-- skoda ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="2500" data-seating="4" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/skoda.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Skoda Superb (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
            <p class="card-text">₹2500/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>

<!-- toyota ac -->
        <div class="col-lg-4 mb-5 card-wrapper" data-price="4000" data-seating="6" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/toyota.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Toyota Innova (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦👨‍👩 6 persons </p> <hr>
            <p class="card-text">₹4000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>

<!-- traveller 11 ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="7000" data-seating="11" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/luxury.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Tempo Traveller (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦👨‍👩‍👧‍👦👨‍👩‍👧 11 persons </p> <hr>
            <p class="card-text">₹7000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
      </div>

<!-- traveller 24 ac -->
      <div class="col-lg-4 mb-5 card-wrapper" data-price="12000" data-seating="24" data-ac="ac">
        <div class="card shadow rounded">
          <img src="images/traveller.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Tempo Traveller Luxury (ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦👨‍👩👨‍👩‍👧‍👦👨‍👩👨‍👩‍👧‍👦👨‍👩👨‍👩‍👧‍👦👨‍👩 24persons </p> <hr>
            <p class="card-text">₹12000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
          </div>
        </div>
    </div>
<!-- non-ac -->
 <!-- breeza non ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="1600" data-seating="4" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/breeza.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Breeza (non-ac)</h5> <hr>
      <p class="card-text">👨‍👨‍👧‍👧 4 persons </p> <hr>
      <p class="card-text">₹1600/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- freestyle non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="1600" data-seating="4" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/freestyle.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Freestyle (non-ac)</h5> <hr>
      <p class="card-text">👨‍👨‍👧‍👧 4 persons </p> <hr>
      <p class="card-text">₹1600/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- i20 non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="1600" data-seating="4" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/i20.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">i20 (non-ac)</h5> <hr>
<p class="card-text">👨‍👨‍👧‍👧 4 persons </p> <hr>
      <p class="card-text">₹1600/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- swift non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="1600" data-seating="4" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/swift.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Swift (non-ac)</h5> <hr>
<p class="card-text">👨‍👨‍👧‍👧 4 persons </p> <hr>
      <p class="card-text">₹1600/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- scorpio non-c -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="3000" data-seating="6" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/scorpio.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Mahindra Scorpio (non-ac)</h5><hr>
  <p class="card-text">👨‍👩‍👧‍👦👨‍👩 6 persons </p> <hr>
      <p class="card-text">₹3000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
  </div>
  <!-- hexa non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="3000" data-seating="6" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/hexa.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Hexa (non-ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦👨‍👩 6 persons </p> <hr>
      <p class="card-text">₹3000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- tiago non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="1600" data-seating="4" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/tiago.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Tata Tiago (non-ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
      <p class="card-text">₹1600/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- baleno non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="1600" data-seating="4" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/baleno.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Baleno (non-ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
      <p class="card-text">₹1600/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- creta non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="2500" data-seating="4" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/creat.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Hyundai Creta (non-ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
     <p class="card-text">₹2500/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- menza non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="1600" data-seating="4" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/menza.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Tata Manza (non-ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
      <p class="card-text">₹1600/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- skoda non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="1600" data-seating="4" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/skoda.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Skoda Superb (non-ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦 4 persons </p> <hr>
      <p class="card-text">₹1600/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- toyota non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="3500" data-seating="6" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/toyota.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Toyota Innova (non-ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦👨‍👩 6 persons </p> <hr>
      <p class="card-text">₹3500/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- traveller 11 non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="6000" data-seating="11" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/luxury.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Tempo Traveller (non-ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦👨‍👩‍👧‍👦👨‍👩‍👧 11 persons </p> <hr>
      <p class="card-text">₹6000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
<!-- traveller 24 non-ac -->
<div class="col-lg-4 mb-5 card-wrapper" data-price="10000" data-seating="24" data-ac="non-ac">
  <div class="card shadow rounded">
    <img src="images/traveller.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Tempo Traveller Luxury (non-ac)</h5><hr>
<p class="card-text">👨‍👩‍👧‍👦👨‍👩👨‍👩‍👧‍👦👨‍👩👨‍👩‍👧‍👦👨‍👩👨‍👩‍👧‍👦👨‍👩 24persons </p> <hr>
      <p class="card-text">₹10000/day <a href="https://wa.me/+918328632167" class="button btn btn-dark">Book Now</a></p>
    </div>
  </div>
</div>
  </div>
  <!-- Repeat the above pattern for all car cards, adding appropriate data attributes for price, seating, and AC/Non-AC -->
  <!-- Additional car cards -->
</div>


<!-- <div class="message-icon" onclick="toggleMessage()">
  <span class="message-text"></span>
  <span class="toggle-icon" id="toggleIcon">&#9776;</span>
</div> -->

<!-- <div class="fixed-message" id="messageBox">
  <p><b>1.Here the seating capacity of cars is by<br>
   excluding Driver's capacity.<br>
2.Here the displayed rated of cars is only <br>
if the travel distance is less than 150 km ,<br>
 if it is more than that you will get to<br>
  know about it while booking.</b>
  </p>
</div> -->

<div class="back-to-top" onclick="toggleScroll()">
  ꔮ
</div>

<?php include 'footer.php'; ?>
<!-- <div class="footer">
        <p>&copy; 2024 My Website. All rights reserved.</p>
        <a href="privacy.html">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="contact.html">Contact Us</a>
    </div> -->
</body>
</html>
