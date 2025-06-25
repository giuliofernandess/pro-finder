// Responsividade do acesso ao Login/Perfil
function adaptLogin() {
    let imagemLogin = document.querySelector('#loginImage');
    let textoLogin = document.querySelector('#loginText');

    if (window.innerWidth <= 991) {
        imagemLogin.style.display = 'none';
        textoLogin.style.display = 'inline-block';
    } else {
        textoLogin.style.display = 'none';
        imagemLogin.style.display = 'inline-block';
    };
}
