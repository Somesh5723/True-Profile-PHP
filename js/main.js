// JavaScript code for frontend web development

// Function to handle user registration


var contactInput = document.getElementById('contact');
var contactError = document.getElementById('contact-error');

contactInput.addEventListener('input', function() {
  var contactNumber = contactInput.value;
  var valid = /^\d{10}$/.test(contactNumber);
  
  if (valid) {
    contactError.textContent = '';
  } else {
    contactError.textContent = 'Please enter a valid 10-digit contact number.';
  }
});

// location

  var map;

  function initMap() {
    var locationInput = document.getElementById('location');
    var autocomplete = new google.maps.places.Autocomplete(locationInput);

    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 0, lng: 0},
      zoom: 2
    });

    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      if (!place.geometry || !place.geometry.location) {
        alert('Invalid location');
        return;
      }

      var latitudeInput = document.getElementById('latitude');
      var longitudeInput = document.getElementById('longitude');

      latitudeInput.value = place.geometry.location.lat();
      longitudeInput.value = place.geometry.location.lng();

      map.setCenter(place.geometry.location);
      map.setZoom(15);

      var marker = new google.maps.Marker({
        position: place.geometry.location,
        map: map
      });
    });
  }





function registerUser() {
    // Get the input values from the registration form
    const username = document.getElementById('username').value;
    const email  = document.getElementById('email').value;
    const avatar = document.getElementById('avatar').file;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    
    // Perform validation on the input values (e.g., check for empty fields, password strength, etc.)
    // ...
    function checkPassword(){
      if(password === confirmPassword){
        // password match redirect user to their profile
        window.location.href = "profile.html"
      }else{
        alert("Password do not match")
      }
    }
    
  
    // Make a POST request to the backend API to register the user
    fetch('/api/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ username, password }),
    })
      .then(response => response.json())
      .then(data => {
        // Handle the response from the server (e.g., display success message, redirect to login page, etc.)
        // ...
      })
      .catch(error => {
        // Handle any errors that occur during the request
        // ...
      });
  }
  
  // Function to handle user login
  function loginUser() {
    // Get the input values from the login form
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    // Make a POST request to the backend API to authenticate the user
    fetch('/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ username, password }),
    })
      .then(response => response.json())
      .then(data => {
        // Handle the response from the server (e.g., store user session, redirect to dashboard, etc.)
        // ...
      })
      .catch(error => {
        // Handle any errors that occur during the request
        // ...
      });
  }
  
  // Function to handle file upload
  function uploadFile(file) {
    // Make a POST request to the backend API to upload the file
    // ...
  
    // You can use the Fetch API or other libraries like Axios to make the request
  }
  
  // Add event listeners to the registration and login forms
  document.getElementById('register-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission
    registerUser();
  });
  
  document.getElementById('login-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission
    loginUser();
  });
  
  // Example usage of the uploadFile function
  const fileInput = document.getElementById('file-input');
  
  fileInput.addEventListener('change', function () {
    const file = fileInput.files[0]; // Get the selected file
  
    // Call the uploadFile function and pass the file object
    uploadFile(file);
  });
  

  