@extends('layouts.app')

@section('content')
    <div>
        {{-- formulario producto --}}
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Registros productos </h5>
                <form method="POST" action="/createProdust">
                    @csrf
                    <div class="mb-3">
                        <label for="nameProduct" class="form-label">Nombre producto</label>
                        <input type="text" name="name" class="form-control" id="nameProduct">
                    </div>

                    <div class="mb-3">
                        <label for="Referencia" class="form-label"> Referencia </label>
                        <input type="text" name="reference" class="form-control" id="Referencia">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label"> Precio </label>
                        <input type="text" name="price" class="form-control" id="price">
                    </div>


                    <div class="mb-3">
                        <label for="weight" class="form-label"> Peso </label>
                        <input type="text" name="weight" class="form-control" id="weight">
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label"> stock </label>
                        <input type="text" name="stock" class="form-control" id="stock">
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label"> Categoría </label>
                        <select name="category_id" class="form-label" id="category_id">
                            @foreach ($category as $items)
                                <option value="{{ $items->id }}">{{ $items->name_category }}</option>
                            @endforeach
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        {{-- tabla productos --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Referencia</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">stock</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $items)
                    <tr>
                        <th scope="row">{{ $items->id }}</th>
                        <td>{{ $items->name }}</td>
                        <td>{{ $items->reference }}</td>
                        <td>{{ $items->price }}</td>
                        <td>{{ $items->weight }}</td>
                        <td>{{ $items->stock }}</td>
                        <td>{{ $items->name_category }}</td>
                        <td><a href="/deleteProducts/{{ $items->id }}">eliminar</a></td>
                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $items->id }}">
                                Launch demo modal
                            </button></td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $items->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- formulario update --}}
                                    <form method="post" action="/updateProduct">
                                        @csrf
                                        <input type="text" name="id" style="display: none"
                                            value="{{ $items->id }}">
                                        <div class="mb-3">
                                            <label for="nameProduct" class="form-label">Nombre producto</label>
                                            <input type="text" name="name" class="form-control" id="nameProduct">
                                        </div>

                                        <div class="mb-3">
                                            <label for="Referencia" class="form-label"> Referencia </label>
                                            <input type="text" name="reference" class="form-control" id="Referencia">
                                        </div>

                                        <div class="mb-3">
                                            <label for="price" class="form-label"> Precio </label>
                                            <input type="text" name="price" class="form-control" id="price">
                                        </div>


                                        <div class="mb-3">
                                            <label for="weight" class="form-label"> Peso </label>
                                            <input type="text" name="weight" class="form-control" id="weight">
                                        </div>

                                        <div class="mb-3">
                                            <label for="stock" class="form-label"> stock </label>
                                            <input type="text" name="stock" class="form-control" id="stock">
                                        </div>

                                        <div class="mb-3">
                                            <label for="category_id" class="form-label"> Categoría </label>
                                            <select name="category_id" class="form-label" id="category_id">
                                                @foreach ($category as $items)
                                                    <option value="{{ $items->id }}">{{ $items->name_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </tbody>
        </table>


    </div>
@endsection