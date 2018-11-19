$(function () {
    var sub_total = 0;

    $('#add').on('click', function () {

        var url = window.location.href;
        var id = $('#produto_id').val();
        var qty = $('#qty').val();
        var wrapper = $('#invoice-items');

        var txt_subtotal = $('#sub_total');

        //adiciona linha com novo produto calculado à tabela
        $.ajax({
            url: url + '/produto/getAttributes/'+id+'/'+qty,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                

                $(wrapper).append('<tr><td>'+ data.name + '</td> <td>R$ ' 
                    + data.price + '</td> <td>' + data.qty + '</td> <td>R$ ' + 
                    data.total_price + '</td> <input type="hidden" name="product_id[]" value="' 
                    + data.id + '"> <input type="hidden" name="product_qty[]" value="' + 
                    data.qty + '"> '+'<input type="hidden" name="subtotal" value="' + 
                    data.total_price + '"> '+'<td><a class="btn btn-danger btn-xs remove" id="'+data.total_price+
                    '"><span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a></td>'+'</tr>');
                    sub_total += data.total_price;
                    //remove o produto da venda
                    $('.remove').on('click', function () { 
                        //var x = $(this).attr("id");
                        //var amount = document.getElementById("amount").value;

                        $(this).parents('tr').remove();
                        
                        var arr = document.getElementsByName('subtotal');
                            //alert(arr.length);
                            var tot=0;
                            for(var i=0;i<arr.length;i++){
                                if(parseFloat(arr[i].value))
                                    tot += parseFloat(arr[i].value);
                            }
                            sub_total = tot;
                            document.getElementById('amount').value = tot.toFixed(2);
                            document.getElementById("soma").innerHTML = "R$ "+tot.toFixed(2);

                    });

                //atualiza texto do valor
                document.getElementById("soma").innerHTML = "R$ "+sub_total.toFixed(2);
                //atualiza campo hidden do valor
                document.getElementById("amount").value = sub_total.toFixed(2);

                console.log("Subtotal atualizado->"+sub_total.toFixed(2));
            }
        })

    });

});