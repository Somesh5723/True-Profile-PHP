// JavaScript code for frontend web development

// Function to handle user registration


// var contactInput = document.getElementById('contact');
// var contactError = document.getElementById('contact-error');

// contactInput.addEventListener('input', function() {
//   var contactNumber = contactInput.value;
//   var valid = /^\d{10}$/.test(contactNumber);
  
//   if (valid) {
//     contactError.textContent = '';
//   } else {
//     contactError.textContent = 'Please enter a valid 10-digit contact number.';
//   }
// });

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


  document.addEventListener('DOMContentLoaded', function() {
    var registrationForm = document.getElementById('register-form');
    
    registrationForm.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting normally
      
      var formData = new FormData(registrationForm); // Create a new FormData object from the form


      const username = document.getElementById('username').value;
      const email  = document.getElementById('email').value;
      const avatar = document.getElementById('avatar').file;
      const contact = document.getElementById('contact').value;
      const location = document.getElementById('location').value;
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm-password').value;

      function checkPassword(){
        if(password === confirmPassword){
          // password match redirect user to their profile
          window.location.href = "profile.html"
        }else{
          alert("Password do not match")
        }
      }
      
      fetch('/save-registration-data', {
        method: 'POST',
        body: formData
      })
      .then(function(response) {
        if (response.ok) {
          checkPassword();
          console.log('Data saved successfully!');
          // Handle success response
          // You can perform any additional actions here, such as showing a success message or redirecting to another page
        } else {
          console.error('Error saving data:', response.status);
          // Handle error response
          // You can perform any additional error handling here, such as showing an error message to the user
        }
      })
      .catch(function(error) {
        console.error('Error saving data:', error);
        // Handle error response
        // You can perform any additional error handling here, such as showing an error message to the user
      });
    });
  });
  










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
  

  // Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function () {
  // Get the video element
  const videoElement = document.querySelector("video");

  // Function to check if an element is in the viewport
  function isElementInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  // Function to handle the scroll event
  function handleScroll() {
    if (isElementInViewport(videoElement)) {
      // If the video is in the viewport, play it
      videoElement.play();
    } else {
      // If the video is not in the viewport, pause it
      videoElement.pause();
    }
  }

  // Add a scroll event listener to the window
  window.addEventListener("scroll", handleScroll);

  // Trigger the handleScroll function once on page load to check the initial state
  handleScroll();
});
