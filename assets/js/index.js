const hamburguerMenu = document.querySelector('.hamburguer-menu');
const closeMenuBtn = document.querySelector('.close-menu-btn');


hamburguerMenu.addEventListener('click', ()=>{

    document.querySelector('.header_wpnav').classList.toggle('menu-ativado')
})

closeMenuBtn.addEventListener('click', ()=>{
    document.querySelector('.header_wpnav').classList.toggle('menu-ativado')
})