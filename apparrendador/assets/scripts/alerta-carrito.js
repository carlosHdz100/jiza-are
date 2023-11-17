const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
const appendAlert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.className = 'position-fixed bottom-0 end-0 p-3'; // Agregar clases de Bootstrap para la posición
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible fw-bold" style="color: black; background-color: #f3f5f7; bottom: 38px;" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
   // Agregar el temporizador para eliminar el elemento después de 3 segundos
   setTimeout(() => {
    wrapper.remove(); // Elimina el elemento de alerta después de 3 segundos
  }, 3000); // 5000 milisegundos (5 segundos)
}

const alertTrigger = document.getElementById('agregarAlCarrito')
if (alertTrigger) {
  alertTrigger.addEventListener('click', () => {
    appendAlert('Agregado al carrito exitosamente!', '')
  })
}