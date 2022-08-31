$(document).ready(function () {
    $(".amount").keyup(function () {
        let stock = $(".stock").val();
        let price = $(".price").val();
        let amount = $(this).val();

        let fullPayment = price * amount;
        let totalStock = stock - amount;
        $(".value").html(fullPayment);
        $(".units").html(totalStock);
        $(".valueinpt").val(fullPayment);
        
        if ( totalStock < 0 ) {
            $(".alert").html(
                '<div class="alert alert-warning" role="alert">Has  superado las unidades disponibles </div> '
            );
        } else {
            $(".alert").html(
                '<div class="alert alert-primary" role="alert"> Hay unidades suficientes para realizar este pedido  </div>'
            );
         
        }
    });
});

$(".cerrar").click(function () {
    $(".amount").val("");
    $(".value").html("");
    $(".alert").html("");

});
