const openNav=document.querySelector(".open-nav");
const menuCon=document.querySelector(".menu-con");
const closeNav=document.querySelector(".close");

openNav.addEventListener("click",()=>{
    menuCon.classList.add("opened")
})
closeNav.addEventListener("click",()=>{
    menuCon.classList.remove("opened")
})