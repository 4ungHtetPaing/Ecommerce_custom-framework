function addToCart(num) {
    var ary = JSON.parse(localStorage.getItem("items"));
    if (ary == null) {
        var itemAry = [num];
        localStorage.setItem('items', JSON.stringify(itemAry));
    } else {
        $con = ary.indexOf(num);
        if ($con == -1) {
            ary.push(num);
            localStorage.setItem('items', JSON.stringify(ary));
        }

    }
    showItemCount();
}
function getCartItem() {
    var ary = JSON.parse(localStorage.getItem("items"));
    return ary;
}
function showItemCount() {
    var ary = JSON.parse(localStorage.getItem("items"));
    if(ary != null){
        $("#cart_count").html(getCartItem().length);
    }else{
        $("#cart_count").html(0);
    }
}
function deleteCartItem(id) {
    var ary = JSON.parse(localStorage.getItem("items"));
    if (ary != null) {
        ary.forEach( (item) => {
            if (item == id) {
                var ind = ary.indexOf(item);
                ary.splice(ind, 1);
            }
        });
    }
    localStorage.setItem('items', JSON.stringify(ary));
    showItemCount();
}
function clearCart() {
    localStorage.removeItem("items");
}
showItemCount();
