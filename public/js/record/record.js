$(function () {

    var sub_total = 0;


    var tot_item   = 0;
    var tot_serv   = 0;

    var total = $('#record_total').val();

    total = total.replace('R$',"");

    if(total != '')
    {
        total = parseFloat(total);

        sub_total = total;
    }
    //create
    $('.add-item').on('click', function () {

        var url        = window.location.href;
        var product_id = $('#item_id').val();
        var amount     = $('#item_amount').val();
        var wrapper    = $('#content_item');

        
        if(amount != null && amount > 0 && product_id != '')
        {
            $.ajax({
                url: url + '/' + product_id + '/consulta-item/' + amount,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
    
                    if(data.stock >= data.quantity)
                    {
    
                        $(wrapper).append('<tr><td>' + data.name + '</td> <td>' + data.brand + '</td> <td>' + data.quantity + '</td> <td> R$ ' + data.price + '</td> <td> R$ ' + data.total_price.toFixed(2) + '</td> <input type="hidden" name="item_id[]" value="' + data.id + '"><input type="hidden" name="item_quantity[]" value="' + data.quantity + '">' + '<input type="hidden" name="subtotal" class="item" value="' + data.total_price + '"> ' + '<td><a class="btn btn-danger btn-xs remove" id="' + data.id + data.total_price + '"><span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a></td>');
    
                        //alert(sub_total + 'çç' + data.total_price);
    
                        sub_total += data.total_price;

                        $('#total_item').val("R$ " + getitemSoma().toFixed(2));
    
                        $('.remove').on('click', function () {
                            //var x = $(this).attr("id");
                            //var amount = document.getElementById("amount").value;

                            $('#total_item').val("R$ " + getitemSoma().toFixed(2));
    
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
                    }
                    else
                    {
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Quantidade solicitada maior que a quantidade em estoque!',
                        })
                    }
                    
    
                    //atualiza texto do valor
                    document.getElementById("soma").innerHTML = "R$ " + sub_total.toFixed(2);
                    //atualiza campo hidden do valor
                    document.getElementById("amount").value = sub_total.toFixed(2);
    
                    console.log("Subtotal atualizado->" + sub_total.toFixed(2));
    
                    $('#record_total').val("R$ " + sub_total.toFixed(2));
                }
            })            
        }  
        else
        {
            if(product_id == '')
            {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Produto não selecionado!',
                    })
            }
            else
            {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Quantidade vazia ou menor que 1!',
                    })
            }
        }      
    });

    $('.add-service').on('click', function () {

        var url = window.location.href;
        var service_id = $('#service_id').val();
        var amount = $('#service_amount').val();
        var wrapper = $('#content_service');

        var total = $('#record_total').val();

        $('#prevision').attr('disabled', false);
        $('#conclusion').attr('disabled', false);

        //var total = $('#record_total').val();
        if(amount != null && amount > 0 && service_id != '')
        {
            $.ajax({
                url: url + '/' + service_id + '/consulta-service/' + amount,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $(wrapper).append('<tr><td>' + data.name + '</td> <td>' + data.quantity + '</td> <td> R$ ' + data.price + '</td> <td> R$ ' + data.total_price.toFixed(2) + '</td> <input type="hidden" name="service_id[]" value="' + data.id + '"><input type="hidden" name="service_quantity[]" value="' + data.quantity + '">' + '<input type="hidden" name="subtotal" class="service" value="' + data.total_price + '"> ' + '<td><a class="btn btn-danger btn-xs remove" id="' + data.id + data.total_price + '"><span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a></td> </tr>');
    
                    sub_total += data.total_price;

                    $('#total_service').val("R$ " + getsrvSoma().toFixed(2));
    
                    $('.remove').on('click', function () {
                        //var x = $(this).attr("id");
                        //var amount = document.getElementById("amount").value;
    
                        $(this).parents('tr').remove();

                        $('#total_service').val("R$ " + getsrvSoma().toFixed(2));
    
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
        }
        else
        {
            if(service_id == '')
            {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Serviço não selecionado!',
                    })
            }
            else
            {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Quantidade vazia ou menor que 1!',
                    })
            }
        }

    });
    //fim create

    $('.remove').on('click', function () {
        //var x = $(this).attr("id");
        //var amount = document.getElementById("amount").value;
        debugger
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
        var clientid = $('#client_id').val();
        var id = $('#client_select').val();
        var cpf = $('#client_cpf').val();
        var name = $('#client_name').val();

        $.ajax({
            url: url + '/consulta-client/' + id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#client_id').val(data.id);
                $('#client_name').val(data.name);
                $('#client_cpf').val(data.cpf);
                $('#client_tel').val(data.tel);
            }
        })  
    });
});

function getsrvSoma(){

    var arr = document.getElementsByClassName('service');
    //alert(arr.length);
    var tot = 0;
    for (var i = 0; i < arr.length; i++) {
        if (parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);
        }

    if(tot <= 0)
    {
        $('#prevision').attr('disabled', true);
        $('#conclusion').attr('disabled', true);
    }

    return tot;

};

function getitemSoma(){

    var arr = document.getElementsByClassName('item');
    //alert(arr.length);
    var tot = 0;
    for (var i = 0; i < arr.length; i++) {
        if (parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);
    } 

    return tot;
};

/*
$('#create').on('click', function (e) {
    
    alert('item');

    var item = document.getElementsByClassName('item');
    var serv = document.getElementsByClassName('service');

    

    if(item && serv == '')
    {
        e.preventDefault();

        swal({
            type: 'error',
            title: 'Oops...',
            text: 'Selecione ao menos um item!',
            })
    }
});*/
