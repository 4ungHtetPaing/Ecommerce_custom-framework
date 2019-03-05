@extends('layout.master')
@section('title',"Cart")
@section('myStyle')
@endsection
@section("content")
    <input type="hidden" id="token" value="{{\App\Classes\CSRFToken::_token()}}">
    <div class="container my-5">
            <h4 class="text-info mb-3">Cart Items</h4>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                         <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                    </tbody>
                    <tr class="d-none" id="paymentBtn">
                        <td colspan="7" class="text-right">
                            <form action="{{url('/payment/stripe')}}" method="post">
                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="{{App\Classes\Session::get('publishable_key')}}"
                                    data-name="MyShop"
                                    data-description="We are the Best"
                                    {{-- data-amount="{{App\Classes\Session::get('total_amount') * 100}}" --}}
                                    data-email="{{App\Classes\Auth::user("user_name")}}@gmail.com"
                                    data-locale="auto">
                                </script>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>          
        </div>
        
@endsection
@section('myScript')
    <script>
        function loadProduct(){
            $.ajax({
                type: "POST",
                url: "{{url('/cart')}}",
                data: {
                    "cart": getCartItem(),
                    "token": $("#token").val()
                },
                success: function (results) {
                    saveProduct(results);
                },
                errors: function (reponse) {
                    alert(response.responseText);
                }
            });
        }
        function saveProduct(res)
        {
            localStorage.setItem("products", res);
            var results = JSON.parse(localStorage.getItem("products"));
            showProduct(results);
        }
        function addQry(id){
            var results = JSON.parse(localStorage.getItem("products"));            
            results.forEach( (result) => {              
                if (result.id === id) {
                    result.qty = result.qty + 1;
                }
            });
            saveProduct(JSON.stringify(results));
        }
        function decudeQry(id){
            var results = JSON.parse(localStorage.getItem("products"));
            results.forEach( (result) => {
                if (result.id === id) {
                   if(result.qty > 1){
                        result.qty = result.qty - 1;          
                   }          
                }
            });
            saveProduct(JSON.stringify(results));
        }
        function deleteItem(id){
            var results = JSON.parse(localStorage.getItem("products"));
            results.forEach( (result) => {
                if (result.id === id) {
                   var ind = results.indexOf(result);
                   results.splice(ind, 1);       
                }
            });
            deleteCartItem(id);
            saveProduct(JSON.stringify(results));
        }
        function showProduct(results){
            var str = "";
            var total = 0;
            results.forEach( (result) => {
                total += result.qty * result.price;
                str += "<tr>";
                str += `
                    <td>${result.id}</td>
                    <td><img src="${result.image}" alt="" with="100" height="80"></td>
                    <td>${result.name} </td>
                    <td>$ ${result.price} </td>
                    <td>${result.qty}</td>
                    <td>
                        <i class="fa fa-plus mr-2" style="cursor:pointer;" onclick="addQry(${result.id})"></i>
                        <i class="fa fa-minus mr-2" style="cursor:pointer;" onclick="decudeQry(${result.id})"></i>
                        <i class="fa fa-trash text-danger" style="cursor:pointer;" onclick="deleteItem(${result.id})"></i>
                    </td>
                    <td> $ ${(result.qty * result.price).toFixed(2)}</td>
                `;
                str += "</tr>";
            });
            str += `
                <tr>
                    <td colspan="6" class="text-right">Total </td>
                    <td>$ ${total.toFixed(2)}</td>
                </tr>
                <tr id="checkOutBtn">
                <td colspan="7" class="text-right"><button class="btn btn-primary btn-sm" onclick="payOut()">Check Out</button></td>      </tr>
            `
            $("#table_body").html(str);
        }

        function payOut(){

            <?php if (\App\Classes\Auth::check("user_id")) { ?>
                $("#paymentBtn").removeClass('d-none');
                $("#checkOutBtn").addClass("d-none");
                var results = JSON.parse(localStorage.getItem("products"));
                $.ajax({
                    type: "POST",
                    url: "{{url('/payout')}}",
                    data: {
                        "items": results,
                        "token": $("#token").val()
                    },
                    success: function (results) {
                        // console.log(results);
                    },
                    errors: function (reponse) {
                        console.log(response.responseText);
                    }
                });

           <?php  }else{ ?>
                window.location.href = "/E-commerce/public/user/login";
          <?php  } ?>
           
        }

        loadProduct();
    </script>
@endsection
