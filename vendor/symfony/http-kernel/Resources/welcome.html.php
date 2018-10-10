<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Convert Money project</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script>
    
        $(document).ready(function(){

            console.log("jquery is working") ;
            var currencyList = [

                {

                    name : 'Singapore Dollar',
                    value : 'SGD' 

                },
                {

                    name : 'Japanese Yen',
                    value : 'JPY'

                },
                {

                    name : 'US Dollar',
                    value : 'USD'

                },
                {

                    name : 'Euro' ,
                    value : 'EUR' 

                }

            ]

            var totalCurrencyList = currencyList.length ;
            var defaultCurrencyList = '' ;
            var tranformCurrencyList = '' ; 
            
            for(var i = 0 ; i < totalCurrencyList ;i++){
                
                defaultCurrencyList = defaultCurrencyList + '<option value = "'+ currencyList[i].value +'-'+ currencyList[i].name  +'">'+ currencyList[i].name  +'</option>' ;

                if(i == 2){

                    tranformCurrencyList = tranformCurrencyList + '<option value = "'+ currencyList[i].value +'-'+ currencyList[i].name  +'" selected>'+ currencyList[i].name  +'</option>' ;

                }else{

                    tranformCurrencyList = tranformCurrencyList + '<option value = "'+ currencyList[i].value +'-'+ currencyList[i].name  +'">'+ currencyList[i].name  +'</option>' ;

                }

            }

            $("#defaultCurrencySelectList").html(defaultCurrencyList);
            $("#tranformCurrencySelecetList").html(tranformCurrencyList);

            $('.currency_list').on('change', function (e) {

                if($('#defaultCurrencySelectList').val() == $('#tranformCurrencySelecetList').val()){

                    alert('Currency must not be the same') ;
                    return false ;

                }

                // current currency
                var currentCurrencyValue = $('#defaultCurrencyInput').val()
                var defaultCurrencySelectList = $('#defaultCurrencySelectList').val().split('-'); ;
                var currentCurrencyName = defaultCurrencySelectList[0] ;
                var currentCurrencyFullname= defaultCurrencySelectList[1] ; 
                console.log(currentCurrencyName + '  ' + currentCurrencyFullname) ;

                //tranform currency 
                var tranformCurrencyValue = $('#tranformCurrencyInput').val()
                var tranformCurrencySelecetList = $('#tranformCurrencySelecetList').val().split('-'); ;
                var tranformCurrencyName = tranformCurrencySelecetList[0] ;
                var tranformCurrencySFullName = tranformCurrencySelecetList[1] ;
                console.log(tranformCurrencyName + '  ' + tranformCurrencySFullName) ; 
                getMoneyConvert(currentCurrencyName ,tranformCurrencyName  ,currentCurrencyValue ,currentCurrencyFullname ,tranformCurrencySFullName) ;

            });

            $("#defaultCurrencyInput").keypress(function(){

                if($('#defaultCurrencySelectList').val() == $('#tranformCurrencySelecetList').val()){

                    alert('Currency must not be the same') ;
                    return false ;

                }

                // current currency
                var currentCurrencyValue = $('#defaultCurrencyInput').val()
                var defaultCurrencySelectList = $('#defaultCurrencySelectList').val().split('-'); ;
                var currentCurrencyName = defaultCurrencySelectList[0] ;
                var currentCurrencyFullname= defaultCurrencySelectList[1] ; 
                console.log(currentCurrencyName + '  ' + currentCurrencyFullname) ;

                //tranform currency 
                var tranformCurrencyValue = $('#tranformCurrencyInput').val()
                var tranformCurrencySelecetList = $('#tranformCurrencySelecetList').val().split('-'); ;
                var tranformCurrencyName = tranformCurrencySelecetList[0] ;
                var tranformCurrencySFullName = tranformCurrencySelecetList[1] ;
                console.log(tranformCurrencyName + '  ' + tranformCurrencySFullName) ; 
                getMoneyConvert(currentCurrencyName ,tranformCurrencyName  ,currentCurrencyValue ,currentCurrencyFullname ,tranformCurrencySFullName) ;

            });

            function getMoneyConvert(fromMoney ,toMoney ,value ,fromMoneyFullname ,toMoneyFullname){

                $.ajax({
                    //example url https://forex.1forge.com/1.0.3/convert?from=USD&to=EUR&quantity=100&api_key=EQSnBJo9GkXJRdzzoWGAjxD2b7RwUtsS
                    url: 'https://forex.1forge.com/1.0.3/convert?from='+fromMoney +'&to='+toMoney+'&quantity='+value+'&api_key=EQSnBJo9GkXJRdzzoWGAjxD2b7RwUtsS',
                    type: 'GET',
                    data: '',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    async: false,
                    success: function (resultsData) {

                        console.log(resultsData) ;
                        $('#tranformCurrencyInput').val(resultsData.value) ;
                        var fromMoneyText = value + ' ' + fromMoneyFullname + ' equals' ;
                        $("#default_currency").html(fromMoneyText);
                        var toMoneyText = resultsData.value + ' ' + toMoneyFullname ;
                        $("#tranform_currency").html(toMoneyText);
                        

                    }
                });


            }


        });
    
    </script>
    <style>

        #default_currency{

            font-size: 20px;
            font-weight: bold;
            color : gray ;
            margin-top : 5px

        }

        #tranform_currency{

            font-size: 35px;
            font-weight: bold;

        }

        .row{

            margin-top : 5px ;

        }

    </style>

</head>
<body>
<div class="container">

    <div id = "default_currency"></div>
    <div id = "tranform_currency"></div>
    <!-- default currency -->
    <div class="row">
        <div class="col-sm-3">
            <input type="number" class="form-control" id="defaultCurrencyInput" value = '0'>
        </div>
        <div class="col-sm-3">
            <select class="form-control currency_list" id="defaultCurrencySelectList">
            </select>
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3"></div>
    </div>
    <!-- tranform currency -->
    <div class="row">
        <div class="col-sm-3">
            <input type="number" class="form-control" id="tranformCurrencyInput">
        </div>
        <div class="col-sm-3">
            <select class="form-control currency_list" id="tranformCurrencySelecetList">
            </select>
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3"></div>
    </div>
</div>

</body>
</html>
