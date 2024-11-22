document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;
    let currentIndex = 0;

    // Function to move to a specific slide
    const moveToSlide = (index) => {
        slider.style.transition = 'transform 2s ease-in-out';
        slider.style.transform = `translateX(-${index * 100}%)`;
    };

    // Move to the next slide every 5 seconds
    setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        moveToSlide(currentIndex);
    }, 5000); // Change slide every 5 seconds

    // On page load, position the slider at the first slide
    moveToSlide(0);
});
