const modal = document.getElementById('myModal');

const img = document.getElementById('myImg');
const modalImg = document.getElementById("img01");
const captionText = document.getElementById("caption");
const span = document.getElementsByClassName("close")[0];

img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

span.onclick = function() {
    modal.style.display = "none";
}

/*
function open() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

function close() {
    modal.style.display = "none";
}
*/