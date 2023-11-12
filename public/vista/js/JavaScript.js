/* -------------------------------------------------------------------------------
  Función principal para cargar la tabla y los eventos de los botones del modal
-------------------------------------------------------------------------------- */

$(document).ready(function () {
    var table = $("#example")
        .DataTable({
            responsive: true,
        })
        .columns.adjust()
        .responsive.recalc();

    // Evento para abrir el modal al hacer clic en el botón "Agregar ciudadano"
    $(".open-modal").on("click", function () {
        const target = $(this).data("modal-target");
        const modal = document.getElementById(target);
        if (modal) {
            modal.classList.toggle("hidden");
        }
    });

    // Evento para cerrar el modal al hacer clic en el botón de la x dentro del modal
    $("#closeModalButton").on("click", function () {
        const target = $(this).data("modal-toggle");
        const modal = document.getElementById(target);
        if (modal) {
            modal.classList.add("hidden");
        }
    });

    // Evento para cerrar el modal al hacer clic en el botón "Cancelar" dentro del modal
    $("#cancelModalButton").on("click", function () {
        const target = $(this).data("modal-toggle");
        const modal = document.getElementById(target);
        if (modal) {
            modal.classList.add("hidden");
    
            // Limpiar los campos del formulario
            document.getElementById('nombre').value = '';
            document.getElementById('apellidoPaterno').value = '';
            document.getElementById('ApellidoMaterno').value = '';
            document.getElementById('edad').value = '';
            document.getElementById('estado').value = '';
            document.getElementById('domicilio').value = '';
            document.getElementById('id').value = '';
        }
    });
    
});


/*-----------------------------------------------------------
  Función para mostrar todos los registros en la datatable
-------------------------------------------------------------*/

document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.querySelector("#example tbody");
    const datos = JSON.parse(tableBody.getAttribute("data-datos"));

    if (datos.length > 0) {
        datos.forEach((ciudadano) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${ciudadano.nombre}</td>
                <td>${ciudadano.apellido_paterno}</td>
                <td>${ciudadano.apellido_materno}</td>
                <td>${ciudadano.edad}</td>
                <td>${ciudadano.domicilio && ciudadano.domicilio.estado ? ciudadano.domicilio.estado.nombre : "No disponible"}</td>
                <td>${ciudadano.domicilio ? ciudadano.domicilio.domicilio : "No disponible"}</td>
                <td>       
                    <div class="flex">
                        <button data-modal-target="crud-modal" class="bg-yellow-500 text-white font-bold py-2 px-4 rounded mr-2" ciudadano-info='${JSON.stringify(ciudadano)}'>Editar</button>
                        <button class="bg-red-500 text-white font-bold py-2 px-4 rounded delete-btn" data-ciudadano-id="${ciudadano.id}">Eliminar</button>

                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }
});


/*---------------------------------------------------------------------------------------------
  Función para mostrar los datos del ciudadano en el modal al hacer clic en el botón "Editar"
-----------------------------------------------------------------------------------------------*/

document.addEventListener('click', (event) => {
    if (event.target.tagName === 'BUTTON' && event.target.dataset.modalTarget === 'crud-modal') {
        const ciudadanoInfo = event.target.getAttribute('ciudadano-info');
        if (ciudadanoInfo) {
            const ciudadano = JSON.parse(ciudadanoInfo);

            // Rellenar los campos del modal con los datos del ciudadano
            document.getElementById('nombre').value = ciudadano.nombre;
            document.getElementById('apellidoPaterno').value = ciudadano.apellido_paterno;
            document.getElementById('ApellidoMaterno').value = ciudadano.apellido_materno;
            document.getElementById('edad').value = ciudadano.edad;
            document.getElementById('estado').value = ciudadano.domicilio && ciudadano.domicilio.estado ? ciudadano.domicilio.estado.id : '';
            document.getElementById('domicilio').value = ciudadano.domicilio ? ciudadano.domicilio.domicilio : '';
            document.getElementById('id').value = ciudadano.id;

            // Mostrar el modal con los datos del ciudadano
            const modal = document.getElementById('crud-modal');
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }
    }
});


/*-----------------------------------------
//funcion para eliminar un ciudadano
-------------------------------------------*/

document.addEventListener("DOMContentLoaded", function () {
    const deleteForm = document.getElementById('deleteForm'); // Obtener el formulario
    const ciudadanoIdInput = deleteForm.querySelector('#ciudadanoId'); // Obtener el campo de input del formulario
    const deleteButtons = document.querySelectorAll('.delete-btn'); // Obtener todos los botones de eliminación

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevenir el envío automático del formulario
            const ciudadanoId = this.getAttribute('data-ciudadano-id'); // Obtener el ID del ciudadano del botón clicado
            
            // Mostrar Sweet Alert de confirmación
            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar este registro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    ciudadanoIdInput.value = ciudadanoId; // Establecer el ID del ciudadano en el campo de input del formulario
                    deleteForm.querySelector('form').submit(); // Enviar el formulario
                }
            });
        });
    });
});

/*-----------------------------------------
  Función para mostrar alertas de éxito
-------------------------------------------*/

function mostrarAlerta(mensaje) {
    Swal.fire({
        title: "Éxito",
        text: mensaje,
        icon: "success",
        showConfirmButton: false,
        timer: 1500,
    });
}



