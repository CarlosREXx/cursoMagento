define([
    'jquery',
    'mage/url',
    'domReady!'
], function($, urlBuilder) {
    'use strict';

    urlBuilder.setBaseUrl(BASE_URL);
    var ws = urlBuilder.build('ajaxrequest/result/result');
    $(document).ready(function() {
        $("#selectNum").on("change", function(){
            var num = $("select[name='Numero']").val();

            var url = ws;
            $.ajax({
            url: url,
            type: "POST",
            data: {numero:num},
            showLoader: true,
            cache: false,
            dataType: "json",
            success: function(data){
                $("#selectMarca").empty().html("<option disabled='disabled' selected='true'>Marca</option>");
                var select = document.getElementById("selectMarca");
                data["data"].forEach((element) => {
                    var i = document.createElement("option");
                    i.setAttribute("value", element["Nombre"]);
                    i.textContent = element["Nombre"];
                    select.appendChild(i);
                });
                data["Table"].forEach(element =>{
                    JSON.parse(element["presencia"]).forEach(e => {
                        if(element["marca_name"] == "BMW")
                            console.log(e);
                    });
                });
            }
        });
        return false;
        });
        var pdf = urlBuilder.build('ajaxrequest/torino/generatepdf');
        $('#generate_pdf').on('click', function(){
            debugger;
            var id = $('#value_hidden').val();
            $.ajax({
                url: pdf,
                type: "POST",
                data: {id: id},
                showLoader: true,
                cache: false,
                dataType: "json",
                success: function(data, status, xhr){
                    debugger;
                    if(!data['error']){
                        $('.img-qr').attr('src', data['qr']);
                        $('.qr-content').removeClass('d-none');
                        $('.qr-content').addClass('d-flex');
                    }else{
                        this.error(data['error'], status, xhr, data['message_error']);
                    }
                },
                error: function(error, status, xhr, message){
                    var detail = status+' '+xhr.status+' '+message;
                    alert('Error happens. Try again. ('+detail+')');
                    console.log(error);
                }
            })
        });   
    });
});