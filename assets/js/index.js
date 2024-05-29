const hamburguerMenu = document.querySelector('.hamburguer-menu');
const closeMenuBtn = document.querySelector('.close-menu-btn');


hamburguerMenu.addEventListener('click', ()=>{

    document.querySelector('.header_wpnav').classList.toggle('menu-ativado')
})

closeMenuBtn.addEventListener('click', ()=>{
    document.querySelector('.header_wpnav').classList.toggle('menu-ativado')
})

document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const mensagem = document.querySelector('.avaliacao--mensagem');

    stars.forEach(star => {
        star.addEventListener('mouseover', onMouseOver);
        star.addEventListener('mouseout', onMouseOut);
        star.addEventListener('click', onClick);
    });

    function onMouseOver(e) {
        const starValue = e.target.getAttribute('data-value');
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= starValue) {
                star.classList.add('hovered');
            } else {
                star.classList.remove('hovered');
            }
        });
    }

    function onMouseOut() {
        stars.forEach(star => star.classList.remove('hovered'));
    }

    function onClick(e) {
        const starValue = e.target.getAttribute('data-value');
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= starValue) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
        mensagem.textContent = `Você avaliou com ${starValue} estrela(s). Obrigado!`;
    }
});
