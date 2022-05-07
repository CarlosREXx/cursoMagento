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
    });
});