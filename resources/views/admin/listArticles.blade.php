@extends('components.layouts.app.app')

@section('content')
    <div class="container">
        <h1>Lista De Articulos</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">Articulo</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $art)
                            <tr>
                                <td>{{ $art->name }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $art->url_img) }}" style="max-width:100px;">
                                </td>
                                <td>{{ $art->category }}</td>
                                <td>{{ $art->price }}</td>
                                <td>
                                    <!-- Botón Editar -->
                                    @can('articles.edit')
                                        <a href="{{ route('admin.edit', $art->id) }}" class="btn btn-sm btn-warning me-2"
                                            title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    <!-- Botón Eliminar solo si tiene permiso -->
                                    @can('articles.delete')
                                        <form action="{{ route('admin.destroy', $art->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar este artículo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
