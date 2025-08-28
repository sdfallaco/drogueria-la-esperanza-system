let paso = 1;
let pasoInicial = 1;
let pasoFinal = 3;

const venta = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    productos: []
} 

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
    mostrarDescripcionServicios();
    ocultarElementos();

});

function mostrarDescripcionServicios() {
    // ...código existente...

    // Agregar evento al botón "Mostrar Servicios"
    const btnMostrarServicios = document.getElementById('btnServicios');
    btnMostrarServicios.addEventListener('click', function() {
        // Cambiar el color del botón al hacer clic
        btnMostrarServicios.classList.toggle('presionado');

        // Mostrar u ocultar elementos y la clase imagen2 según el estado del botón
        if (btnMostrarServicios.classList.contains('presionado')) {
            // Mostrar elementos
            mostrarElementos();
            // Ocultar la clase imagen2
            ocultarImagen2();
        } else {
            // Ocultar elementos
            ocultarElementos();
            // Mostrar la clase imagen2
            mostrarImagen2();
        }
    });
}

function ocultarImagen2() {
    const imagen2 = document.querySelector('.imagen2');
    if (imagen2) {
        imagen2.style.display = 'none';
    }
}

function mostrarImagen2() {
    const imagen2 = document.querySelector('.imagen2');
    if (imagen2) {
        imagen2.style.display = 'block'; // o 'initial' dependiendo del estilo original
    }
}

function ocultarElementos() {
    const elementosOcultar = document.querySelectorAll('#siguiente, #anterior, .seccion, .tabs');
    elementosOcultar.forEach(elemento => {
        if (!elemento.classList.contains('mostrar-botones')) {
            elemento.classList.add('oculto2');
        }
    });
    
}

function mostrarElementos() {
    const elementosMostrar = document.querySelectorAll('#siguiente, #anterior, .seccion, .tabs');
    elementosMostrar.forEach(elemento => {
        if (!elemento.classList.contains('mostrar-botones')) {
            elemento.classList.remove('oculto2');
        }
    });
}
function iniciarApp() {

    mostrarSeccion();
    tabs(); // cambia las secciones cuando se presione los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); // Consulta la API en el backend de PHP

    idVendedor();
    nombreVendedor(); // Añade el nombre del vendedor al objeto de venta
    seleccionarFecha(); // Añade la fecha de la venta en el objeto
    seleccionarHora(); // Añade la hora de la venta al objeto
    mostrarResumen(); // Muestra el resumen de venta
}

function mostrarSeccion() {

    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }


    // Seleccionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Quita el tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    // Resalta el Tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach( boton => {
        boton.addEventListener('click', function(e) {
            paso = parseInt( e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();

        });
    })

}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');

        mostrarResumen()
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector(`#anterior`);
    paginaAnterior.addEventListener('click', function() {

        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    });
}

function paginaSiguiente() {
    
    const paginaSiguiente = document.querySelector(`#siguiente`);
    paginaSiguiente.addEventListener('click', function() {

        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    });
}

async function consultarAPI() {
    try {
        const url = `${location.origin}/api/productos`;
        const resultado = await fetch(url);
        const productos = await resultado.json();
        mostrarProductos(productos);


    } catch  (error) {
        console.log(error);
        
    }
}

function mostrarProductos(productos) {
    productos.forEach( producto => {
        const { id, nombre, precio} = producto;
        const nombreProducto = document.createElement('P');
        nombreProducto.classList.add('nombre-producto');
        nombreProducto.textContent = nombre;

        const precioProducto = document.createElement('P');
        precioProducto.classList.add('precio-producto');
        precioProducto.textContent = nombre;
        precioProducto.textContent = `$ ${precio}`;

        const productosDiv = document.createElement('DIV');
        productosDiv.classList.add('producto');
        productosDiv.dataset.idProducto = id;
        productosDiv.onclick = function() {
            seleccionarProducto(producto);
        }

        productosDiv.appendChild(nombreProducto);
        productosDiv.appendChild(precioProducto);

        document.querySelector('#productos').appendChild(productosDiv);

    });
}

function seleccionarProducto(producto) {
    const { id } = producto;
    const { productos } = venta;

    // Identificar el elemento al que se le da clic.
    const divProducto = document.querySelector(`[data-id-producto="${id}"]`);

    //comprobar si un servicio ya fue agregado o quitarlo
    if( productos.some( agregado => agregado.id === id ) ) {
        
        //Eliminalo
        venta.productos = productos.filter(agregado => agregado.id !== id)
        divProducto.classList.remove('seleccionado'); 

    } else {
        venta.productos = [...productos, producto];
        divProducto.classList.add('seleccionado');
    }
}

