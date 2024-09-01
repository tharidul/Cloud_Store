function cartPayNow() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
        
            var obj = JSON.parse(t);

            var mail = obj["umail"];
            var amount = obj["amount"];
            var hash = obj["hash"];
            var order_id =obj["oid"];
            var items = obj["items"];
            var ids = [];
            var itemName = [];

            

            for (var i = 0; i < items.length; i++) {
                ids.push(items[i].id);
                itemName.push(items[i].item);
            }
            


            if (t == 1) {
                alert("Please login.");
                window.location = "index.php";
            } else if (t == 2) {
                alert("Please Update your profile");
                window.location = "userProfile.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveCartInvoice(orderId,mail,ids);
                    // window.location = "invoice.php";


                    
                };


                payhere.onDismissed = function onDismissed() {

                    console.log("Payment dismissed");
                };


                payhere.onError = function onError(error) {
                    console.log("Error:" + error);
                };


                var payment = {
                    "sandbox": true,
                    "merchant_id": "1222920",
                    "hash": hash,
                    "return_url": "http://localhost/cloud_store/cart.php",     
                    "cancel_url": "http://localhost/cloud_store/cart.php",     
                    "notify_url": "http://sample.com/notify",
                    "order_id": order_id,
                    "items": itemName,
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }
        }
    }

    r.open("GET", "buyCartProcess.php", true);
    r.send();
}


function saveCartInvoice(orderId,mail,ids) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", JSON.stringify(ids));
    f.append("m", mail);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {

                window.open("invoice.php?oid=" + orderId, "_blank");

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveCartInvoice.php", true);
    r.send(f);

}