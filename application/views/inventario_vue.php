<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="app" class="container py-4">
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Inventario</h3>
                </div>

                <div class="card-body">
                    <form @submit.prevent="guardarProducto" class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" v-model="form.nombre" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Descripción</label>
                            <input type="text" class="form-control" v-model="form.descripcion" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Cantidad</label>
                            <input type="number" class="form-control" v-model="form.cantidad" required min="0">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" v-model="form.precio" required min="0">
                        </div>
                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button class="btn btn-success" type="submit">
                                {{ editando ? 'Actualizar' : 'Guardar' }}
                            </button>
                            <button v-if="editando" class="btn btn-secondary" 
                                type="button" @click="cancelarEdicion">
                                Cancelar
                            </button>
                        </div>
                    </form>
                    <div v-if="mensaje.texto" class="alert" :class="mensaje.tipo">
                        {{ mensaje.texto }}
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="productos.length === 0">
                                    <td colspan="6" class="text-center">No hay productos</td>
                                </tr>
                                <tr v-for="producto in productos" :key="producto.id">
                                    <td>{{ producto.id }}</td>
                                    <td>{{ producto.nombre }}</td>
                                    <td>{{ producto.descripcion }}</td>
                                    <td>{{ producto.cantidad }}</td>
                                    <td>{{ Number(producto.precio).toFixed(2) }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm me-1" 
                                            @click="editarProducto(producto)">
                                            Editar
                                        </button>
                                        <button class="btn btn-danger btn-sm" @click="eliminarProducto(producto.id)">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const BASE_URL = "<?= site_url('inventario/api') ?>";
    </script>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <?php
    function jsloadCache($srcArray = [], $cache_bust = true)
    {
        $output = '';
        foreach ($srcArray as $src) {
            $url = base_url($src);
            if ($cache_bust) {
                $url .= '?v=' . time();
            }
            $output .= '<script src="' . $url . '"></script>' . "\n";
        }
        return $output;
    }
    ?>

    <script src="<?= base_url('assets/js/inventario-app.js') . '?v=' . time() ?>"></script>
</body>
</html>