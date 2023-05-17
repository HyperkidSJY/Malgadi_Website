const loader = document.querySelector(".ec-loader");
const body = document.querySelector("body");
const carousel = document.querySelector("#container");
// function hideloader(){
//     loader.style.display = "none";
// }
// setTimeout(hideloader,5000);

window.addEventListener("load", ()=>{
    loader.style.display = "none";
    body.style.overflow = "auto";
});