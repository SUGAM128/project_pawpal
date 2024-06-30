<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!-- <div class="header" >
<a class="logo"><i class="fas fa-paw"></i> PawPal </a>
</div>
   -->
<i class="fas fa-paw"></i><title>PawPal</title>
  <link rel="stylesheet" href="/furreverfriends/app/resources/css/style.css">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
      /* background-image: url(images.jfif); */
      
      background-size:contain;
      background-position: auto;
      background-repeat: no-repeat;
    }

    .container {
      max-width: 600px;
      width: 100%;
      padding: 0 20px;
      margin: auto;
      text-align: center;
    }

    .container.main {
      display: flex;
      justify-content: center;
      flex-direction: column;
      margin-top: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-control {
      padding: 15px;
      border: 1px solid var(--main);
      border-radius: 20px;
      width: 100%;
      box-sizing: border-box;
      font-size: 16px;
    }

    .btn-outline-light {
      padding: 15px 25px;
      background-color: var(--main);
      color: var(--white);
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-outline-light:hover {
      background-color: green;
      color: var(--white);
    }
  </style>
</head>

<body>
  <header class="header">
    <a href="#" class="logo">
      <i class="fas fa-paw"></i> Pawpal
    </a>
    <nav class="navbar">
      <button class="btn" onclick="toggleLogin()">Login</button>
      <button class="btn" onclick="toggleSignup()">Signup</button>
    </nav>
  </header>

  <main class="container main">
    <div id="loginContainer" style="margin: 80px 0px 0px 0px">
      <div class="container">
        <h1>Login</h1>
        <br>
        <form action="/furreverfriends/authentication" method="post">
          <div class="form-group">
            <input type="email" class="form-control" id="loginEmail" placeholder="Enter email" name="loginEmail" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="loginPassword" required>
          </div>
          <br>
          <input type="submit" class="btn btn-outline-light" value="Login">
        </form>
      </div>
    </div>

    <div id="signupContainer" style="display: none;">
      <div class="container">
        <h1>Sign Up</h1>
        <br>
        <form action="/furreverfriends/authentication" method="post" onsubmit="return validateSignupForm()">
          <div class="form-group">
            <input type="text" class="form-control" id="signupName" placeholder="Name" name="signupName" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="signupEmail" placeholder="Enter email" name="signupEmail" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="signupPhone" placeholder="Contact Number" name="signupPhone" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" maxlength="10" required style="-moz-appearance: textfield; -webkit-appearance: none;">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="signupPassword" placeholder="Password" name="signupPassword" required>
          </div>
          <div class="form-group">
            <input type="date" class="form-control" id="signupDob" name="signupDob" required>
          </div>
          <div class="form-group">
            <select class="form-control" id="signupState" name="signupState" onchange="populateCities()">
              <option value="" selected disabled>Select District</option>
              <option value="Jhapa">Jhapa</option>
              <option value="Kathmandu">Kathmandu</option>
              <option value="Bhaktapur">Bhaktapur</option>
            </select>
          </div>
          <div class="form-group" id="citiesContainer" style="display: none;">
            <select class="form-control" id="signupCitySelect" name="signupCity">
              <option value="" selected disabled>Select City</option>
            </select>
          </div>
          <br>
          <input type="submit" class="btn btn-outline-light" value="Sign Up">
        </form>
      </div>
    </div>

  </main>
  <br><br>
  <?php require(ROOT . 'app/resources/component/footer.php'); ?>

  <script>
    var loginContainer = document.getElementById("loginContainer");
    var signupContainer = document.getElementById("signupContainer");

    function toggleLogin() {
      loginContainer.style.display = "block";
      signupContainer.style.display = "none";
      document.getElementById("signupName").value = "";
      document.getElementById("signupEmail").value = "";
      document.getElementById("signupPhone").value = "";
      document.getElementById("signupPassword").value = "";
      document.getElementById("signupDob").value = "";
      document.getElementById("signupCity").value = "";
    }

    function toggleSignup() {
      loginContainer.style.display = "none";
      signupContainer.style.display = "block";
    }

    function validateSignupForm() {
      var name = document.getElementById("signupName").value.trim();
      var email = document.getElementById("signupEmail").value.trim();
      var phone = document.getElementById("signupPhone").value.trim();
      var password = document.getElementById("signupPassword").value.trim();
      var dob = document.getElementById("signupDob").value.trim();
      var city = document.getElementById("signupCitySelect").value.trim();

      if (name === "" || email === "" || phone === "" || password === "" || dob === "" || city === "") {
        alert("All fields are required");
        return false;
      }

      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address");
        return false;
      }

      var phoneRegex = /^\d{10}$/;
      if (!phoneRegex.test(phone)) {
        alert("Please enter a valid 10-digit phone number");
        return false;
      }

      if (password.length < 8) {
        alert("Password must be at least 8 characters long");
        return false;
      }
      var passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
      if (!passwordRegex.test(password)) {
        alert("Password must be at least 8 characters long and include at least one number and one special character");
        return false;
      }

      return true;
    }

    function populateCities() {
      var state = document.getElementById("signupState").value;
      var citiesContainer = document.getElementById("citiesContainer");
      var citySelect = document.getElementById("signupCitySelect");
      citySelect.innerHTML = '<option value="" selected disabled>Select City</option>';

      if (state === "Jhapa") {
        var cities = ["Charali","Birtamode", "Damak", "Mechinagar"];
      } else if (state === "Kathmandu") {
        var cities = ["Kathmandu", "Kirtipur", "Thimi"];
      } else if (state === "Bhaktapur") {
        var cities = ["Bhaktapur", "Madhyapur", "Thimi"];
      }

      cities.forEach(function(city) {
        var option = document.createElement("option");
        option.value = city;
        option.text = city;
        citySelect.appendChild(option);
      });

      citiesContainer.style.display = "block";
    }

    // Check for error message and display alert if exists
    <?php if (!empty($error_message)) { ?>
      alert("<?php echo $error_message; ?>");
    <?php } ?>
  </script>
</body>

</html>
