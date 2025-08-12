@extends('components.layouts.app.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Formulario Para Crear Artículos</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body bg-light">
                        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Artículo</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Ingrese el nombre">
                            </div>

                            <!-- Imagen -->
                            <div class="mb-3">
                                <label for="url_img" class="form-label">Imagen del Artículo</label>
                                <input type="file" class="form-control" name="url_img" id="url_img">
                            </div>

                            <!-- Categoría -->
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select class="form-select" name="category" id="category">
                                    <option disabled selected>Selecciona una categoría</option>
                                    <option value="electronica">Electrónica</option>
                                    <option value="ropa">Ropa</option>
                                    <option value="hogar">Hogar</option>
                                    <option value="comida">Comida</option>
                                </select>
                            </div>

                            <!-- Precio -->
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" class="form-control" name="price" id="price"
                                    placeholder="Ingrese el precio">
                            </div>

                            <!-- Botón Enviar -->
                            <div class="text-center">
                                @can('articles.create')
                                    <button type="submit" class="btn btn-primary px-5">Guardar Artículo</button>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
