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