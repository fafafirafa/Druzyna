// RECZNE

var numero = 1;
Zobacz(numero);

// Next/previous controls
function pSlide(n) {
  Zobacz(numero += n);
}

// Thumbnail image controls
function cSlide(n) {
  Zobacz(numero = n);
}

function Zobacz(n) {
  var i;
  var slide = document.getElementsByClassName("pSlides");
  var dotes = document.getElementsByClassName("dote");
  if (n > slide.length) {numero = 1} 
  if (n < 1) {numero = slide.length}
  for (i = 0; i < slide.length; i++) {
      slide[i].style.display = "none"; 
  }
  for (i = 0; i < dotes.length; i++) {
      dotes[i].className = dotes[i].className.replace(" active", "");
  }
  slide[numero-1].style.display = "block"; 
  dotes[numero-1].className += " active";
}




//	AUTOMATYCZNE

function kropa(){
	var pokazane = document.getElementsByClassName("pSlides");
    for (i = 0; i < pokazane.length; i++) {
        pokazane[i].style.display = "block"; 
    }
	zamienienie();
}

function zamienienie(){
	if(window.innerWidth<951){
		automatiko();
	} else {
		setTimeout(zamienienie,1000);
	}
}
	
var kolejno = 0;
automatiko();
function automatiko() {
    var i;
    var pokazane = document.getElementsByClassName("pSlides");
	var dotesy = document.getElementsByClassName("dote");
    for (i = 0; i < pokazane.length; i++) {
        pokazane[i].style.display = "none"; 
    }
    kolejno++;
    if (kolejno > pokazane.length) {kolejno = 1} 
    pokazane[kolejno-1].style.display = "block"; 
	
    if(window.innerWidth<951){setTimeout(automatiko, 3000);}else{setTimeout(kropa, 2000);}
	// Change image every 2 seconds
	for (i = 0; i < dotesy.length; i++) {
      dotesy[i].className = dotesy[i].className.replace(" active", "");
  }
  dotesy[kolejno-1].className += " active";
}