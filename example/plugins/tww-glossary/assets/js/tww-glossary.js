document.addEventListener('DOMContentLoaded', function() {
    // Select all letter links
    const letterLinks = document.querySelectorAll('header.letters ul li a');

    const offsetTotal = '180px'; 

    // Attach click event listener to each link
    letterLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default anchor behavior
            const targetId = e.target.getAttribute('href'); // Get the href attribute of the clicked link
            const targetSection = document.querySelector(targetId); // Select the target section by its ID

            if (targetSection) {
                // Scroll to the target section smoothly
                window.scrollTo({
                    top: targetSection.offsetTop - parseInt(offsetTotal),
                    behavior: 'smooth'
                });
            }
        });
    });

    const alphaHeader = document.querySelector('header.letters');

    window.addEventListener('scroll', function(e) {
        const scrollPosition = window.scrollY;
        const alphaHeaderPosition = alphaHeader.offsetTop;

        if (scrollPosition >= alphaHeaderPosition) {
            alphaHeader.classList.add('tww-fixed');
        } else {
            alphaHeader.classList.remove('tww-fixed');
        }
    });
});