$(document).ready(function() {
    actualizar_carrito();
});

function actualizar_carrito() {
    let base_url = $("#base_url").val();
    $.ajax({
        type: 'POST',
        url: base_url + "/inicio/actualizar_carrito",
        dataType: 'json',
        async: false,
        success: function(datax) {
            $("#cart__total").text(datax.cantidad);
        }
    });
}
$(function() {
    $(document).on('hidden.bs.modal', function(e) {
        var target = $(e.target);
        target.removeData('bs.modal').find(".modal-content").html('');
    });
    $(document).on("click", "#btnCambiar", function() {
        let oldpass = $("#oldpass").val();
        let newpass = $("#newpass").val();
        cambiar_pass(oldpass, newpass);
    });


});

function cambiar_pass(oldpass, newpass) {
    let base_url = $("#base_url").val();
    $.ajax({
        type: 'POST',
        url: base_url + "/password/cambiar_password",
        data: {
            oldpass: oldpass,
            newpass: newpass,
        },
        dataType: 'json',
        async: false,
        success: function(datax) {
            if (datax.typeinfo == "Success") {
                $('#deleteModal').hide();
                swal({
                    title: "Exito!",
                    text: datax.msg,
                    icon: "success",
                    button: "Ok!",
                });
                setInterval("reload1();", 1500);

            } else {
                swal({
                    title: "Error!",
                    text: datax.msg,
                    icon: "error",
                    button: "Ok!",
                });
            }
        }
    });
}

function reload1() {
    let base_url = $("#base_url").val();
    location.href = base_url + '/inicio';
}

$(".btn_agregar_carrito").click(function() {
    let id_oferta = $(this).attr("id");
    let base_url = $("#base_url").val();
    $.ajax({
        type: 'POST',
        url: base_url + "/inicio/agregar_carrito",
        data: {
            id_oferta: id_oferta,
        },
        dataType: 'json',
        async: false,
        success: function(datax) {
            if (datax.typeinfo == "Success") {
                $("#cart__total").text(datax.cantidad);
                $(".btn_agregar_carrito").each(function() {
                    let id_oferta_cambiar = $(this).attr("id");
                    if (id_oferta_cambiar == id_oferta) {
                        $(".agregar_carrito_hijo", this).html('Listo Para Comprar');
                        $(this).prop('disabled', true);
                        $(this).removeClass("btn_agregar_carrito");
                    }
                });

                swal({
                    title: "Exito!",
                    text: datax.msg,
                    icon: "success",
                    button: "Ok!",
                });

            } else {
                swal({
                    title: "Error!",
                    text: datax.msg,
                    icon: "error",
                    button: "Ok!",
                });
            }
        }
    });
});

/*
=============
Load Category Products
=============
 */
const categoryCenter = document.querySelector(".category__center");

/*
=============
Filtering
=============
 */

const filterBtn = document.querySelectorAll(".filter-btn");
const categoryContainer = document.getElementById("category");

if (categoryContainer) {
    categoryContainer.addEventListener("click", async e => {
        const target = e.target.closest(".section__title");
        if (!target) return;

        const id = target.dataset.id;
        const products = await getProducts();

        if (id) {
            // remove active from buttons
            Array.from(filterBtn).forEach(btn => {
                btn.classList.remove("active");
            });
            target.classList.add("active");

            // Load Products
            let menuCategory = products.filter(product => {
                if (product.category === id) {
                    return product;
                }
            });

            if (id === "All Products") {
                displayProductItems(products);
            } else {
                displayProductItems(menuCategory);
            }
        }
    });
}

/*
=============
Product Details Left
=============
 */
const pic1 = document.getElementById("pic1");
const pic2 = document.getElementById("pic2");
const pic3 = document.getElementById("pic3");
const pic4 = document.getElementById("pic4");
const pic5 = document.getElementById("pic5");
const picContainer = document.querySelector(".product__pictures");
const zoom = document.getElementById("zoom");
const pic = document.getElementById("pic");

// Picture List
const picList = [pic1, pic2, pic3, pic4, pic5];

// Active Picture
let picActive = 1;

["mouseover", "touchstart"].forEach(event => {
    if (picContainer) {
        picContainer.addEventListener(event, e => {
            const target = e.target.closest("img");
            if (!target) return;
            const id = target.id.slice(3);
            let base_url = $("#base_url").val();
            changeImage(base_url + `/assets/images/products/iPhone/iphone${id}.jpeg`, id);
        });
    }
});

// change active image
const changeImage = (imgSrc, n) => {
    // change the main image
    pic.src = imgSrc;
    // change the background-image
    zoom.style.backgroundImage = `url(${imgSrc})`;
    //   remove the border from the previous active side image
    picList[picActive - 1].classList.remove("img-active");
    // add to the active image
    picList[n - 1].classList.add("img-active");
    //   update the active side picture
    picActive = n;
};

/*
=============
Product Details Bottom
=============
 */

const btns = document.querySelectorAll(".detail-btn");
const detail = document.querySelector(".product-detail__bottom");
const contents = document.querySelectorAll(".content");

if (detail) {
    detail.addEventListener("click", e => {
        const target = e.target.closest(".detail-btn");
        if (!target) return;

        const id = target.dataset.id;
        if (id) {
            Array.from(btns).forEach(btn => {
                // remove active from all btn
                btn.classList.remove("active");
                e.target.closest(".detail-btn").classList.add("active");
            });
            // hide other active
            Array.from(contents).forEach(content => {
                content.classList.remove("active");
            });
            const element = document.getElementById(id);
            element.classList.add("active");
        }
    });
}