function idVendedor() {
    venta.id = document.querySelector('#id').value;
}

function nombreVendedor() {
    venta.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e) {
        const dia = new Date(e.target.value).getUTCDay();

        if([0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Domingos no se trabaja', 'error', '.formulario');
        } else {
            venta.fecha = e.target.value;
        }

    });
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){

        const horaVenta = e.target.value;
        const hora = horaVenta.split(":")[0];
        if(hora < 7 || hora > 21 ) {
            e.target.value = '';
            mostrarAlerta('Hora invalida, ', 'error', '.formulario')
        } else {
            venta.hora = e.target.value;
        }


    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece =  true) {

    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    };

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);
    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(desaparece) {
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }

}

function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');

    // Limpiar el contenido anterior del resumen
    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    // Verificar si se han proporcionado todos los datos necesarios
    if (Object.values(venta).includes('') || venta.productos.length === 0) {
        mostrarAlerta('Faltan datos de Servicio, Fecha u Hora', 'error', '.contenido-resumen', false);
        return;
    }
    
    // Extraer datos de la venta
    const { nombre, fecha, hora, productos } = venta;

    // Crear elementos para mostrar el resumen
    const nombreVendedorElement = document.createElement('p');
    nombreVendedorElement.innerHTML = `<span>Nombre:</span> ${nombre}`;

    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate()+ 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date( Date.UTC(year, mes, dia));

    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
    const fechaFormateada = fechaUTC.toLocaleDateString('es-CO', opciones);

    const fechaVentaElement = document.createElement('p');
    fechaVentaElement.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaVentaElement = document.createElement('p');
    horaVentaElement.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    // Variables para almacenar el valor total
    let totalValor = 0;
    let totalServicios = 0;

    //Heading para servicios en Resumen
    const headingProductos = document.createElement('H3');
    headingProductos.textContent = 'Resumen de Servicios';
    resumen.appendChild(headingProductos);

    // Iterando y mostrando los servicios
    productos.forEach(producto => {
        const {id, precio, nombre} = producto;
        const contenedorProducto = document.createElement('DIV');
        contenedorProducto.classList.add('contenedor-producto');

        const textoProducto = document.createElement('P');
        textoProducto.textContent = nombre;

        const precioProducto =  document.createElement('P');
        precioProducto.innerHTML = `<span>Precio:</span> $${precio}`;

        // Incrementar el total de servicios y el valor total
        totalServicios += 1;
        totalValor += parseFloat(precio);

        contenedorProducto.appendChild(textoProducto);
        contenedorProducto.appendChild(precioProducto);

        resumen.appendChild(contenedorProducto);
    });

    // Redondear el total a dos decimales
    totalValor = totalValor.toFixed(3);

    // Precio total de los servicios seleccionados
    const PreciototalElement = document.createElement('p');
    PreciototalElement.innerHTML = `<span>Costo total:</span> $${totalValor} Mil`;

    //Heading para servicios en Resumen
    const headingVenta = document.createElement('H3');
    headingVenta.textContent = 'Resumen del Cliente';
    resumen.appendChild(headingVenta);

    // Boton para aceptar la venta

    const botonConfirmarVenta = document.createElement('BUTTON');
    botonConfirmarVenta.classList.add('boton');
    botonConfirmarVenta.textContent = 'Confirmar pedido';
    botonConfirmarVenta.onclick = confirmaVenta;


    // Agregar los elementos al resumen
    resumen.appendChild(nombreVendedorElement);
    resumen.appendChild(fechaVentaElement);
    resumen.appendChild(horaVentaElement);
    resumen.appendChild(PreciototalElement);
    resumen.appendChild(botonConfirmarVenta);
}

async function confirmaVenta(){

    const { nombre, fecha, hora, productos, id } = venta;
    const idProductos = productos.map( producto => producto.id);

    // Calcular total de servicios y valor
    const totalServicios = productos.length;
    const totalValor = productos.reduce((total, producto) => total + parseFloat(producto.precio), 0);
    venta.servicios = totalServicios;
    venta.valor = totalValor.toFixed(3).toString();

    const datos = new FormData();
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);
    datos.append('nombre', nombre);
    datos.append('productos', idProductos);
    datos.append('servicios', totalServicios); 
    datos.append('valor', venta.valor); // Utilizar el valor total convertido a cadena de texto


    try  {
        const url = `${location.origin}/api/ventas`
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
    
        const resultado = await respuesta.json();
        if(resultado.resultado) {
            Swal.fire({
                icon: "succes",
                title: "Servicio Aprobado",
                text: "El servicio solicitado fue cargado correctamente",
                button: 'OK'
              }).then( () => {
                    window.location.reload();
              })
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un error al guardar el servicio",
          });
    }

}