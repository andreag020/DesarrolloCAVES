const createApp = Vue.createApp;

createApp({
 
    data() {
        return {
            productos: [],
            form: {
                nombre: '',
                descripcion: '',
                cantidad: '',
                precio: ''
            },
            editando: null,
            mensaje: {
                texto: '',
                tipo: 'alert-success'
            }
        };
    },
    methods: {
        async cargarProductos() {
            try {
                const response = await axios.get(BASE_URL + 'productos');
                this.productos = response.data;
            } catch (error) {
                this.mostrarMensaje('Error al cargar productos', 'alert-danger');
                console.error(error);
            }
        },
        editarProducto(producto) {
            this.editando = producto.id;
            this.form = {
                nombre: producto.nombre,
                descripcion: producto.descripcion,
                cantidad: producto.cantidad,
                precio: producto.precio
            };
        },
        cancelarEdicion() {
            this.editando = null;
            this.form = { nombre: '', descripcion: '', cantidad: '', precio: '' };
        },
        async guardarProducto() {
            try {
                let response;

                if (this.editando) {
                    response = await axios.post(BASE_URL + 'actualizar/' + this.editando, this.form);
                } else {
                    response = await axios.post(BASE_URL + 'guardar', this.form);
                }

                if (response.data.success) {
                    this.mostrarMensaje(response.data.message, 'alert-success');
                    this.form = { nombre: '', descripcion: '', cantidad: '', precio: '' };
                    this.editando = null;
                    this.cargarProductos();
                } else {
                    this.mostrarMensaje(response.data.message, 'alert-danger');
                }
            } catch (error) {
                this.mostrarMensaje('Error al guardar producto', 'alert-danger');
                console.log(error);
            }
        },
        async eliminarProducto(id) {
            if (!confirm('¿Eliminar producto?')) return;

            try {
                const response = await axios.post(BASE_URL + 'eliminar/' + id);

                if (response.data.success) {
                    this.mostrarMensaje(response.data.message, 'alert-warning');
                    this.cargarProductos();
                } else {
                    this.mostrarMensaje(response.data.message, 'alert-danger');
                }
            } catch (error) {
                this.mostrarMensaje('Error al eliminar producto', 'alert-danger');
                console.error(error);
            }
        },
        mostrarMensaje(texto, tipo) {
            this.mensaje.texto = texto;
            this.mensaje.tipo = tipo;

            setTimeout(() => {
                this.mensaje.texto = '';
            }, 3000);
        }
    },
    mounted() {
        this.cargarProductos();
    }
}).mount('#app');