// SlideShow() is a function that loops through the images displayed in the page.
// It selects all the elements with the class name 'page', then iterates over them, setting the display property to 'none'.
// It then increments the indexValue variable, and if it's greater than the page length, it resets it to 1.
// The current page element is then set to display block, and the setTimeOut() method is used to call the SlideShow() function again, after a 6 second delay.

let indexValue = 0;
function slideShow(){
    let x;
    const page = document.querySelectorAll('.page');
    for(x = 0; x < page.length; x++){
        page[x].style.display = 'none';
    }
    indexValue++;
    if(indexValue > page.length){indexValue = 1}
    page[indexValue -1].style.display = 'block';
    setTimeout(slideShow, 6000);
}
slideShow();