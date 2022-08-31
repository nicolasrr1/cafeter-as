@extends('layouts.app')

@section('content')
    @include('sweetalert::alert')

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
                            @if ($items->stock != 0)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{ $items->id }}">
                                    Selecinar
                                </button>
                           
                                
                            @else
                                <p>No hay unidades  <a href="/">Recarga unidades </a></p>
                            @endif

                        </div>
                        {{-- Modal de agregar producto al canasto --}}
                        <div class="modal fade" id="staticBackdrop{{ $items->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            {{-- Formulario de canasto --}}

                            <form action="/createBasket" method="POST">
                                @csrf
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close cerrar" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert"></div>
                                            <input type="hidden" value="{{ $items->id }}" name="products_id">
                                            <h2>{{ $items->name }}</h2>
                                            <input type="hidden" value="{{ $items->stock }}" class="stock">
                                            <input type="hidden" value="{{ $items->price }}" class="price">
                                            <p>Precio:{{ $items->price }}</p>
                                            <p>Peso :{{ $items->weight }}</p>

                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Cantidad</label>
                                                <input id="amount" name="amount" type="number"
                                                    class="form-control amount">
                                                <div class="form-text">Ingrese la cantidad </div>
                                            </div>
                                            <div>
                                                <input type="hidden" class="valueinpt" name="payment">
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
                <h2 class="titel">Total a pagar : {{ $suma }} </h2>
                <div class="contenedorCartas">
                    <form action="/sellBasket" method="post">
                        @csrf


                        <button class="btn btn-primary" type="submit">finalizar pedido </button>

                        @foreach ($sale as $items)
                            <div class="card">

                                <input type="hidden" name="sale_id[]" value="{{ $items->sale_id }}">
                                <img src="{{ $items->reference }}" alt="" />
                                <h4>{{ $items->name }}</h4>
                                <p>
                                    precio : {{ $items->price }}
                                </p>
                                <p>
                                    stock: {{ $items->stock }}
                                </p>


                            </div>
                        @endforeach
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
