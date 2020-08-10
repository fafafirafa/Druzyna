
// RECZNE

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active";
}




//	AUTOMATYCZNE

function kropki(){
	var slajd = document.getElementsByClassName("mySlides");
    for (i = 0; i < slajd.length; i++) {
        slajd[i].style.display = "block"; 
    }
	zmiana();
}

function zmiana(){
	if(window.innerWidth<951){
		Slajdy();
	} else {
		setTimeout(zmiana,1000);
	}
}
	
var Index = 0;
Slajdy();
function Slajdy() {
    var i;
    var slajd = document.getElementsByClassName("mySlides");
	var dotsy = document.getElementsByClassName("dot");
    for (i = 0; i < slajd.length; i++) {
        slajd[i].style.display = "none"; 
    }
    Index++;
    if (Index > slajd.length) {Index = 1} 
    slajd[Index-1].style.display = "block"; 
	
    if(window.innerWidth<951){setTimeout(Slajdy, 3000);}else{setTimeout(kropki, 2000);}
	// Change image every 2 seconds
	for (i = 0; i < dotsy.length; i++) {
      dotsy[i].className = dotsy[i].className.replace(" active", "");
  }
  dotsy[Index-1].className += " active";
}
