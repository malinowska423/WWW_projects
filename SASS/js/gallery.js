function displayDesktopGallery(x) {
  if (x.matches) {
    document.getElementById("gallery").innerHTML =
      `<img alt="am gallery" src="img/gal_1.JPG">
                           <img alt="am gallery" src="img/gal_2.jpg">
                            <img alt="am gallery" src="img/gal_3.JPG">`;
  } else {
    document.getElementById("gallery").innerHTML = "";
  }
}

var x = window.matchMedia("(min-width: 1000px)");
displayDesktopGallery(x);
x.addListener(displayDesktopGallery);
