define([
    'jquery',
], function($) {
    'use strict';
    $(document).ready(function() {
        $("#selectNum").on("change", function(){

            // var heightValue = $("input[name='height']").val();
            // var weightValue = $("input[name='weight']").val();

            var num = $("select[name='Numero']").val();

            var url = "http://curso.net/ajaxrequest/index/index";
            $.ajax({
            url: url,
            type: "POST",
            data: {numero:num},
            showLoader: true,
            cache: false,
            success: function(request){
                var arr = JSON.parse(request.output);
                $("#selectMarca").empty();
                var select = document.getElementById("selectMarca");
                JSON.parse(arr[1]).forEach((element, index, array) => {
                    if(index == 0){
                        var unique = document.createElement("option");
                        unique.setAttribute("disabled", "disabled");
                        unique.setAttribute("selected", "true");
                        unique.textContent = "Marca";
                        select.appendChild(unique);
                    }
                    var i = document.createElement("option");
                    i.setAttribute("value", element["Nombre"]);
                    i.textContent = element["Nombre"];
                    select.appendChild(i);
                });
                //console.log(JSON.parse(arr[1])[0]['Nombre']);
            }
        });
        return false;
        });
    });
}(jQuery));