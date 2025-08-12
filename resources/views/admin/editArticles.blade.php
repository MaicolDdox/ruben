@extends('components.layouts.app.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Artículo</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body bg-light">
                        <form action="{{ route('admin.update', $datos->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre del Artículo</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $datos->name) }}" required>
                            </div>

                            <!-- Imagen actual -->
                            <div class="mb-3">
                                <label class="form-label">Imagen actual</label><br>
                                @if ($datos->url_img)
                                    <img src="{{ asset('storage/' . $datos->url_img) }}" alt="Imagen actual"
                                        style="max-width:120px;">
                                @else
                                    <span class="text-muted">No hay imagen</span>
                                @endif
                            </div>

                            <!-- Nueva Imagen -->
                            <div class="mb-3">
                                <label for="url_img" class="form-label">Cambiar Imagen</label>
                                <input type="file" class="form-control" name="url_img" id="url_img">
                                <small class="text-muted">Si no seleccionas una imagen, se mantendrá la actual.</small>
                            </div>

                            <!-- Categoría -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Categoría</label>
                                <select class="form-select" name="category" id="category" required>
                                    <option disabled>Selecciona una categoría</option>
                                    <option value="electronica"
                                        {{ old('category', $datos->category) == 'electronica' ? 'selected' : '' }}>
                                        Electrónica</option>
                                    <option value="ropa"
                                        {{ old('category', $datos->category) == 'ropa' ? 'selected' : '' }}>Ropa</option>
                                    <option value="hogar"
                                        {{ old('category', $datos->category) == 'hogar' ? 'selected' : '' }}>Hogar
                                    </option>
                                    <option value="comida"
                                        {{ old('category', $datos->category) == 'comida' ? 'selected' : '' }}>Comida
                                    </option>
                                </select>
                            </div>

                            <!-- Precio -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Precio</label>
                                <input type="number" class="form-control" name="price" id="price"
                                    value="{{ old('price', $datos->price) }}" required>
                            </div>

                            <!-- Botón Enviar -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">Actualizar Artículo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection