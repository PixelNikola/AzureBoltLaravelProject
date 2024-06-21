document.getElementById('likeButton').addEventListener('click', function(){
    let likeIcon = document.getElementById('likeIcon');

    // Checking current class
    if (likeIcon.classList.contains('fa-regular', 'fa-heart')){
        likeIcon.classList.remove('fa-regular', 'fa-heart');
        likeIcon.classList.add('fa-solid', 'fa-heart');
    } 
    else {
        likeIcon.classList.remove('fa-solid', 'fa-heart');
        likeIcon.classList.add('fa-regular', 'fa-heart');
    }
})

if (localStorage.getItem('formSubmitted')) {
    document.getElementById('profileForm').classList.add('gone');
  }

  // Store the formSubmitted flag in localStorage after form submission
  document.getElementById('profileForm').addEventListener('submit', function() {
    localStorage.setItem('formSubmitted', true);
  });

  document.getElementById('rmGone').addEventListener('click', function() {
    document.getElementById('profileForm').classList.remove('gone');
  });

 