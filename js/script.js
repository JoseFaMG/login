document.querySelector('input').classList.add('error');

// Para remover la clase después de un tiempo
setTimeout(() => {
    document.querySelector('input').classList.remove('error');
}, 500);
