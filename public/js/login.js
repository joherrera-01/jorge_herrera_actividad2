// Inicializar usuario por defecto si no existe
const initUser = () => {
    const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
    if (usuarios.length === 0) {
        // Usuario quemado para pruebas iniciales
        usuarios.push({ user: "admin", pass: "1234", nombre: "Jorge Herrera" });
        localStorage.setItem('usuarios', JSON.stringify(usuarios));
    }
};

document.getElementById('formLogin').onsubmit = (e) => {
    e.preventDefault();
    const userInput = document.getElementById('user').value;
    const passInput = document.getElementById('pass').value;
    
    const usuarios = JSON.parse(localStorage.getItem('usuarios'));
    const loginExitoso = usuarios.find(u => u.user === userInput && u.pass === passInput);

    if (loginExitoso) {
        // Guardar sesión activa
        localStorage.setItem('sesion_activa', JSON.stringify(loginExitoso));
        window.location.href = "menu.php"; // Redirigir al menú principal
    } else {
        alert("Usuario o contraseña incorrectos");
    }
};

initUser();