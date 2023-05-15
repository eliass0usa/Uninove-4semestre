

let cadastrese = document.querySelector('.login_form_semconta--link');

let jaTemUmaConta = document.querySelector('.login_form_temconta--link');

cadastrese.addEventListener('click', (e)=>{
    e.preventDefault()

    document.querySelector('.login_form--container').style.display = "none";

    document.querySelector('.login_form--cad').style.display = "flex";
})


jaTemUmaConta.addEventListener('click', (e)=>{
    e.preventDefault();

    document.querySelector('.login_form--container').style.display = "flex";

    document.querySelector('.login_form--cad').style.display = "none";


})
