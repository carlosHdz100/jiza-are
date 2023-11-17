const alertPlaceholder2 = document.getElementById('liveAlertPlaceholder2')
const appendAlert2 = (message, type) => {
  const wrapper2 = document.createElement('div')
  wrapper2.className = 'position-fixed end-0 p-3"'; // Agregar clases de Bootstrap para la posición
  wrapper2.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible fw-bold" style="color: black; background-color: #f3f5f7; top: 2rem;" role="alert">`,
    `   <div>${message}</div>`,
    // ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder2.append(wrapper2)
   // Agregar el temporizador para eliminar el elemento después de 1 segundos
   setTimeout(() => {
    wrapper2.remove(); // Elimina el elemento de alerta después de 1 segundos
  }, 2000); // 5000 milisegundos (5 segundos)
}

const alertTrigger2 = document.getElementById('agregarAFavoritos')
let favorito = false;

if (alertTrigger2) {
  alertTrigger2.addEventListener('click', () => {
    if (favorito) {
    appendAlert2('Eliminado de favoritos!', '');
    favorito = false;
    } else {
      appendAlert2('Agregado a favoritos!', '');
      favorito = true;
    }
  });
}

document.getElementById('icon1').addEventListener('click', function() {
  this.classList.add('hidden');
  document.getElementById('icon2').classList.remove('hidden');
});

document.getElementById('icon2').addEventListener('click', function() {
  this.classList.add('hidden');
  document.getElementById('icon1').classList.remove('hidden');
});
