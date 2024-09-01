const { reload } = require("browser-sync");

function signUP() {

    var f = document.getElementById("f");
    var l = document.getElementById("l");
    var e = document.getElementById("e");
    var p = document.getElementById("p");
    var m = document.getElementById("m");
    var g = document.getElementById("g");

    var form = new FormData;

    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var t = request.responseText;
            alert(t);
            if (t == "Account Create Successfully")

                alert(t);

        }
    }

    request.open("POST", "signUpProcess.php", true);
    request.send(form);
}

function signIn() {

    var email = document.getElementById("e2");
    var password = document.getElementById("p2");
    var rememberme = document.getElementById("rem");

    var form = new FormData();

    form.append("e", email.value);
    form.append("p", password.value);
    form.append("r", rememberme.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = this.responseText;
            if (t == "success") {
                window.location = "home.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "signinProcess.php", true);
    r.send(form);

}
var fpm;

function forgotPassword() {
    var email = document.getElementById("e2");


    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!email.value) {
        alert("Email field cannot be empty");
        return;
    }

    if (!emailRegex.test(email.value)) {
        alert("Please enter a valid email address");
        return;
    }

    var f = new FormData();
    f.append("email", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {


            if (r.responseText == "success") {
                var formgotpasswordModal = document.getElementById("fpModel");
                fpm = new bootstrap.Modal(formgotpasswordModal);
                fpm.show();
            } else {
                alert(r.responseText);
            }


        }
    }
    r.open("POST", "forgotPasswordUserfind.php", true);
    r.send(f);
}

function passwordResetConfirm() {

    var email = document.getElementById("e2");
    var newPw = document.getElementById("retypePassword");
    var otp = document.getElementById("otp");


    var f = new FormData();
    f.append("email", email.value);
    f.append("newPw", newPw.value);
    f.append("otp", otp.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            if (r.responseText == "success") {
                fpm.hide();
                alert(r.responseText);

            }
        }
    }
    r.open("POST", "forgotPasswordProcess.php", true);
    r.send(f);

}




function signout() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "success") {
                window.location = "home.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "signoutProcess.php", true)
    r.send();
}

function adminSignout() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "success") {
                window.location = "home.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "adminSignoutProcess.php", true)
    r.send();
}

function changeImg() {

    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileImg");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function updateProfile() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var proImg = document.getElementById("profileImg");

    var f = new FormData();

    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("m", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);
    f.append("image", proImg.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }


    r.open("POST", "userUpdateProcess.php", true);
    r.send(f);

}


function createSeller() {

    var sname = document.getElementById("sname");
    var smobile = document.getElementById("smobile");
    var sline1 = document.getElementById("sline1");
    var sline2 = document.getElementById("sline2");
    var scity = document.getElementById("scity");
    var sdistrict = document.getElementById("sdistrict");
    var rnumber = document.getElementById("rnumber");

    var f = new FormData();

    f.append("sn", sname.value);
    f.append("sm", smobile.value);
    f.append("sl1", sline1.value);
    f.append("sl2", sline2.value);
    f.append("sc", scity.value);
    f.append("sd", sdistrict.value);
    f.append("rn", rnumber.value);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            

            if (t="done") {
              
                window.location.reload();

            } else {
                // alert(t);
            }


        }
    }


    r.open("POST", "shopCreateProcess.php", true);
    r.send(f);

}

function addProduct() {

    var title = document.getElementById("title");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var price = document.getElementById("price");
    var ship = document.getElementById("shipping");
    var color = document.getElementById("color");
    var desc = document.getElementById("des");
    var qty = document.getElementById("qty");
    var image = document.getElementById("imageuploader");

    var f = new FormData();

    f.append("t", title.value);
    f.append("c", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("p", price.value);
    f.append("s", ship.value);
    f.append("d", desc.value);
    f.append("q", qty.value);
    f.append("clr", color.value);



    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {

        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Product added Successfully") {
                alert(t);
                window.location = "myshop.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);
}

function updateProduct() {
    var title = document.getElementById("title");
    var price = document.getElementById("price");
    var qty = document.getElementById("qty");
    var shipping = document.getElementById("shipping");
    var desc = document.getElementById("des");
    var pid = document.getElementById("pid").value;


    var f = new FormData();

    f.append("t", title.value);
    f.append("p", price.value);
    f.append("s", shipping.value);
    f.append("d", desc.value);
    f.append("q", qty.value);
    f.append("pid", pid.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product Updated") {
                window.location = "myshop.php";
            }

            alert(t);
        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(f);


}


function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;

            }

        } else {
            alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.");
        }

    }

}

function addToCart(id) {

    var qty = document.getElementById("qty");

    var f = new FormData();
    f.append("pid", id);
    f.append("qty", qty.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            // var responsePreview = document.getElementById("rt");
            // responsePreview.innerHTML = t;
        }
    }

    r.open("POST", "addToCartProcess.php", true);
    r.send(f);

}

function cart_qty(id) {

    var new_qty = document.getElementById("cart_qty_" + id);
    var f = new FormData();

    f.append("nq", new_qty.value);
    f.append("pid", id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            location.reload();

        }
    }

    r.open("POST", "cart_Qty_Process.php", true);
    r.send(f);
}

function removeFormCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Product Removed") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }


    r.open("GET", "removeFromCart.php?id=" + id, true);
    r.send();
}

function addtoWatchlist(id) {

    var r = new XMLHttpRequest();


    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            alert(t);
        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();
}

function deleteFromWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Product Removed") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromWatchlist.php?id=" + id, true);
    r.send();

}


function payNow(id) {
    var qty = document.getElementById("qty").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["umail"];
            var amount = obj["amount"];
            var orderId = obj["id"];
            var hash = obj["hash"];



            if (t == 1) {
                alert("Please login.");
                window.location = "index.php";
            } else if (t == 2) {
                alert("Please Update your profile");
                window.location = "accSettings.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty);
                    // window.location = "invoice.php";


                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1222920",    // Replace your Merchant ID
                    "hash": hash,
                    "return_url": "http://localhost/cloud_store/singleProductView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/cloud_store/singleProductView.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
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

    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);

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

    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}


function basicSearch(x) {

    var title = document.getElementById("searchTitle");
    var cid = document.getElementById("cid");
    var color = document.getElementById("color");
    var brand = document.getElementById("brand");
    var price = document.getElementById("price-range");
    var freeShipping = document.getElementById("freeShipping");

    var f = new FormData();

    f.append("title", title.value);
    f.append("cid", cid.value);
    f.append("brand", brand.value);
    f.append("price", price.value);
    f.append("page", x);
    f.append("freeShipping", freeShipping.checked ? "1" : "0");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);

}

function load_brand() {
    const category = document.getElementById("cid").value;
    const brandSelect = document.getElementById("brand");

    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const options = xhr.responseText;

            brandSelect.innerHTML = `<option value="0">Brand</option>${options}`;
        }
    }

    xhr.open("GET", `loadBrand.php?c=${category}`, true);
    xhr.send();
}


var av;
function adminSignIn() {

    var email = document.getElementById("email");
    var pw = document.getElementById("pw");

    var f = new FormData();

    f.append("em", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            t = r.responseText;

            if (t == "Success") {

                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();

            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "adminSignInProcess.php", true);
    r.send(f);

}

function verify() {
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                av.hide();
                window.location = "adminPanelOverView.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "verificationProcess.php?v=" + verification.value, true);
    r.send();
}

function acceptSeller(sid) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            t = r.responseText;

            if (t == "done") {
                location.reload();
            }
        }
    }

    r.open("GET", "acceptSeller.php?id=" + sid, true);
    r.send();
}

function rejectSeller(sid) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            t = r.responseText;
            if (t == "done") {
                location.reload();
            }
        }
    }

    r.open("GET", "rejectSeller.php?id=" + sid, true);
    r.send();
}

function blockSeller(sid) {


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            t = r.responseText;
            if (t == "done") {

                location.reload();
            }
        }
    }

    r.open("GET", "blockSeller.php?id=" + sid, true);
    r.send();
}

function unBlockSeller(sid) {


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            t = r.responseText;
            if (t == "done") {

                location.reload();
            }
        }
    }

    r.open("GET", "unBlockSeller.php?id=" + sid, true);
    r.send();
}

function confirmOder() {
    var pid = document.getElementById("p_id").value;
    var oid = document.getElementById("o_id").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "done") {

                var orderConfirmModal = document.getElementById("orderconfirm");
                var modal = new bootstrap.Modal(orderConfirmModal);

                // Add an event listener to the modal's "hidden.bs.modal" event
                orderConfirmModal.addEventListener('hidden.bs.modal', function () {
                    location.reload();
                });

                modal.show();
            }
        }
    }

    r.open("GET", "oderConfirmProcess.php?pid=" + pid + "&oid=" + oid, true);
    r.send();


}

function removedfromHistory() {
    var pid = document.getElementById("p_id").value;
    var oid = document.getElementById("o_id").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "done") {

                var orderConfirmModal = document.getElementById("orderconfirm");
                var modal = new bootstrap.Modal(orderConfirmModal);

                // Add an event listener to the modal's "hidden.bs.modal" event
                orderConfirmModal.addEventListener('hidden.bs.modal', function () {
                    location.reload();
                });

                modal.show();
            }
        }
    }

    r.open("GET", "removedHistoryProcess.php?pid=" + pid + "&oid=" + oid, true);
    r.send();


}

function saveFeedback() {
    var fb = document.getElementById("fb");
    var pid = document.getElementById("p_id");
    var oid = document.getElementById("o_id");
    var uid = document.getElementById("u_id");

    var f = new FormData();
    f.append("fb", fb.value);
    f.append("pid", pid.value);
    f.append("oid", oid.value);
    f.append("uid", uid.value);

    var r = new XMLHttpRequest();

    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);

}

function sellerConfirm() {

    var pid = document.getElementById("p_id").value;
    var oid = document.getElementById("o_id").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "done") {

                var orderConfirmModal = document.getElementById("orderconfirm");
                var modal = new bootstrap.Modal(orderConfirmModal);

                
                orderConfirmModal.addEventListener('hidden.bs.modal', function () {
                    location.reload();
                });

                modal.show();
            }
        }
    }

    r.open("GET", "sellerConfirmProcess.php?pid=" + pid + "&oid=" + oid, true);
    r.send();


}

function changeProductStates(pid) {

    var checkbox = document.getElementById("productStates_" + pid);
    var isChecked = checkbox.checked ? 1 : 0;
    var f = new FormData();

    f.append("pid", pid);
    f.append("state", isChecked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            alert(r.responseText);
        }
    }

    r.open("POST", "productStateChangeProcess.php", true);
    r.send(f);

}

function userstatusChange(email,status){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            window.location.reload();
        }
    }

    r.open("GET","userStateProcess.php?em="+email+"&status="+status,true);
    r.send();

}