let slideIndex = 1;  // Start at the first slide (index 1)
let previousIndex = 0;
let autoSlideInterval;  // Variable to hold the interval

window.onload = function() {
    showSlides(slideIndex);  // Show the first slide when the page loads
    startAutoSlide();  // Start automatic slideshow
}

// Next/previous controls
function plusSlides(n) {
    clearInterval(autoSlideInterval);  // Stop auto-slide on manual navigation
    showSlides(slideIndex += n, n);
    startAutoSlide();  // Restart the auto-slide after manual change
}

// Thumbnail image controls
function currentSlide(n) {
    clearInterval(autoSlideInterval);  // Stop auto-slide on manual navigation
    showSlides(slideIndex = n, n - previousIndex);
    startAutoSlide();  // Restart the auto-slide after manual change
}

function showSlides(n, direction) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");

    if (n > slides.length) { slideIndex = 1 }  // Wrap around if beyond the last slide
    if (n < 1) { slideIndex = slides.length }  // Wrap around if going below the first slide

    let currentSlide = slides[slideIndex - 1];  // Adjust for zero-based indexing
    let previousSlide = slides[previousIndex - 1];

    // Remove the 'active' class from all slides to reset state
    for (i = 0; i < slides.length; i++) {
        slides[i].classList.remove('active');
    }

    if (previousSlide) {
        // Apply sliding out animation to the previous slide
        if (direction > 0) {
            previousSlide.style.animation = "slideOut 1s";
        } else {
            previousSlide.style.animation = "slideOutReverse 1s";
        }

        previousSlide.classList.add('active');  // Keep the previous slide visible during the animation

        // Hide the previous slide after the animation ends
        previousSlide.addEventListener('animationend', function() {
            previousSlide.style.display = "none";
        }, { once: true });
    }

    // Apply sliding in animation to the current slide
    if (direction > 0) {
        currentSlide.style.animation = "slideIn 1s";
    } else {
        currentSlide.style.animation = "slideInReverse 1s";
    }

    currentSlide.style.display = "block";  // Show the new slide
    currentSlide.classList.add('active');  // Mark the current slide as active

    dots[slideIndex - 1].className += " active";  // Update the active dot

    previousIndex = slideIndex;  // Update the previous index
}

// Start automatic slide transition every 5 seconds
function startAutoSlide() {
    autoSlideInterval = setInterval(function() {
        plusSlides(1);  // Move to the next slide
    }, 5000);  // 5000 milliseconds = 5 seconds
}