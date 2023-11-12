<!DOCTYPE html>
<html lang="en" class="antialiased">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>VE++ CRUD </title>
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- Tailwind -->
	<link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">

	<!--Regular Datatables CSS-->
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

	<!--Responsive Extension Datatables CSS-->
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

	<!-- SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Estilos CSS -->
	<link href="<?php echo e(asset('vista/css/CeEseEse.css')); ?>" rel="stylesheet">

		<!-- jQuery -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<!-- JavaScript mío -->
<script src="<?php echo e(asset('vista/js/JavaScript.js')); ?>"></script>

</head>

<body class="bg-gray-100 text-gray-900 tracking-wider leading-normal">

	
	<div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">

		
		<h1 class="font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-3xl text-center">CRUD DE CIUDADANOS</h1>

		<!--Botón de Agregar Ciudadano-->
		<div class="text-right mt-2 mr-4 mb-3">
			<button data-modal-target="crud-modal" class="open-modal bg-blue-200 hover:bg-blue-300 text-blue-800 font-bold py-2 px-4 rounded" type="button">Agregar Ciudadano</button>
		</div>

		<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

            <!-- Datatable de los ciudadanos -->
			<table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

				<thead>
					<tr>
						<th data-priority="1">Nombre</th>
						<th data-priority="2">Apellido Paterno</th>
						<th data-priority="3">Apellido Materno</th>
						<th data-priority="4">Edad</th>
						<th data-priority="4">Estado</th>
						<th data-priority="5">Domicilio</th>
						<th data-priority="5">Acciones</th>
					</tr>
				</thead>

				<tbody data-datos="<?php echo e(json_encode($datos)); ?>"></tbody>

			</table>

		</div>

	</div>




	<!-------------------------------------------------
           MODAL PARA AGREGAR CIUDADANO
    -------------------------------------------------->

	<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">

		<div class="relative p-4 w-full max-w-md max-h-full">

			<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

				<!-- header -->
				<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
					<h3 class="text-lg font-semibold text-gray-900 dark:text-white">Agregar un ciudadano</h3>

					<!-- Boton de la x para cerrar -->
					<button type="button" id="closeModalButton" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
						</svg>
						<span class="sr-only">Close modal</span>
					</button>

				</div>

				<!-- Formulario para añadir o editar un registro, osea el body del modal -->
				<form action="<?php echo e(route('controlador.store')); ?>" method="POST" class="p-4 md:p-5">
					<?php echo csrf_field(); ?>

					<div class="grid gap-4 mb-4 grid-cols-2">

						<!-- Input para colocar el nombre del ciudadano -->
						<div class="col-span-2">
							<label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
							<input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
							<input type="hidden" name="id" id="id">
						</div>

						<!-- Input para colocar el apellido paterno del ciudadano -->
						<div class="col-span-2">
							<label for="apellidoPaterno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido Paterno</label>
							<input type="text" name="apellidoPaterno" id="apellidoPaterno" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
						</div>

						<!-- Input para colocar el apellido Materno del ciudadano -->
						<div class="col-span-2">
							<label for="ApellidoMaterno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido Materno</label>
							<input type="text" name="ApellidoMaterno" id="ApellidoMaterno" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
						</div>

						<!-- Input para colocar la edad del ciudadano -->
						<div class="col-span-2 sm:col-span-1">
							<label for="edad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad</label>
							<input type="number" name="edad" id="edad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
						</div>

						<!-- Input para colocar el Estado en donde vive el ciudadano -->
						<div class="col-span-2 sm:col-span-1">
							<label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
							<select id="estado" name="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
								<option selected>Selecciona el estado</option>
								<?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($estado->id); ?>"><?php echo e($estado->nombre); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>

						<!-- Input para colocar el domicilio en donde vive el ciudadano -->
						<div class="col-span-2">
							<label for="domicilio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domicilio</label>
							<textarea id="domicilio" name="domicilio" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe el domicilio aquí"></textarea>
						</div>

					</div>

					<!-- Boton de agregar ciudadano -->
					<button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar cambios</button>

					<!-- Boton de cancelar -->
					<button id="cancelModalButton" class="text-gray-500 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-400" data-modal-toggle="crud-modal">Cancelar</button>

				</form>

			</div>

		</div>

	</div>


	<!-------------------------------------------------
		Formulario oculto para eliminar un ciudadano
	------------------------------------------------>
	<div id="deleteForm" class="hidden">
		<form action="<?php echo e(route('controlador.destroy')); ?>" method="POST">
			<?php echo csrf_field(); ?>
			<input type="hidden" name="id" id="ciudadanoId">
		</form>
	</div>

</body>

<!-- Alerta de SweetAlert2 -->
<?php if(session('success')): ?>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var mensaje = "<?php echo e(session('success')); ?>";
		mostrarAlerta(mensaje);
	});
</script>
<?php endif; ?>

</html><?php /**PATH C:\xampp\htdocs\vemasmasCRUD\resources\views/vista.blade.php ENDPATH**/ ?>