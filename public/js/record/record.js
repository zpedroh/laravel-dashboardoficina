$(function () {

    var sub_total = 0;

    var total = $('#record_total').val();

    if(total != '')
        {

        total = parseFloat(total);

        sub_total = total;
    }
    //create
    $('.add-item').on('click', function () {

        var url = window.location.href;
        var product_id = $('#item_id').val();
        var amount = $('#item_amount').val();
        var wrapper = $('#content');
        
        $.ajax({
            url: url + '/' + product_id + '/consulta-item/' + amount,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $(wrapper).append('<tr><td>' + data.name + '</td> <td>' + data.quantity + '</td> <td> R$ ' + data.price + '</td> <td> R$ ' + data.total_price.toFixed(2) + '</td> <input type="hidden" name="item_id[]" value="' + data.id + '"><input type="hidden" name="item_quantity[]" value="' + data.quantity + '">' + '<input type="hidden" name="subtotal" value="' + data.total_price + '"> ' + '<td><a class="btn btn-danger btn-xs remove" id="' + data.id + data.total_price + '"><span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a></td>');

                //alert(sub_total + 'çç' + data.total_price);

                sub_total += data.total_price;

                $('.remove').on('click', function () {
                    //var x = $(this).attr("id");
                    //var amount = document.getElementById("amount").value;

                    $(this).parents('tr').remove();

                    var arr = document.getElementsByName('subtotal');
                    //alert(arr.length);
                    var tot = 0;
                    for (var i = 0; i < arr.length; i++) {
                        if (parseFloat(arr[i].value))
                            tot += parseFloat(arr[i].value);
                    }
                    sub_total = tot;
                    document.getElementById('amount').value = tot.toFixed(2);
                    document.getElementById("soma").innerHTML = "R$ " + tot.toFixed(2);

                    $('#record_total').val("R$ " + sub_total.toFixed(2));
                });

                //atualiza texto do valor
                document.getElementById("soma").innerHTML = "R$ " + sub_total.toFixed(2);
                //atualiza campo hidden do valor
                document.getElementById("amount").value = sub_total.toFixed(2);

                console.log("Subtotal atualizado->" + sub_total.toFixed(2));

                $('#record_total').val("R$ " + sub_total.toFixed(2));
            }
        })
    });

    $('.add-service').on('click', function () {

        var url = window.location.href;
        var service_id = $('#service_id').val();
        var amount = $('#service_amount').val();
        var wrapper = $('#content');

        var total = $('#record_total').val();

        var total = $('#record_total').val();

        $.ajax({
            url: url + '/' + service_id + '/consulta-service/' + amount,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $(wrapper).append('<tr><td>' + data.name + '</td> <td>' + data.quantity + '</td> <td> R$ ' + data.price + '</td> <td> R$ ' + data.total_price.toFixed(2) + '</td> <input type="hidden" name="service_id[]" value="' + data.id + '"><input type="hidden" name="service_quantity[]" value="' + data.quantity + '">' + '<input type="hidden" name="subtotal" value="' + data.total_price + '"> ' + '<td><a class="btn btn-danger btn-xs remove" id="' + data.id + data.total_price + '"><span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a></td> </tr>');

                sub_total += data.total_price;

                $('.remove').on('click', function () {
                    //var x = $(this).attr("id");
                    //var amount = document.getElementById("amount").value;

                    $(this).parents('tr').remove();

                    var arr = document.getElementsByName('subtotal');
                    //alert(arr.length);
                    var tot = 0;
                    for (var i = 0; i < arr.length; i++) {
                        if (parseFloat(arr[i].value))
                            tot += parseFloat(arr[i].value);
                    }
                    sub_total = tot;
                    document.getElementById('amount').value = tot.toFixed(2);
                    document.getElementById("soma").innerHTML = "R$ " + tot.toFixed(2);

                    console.log("Subtotal atualizado->" + sub_total.toFixed(2));

                    $('#record_total').val("R$ " + sub_total.toFixed(2));
                });
/*
                //atualiza texto do valor
                document.getElementById("soma").innerHTML = "R$ " + sub_total.toFixed(2);
                //atualiza campo hidden do valor
                document.getElementById("amount").value = sub_total.toFixed(2);

                console.log("Subtotal atualizado->" + sub_total.toFixed(2));
*/
                $('#record_total').val("R$ " + sub_total.toFixed(2));
            }
        })

    });
    //fim create




    $('.remove').on('click', function () {
        //var x = $(this).attr("id");
        //var amount = document.getElementById("amount").value;

        $(this).parents('tr').remove();

        var arr = document.getElementsByName('subtotal');
        //alert(arr.length);
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value))
                tot += parseFloat(arr[i].value);
        }
        sub_total = tot;
        document.getElementById('amount').value = tot.toFixed(2);
        document.getElementById("soma").innerHTML = "R$ " + tot.toFixed(2);

        console.log("Subtotal atualizado->" + sub_total.toFixed(2));

        $('#record_total').val("R$ " + sub_total.toFixed(2));

        //atualiza texto do valor
        document.getElementById("soma").innerHTML = "R$ " + sub_total.toFixed(2);
        //atualiza campo hidden do valor
        document.getElementById("amount").value = sub_total.toFixed(2);

        console.log("Subtotal atualizado->" + sub_total.toFixed(2));

        $('#record_total').val("R$ " + sub_total.toFixed(2));
    });



    $('.select-client').on('change', function () {

        var url = window.location.href;
        var id = $('#client_id').val();
        var cpf = $('#client_cpf').val();
        var name = $('#client_name').val();

        $.ajax({
            url: url + '/consulta-client/' + id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#client_name').val(data.name);
                $('#client_cpf').val(data.cpf);
                $('#client_tel').val(data.tel);
            }
        })

    });

});

