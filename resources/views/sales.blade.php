@extends('layouts.app')

@section('content')
    <div class="contenedor">
        <div class="contenedorList">
            <section>
                <div class="contenedorCartas">
                    @foreach ($products as $items)
                        {{-- Carta de presentación del producto --}}
                        <div class="card">
                            <img src="{{ $items->reference }}" alt="" />
                            <h4>{{ $items->name }}</h4>
                            <p>
                                precio : {{ $items->price }}
                            </p>
                            <p>
                                stock: {{ $items->stock }}
                            </p>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop{{ $items->id }}">
                                Selecinar
                            </button>
                        </div>
                        {{-- Modal de agregar producto al canasto --}}
                        <div class="modal fade" id="staticBackdrop{{ $items->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            {{-- Formulario de canasto --}}

                            <form action="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close cerrar" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert"></div>
                                            <h2>{{ $items->name }}</h2>
                                            <input type="hidden" value="{{ $items->stock }}" class="stock">
                                            <input type="hidden" value="{{ $items->price }}" class="price">
                                            <p>Precio:{{ $items->price }}</p>
                                            <p>Peso :{{ $items->weight }}</p>

                                            <div class="mb-3">
                                                <label for="cantidad" class="form-label">Cantidad</label>
                                                <input id="amount" type="text" class="form-control amount">
                                                <div class="form-text">Ingrese la cantidad </div>
                                            </div>
                                            <div>
                                                <p>Valor a pagar:<span class="value"></span></p>
                                                <p>Unidades disponibles:<span class="units"></span></p>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary cerrar"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{-- end Formulario de canasto --}}

                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        {{-- Listado producto canasto --}}
        <div class="contenbasket">
            <section class="productosDestacados">
                <h1 class="titel">Productos destacados </h1>
                <div class="contenedorCartas">


                </div>
            </section>
        </div>
    </div>

@endsection
@section('script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection