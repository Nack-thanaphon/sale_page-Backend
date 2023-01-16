

$(".delete").attr("onclick", "").unbind("click"); //remove function onclick button

$(document).on('click', '.delete', function () {
    let delete_form = $(this).parent().find('form');


    Swal.fire({
        title: 'คุณแน่ใจใช่ไหม?',
        text: "คุณต้องการลบข้อมูลนี้ใช่ไหม!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            delete_form.submit()
            Swal.fire(
                'เรียบร้อย!',
                'ข้อมูลของคุณถูกลบเรียบร้อย.',
                'success'
            )

        }
    })
});

var singleimagesPreview = function (input) {

    if (input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (event) {
            $('#singleimages').attr('src', event.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }

};

//  $(document).ready(function() {

$('#example').DataTable({
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 4, targets: -1 }
    ],
    responsive: true,
    stateSave: true,
    language: {
        "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
        "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
        "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
        "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
        "infoFiltered": "(ค้นหาจาก _MAX_ ทั้งหมด รายการ)",
        "search": 'ค้นหา',
        "paginate": {
            "previous": "ก่อนหน้านี้",
            "next": "หน้าต่อไป"
        }
    }
})

var Payment_Preview = function (input) {

    if (input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (event) {
            $('#payment_show').attr('src', event.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }

};



var multiimagesPreview = function (input, placeToInsertImagePreview) {

    if (input.files) {
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function (event) {
                $($.parseHTML('<img class="col-4 p-1 ">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
            }
            reader.readAsDataURL(input.files[i]);
        }
    }

};

var cart_list = JSON.parse(localStorage.getItem("cart_list")) || []
cart()
precal()
var count = 0;


function select_product(id, name, img, price) {
    var item = cart_list.find(item => item.id === id);

    if (item) {
        item.count++;
    } else {
        cart_list.push({
            id,
            img,
            name,
            price,
            count: 1
        })
    }
    localStorage.setItem('cart_list', JSON.stringify(cart_list));
    cart();
    precal()
}


function cart() {
    var productCart_list = ''
    if (cart_list.length > 0) {
        for (i = 0; i < cart_list.length; i++) {
            if (cart_list[i].count > 0) {
                productCart_list +=
                    `<div class="d-flex justify-content-between mb-1 py-1 " id="productItem${cart_list[i].id}">
                    <div>
                        <h6 class="text-success">${cart_list[i].name}</h6>
                        <small id="countitems${i}">จำนวน : ${cart_list[i].count} ชิ้น</small>
                    </div>
                    <div>
                        <i class="fas fa-trash-alt" onclick="delete_product(${cart_list[i].id})"></i>
                    </div>
                </div>
            </div> `
            }
            $("#product_cart").html(productCart_list)
            $("#cart_total").html(cart_list.length)
        }
        $("#gotopayment").attr('disabled', false)
    }
    if (cart_list.length <= 0) {

        $("#gotopayment").attr('disabled', true)
        $("#product_cart").html('ไม่มีสินค้า')
    }
}

function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}

function precal() {
    var precal_sum = 0
    var html = '';
    cart_list.forEach((data) => {
        if (data.count > 0) {
            precal_sum += data.price * data.count
            html +=
                `<tr id="precal${data.id}">
                <td colspan="4">- ${data.name}</td>
                <td class="text-right">${data.count}</td>
            </tr>`
            $('#tbody_precal').html(html)
            $('#precal_sum').html(numberWithCommas((precal_sum).toFixed(2)) + ' บาท')
            $('#price').val(precal_sum)
        }
        if (data.count <= 0) {
            $("#precal" + data.id).remove();
            $('#precal_sum').html(numberWithCommas((precal_sum).toFixed(2)))
            $('#price').val(precal_sum)
        }
    })
}
//ลบสินค้า
function delete_product(id) {


    var item = cart_list.find(item => item.id === id);

    if (item) {
        item.count--;
    }
    if (item.count == 0) {
        // cart_list.removeItem(item);
        for (i = 0; i < cart_list.length; i++) {
            // console.log(cart_list[2].id)
            console.log(id, cart_list[i].id)
            if (id == cart_list[i].id) {
                console.log('i >>> ', i, 1)
                cart_list.splice(i, 1)
                console.log(cart_list)

            }
        }

    }

    localStorage.setItem('cart_list', JSON.stringify(cart_list));

    // count--

    // if (cart_list[i].count > 0) {
    //     cart_list[i].count--;
    //     localStorage.setItem("cart_list", cart_list[i].count);
    //     $("#countitems" + i).text(`จำนวน : ${cart_list[i].count} ชิ้น`)
    // }
    // if (cart_list[i].count <= 0) {
    //     $("#productItem" + id).remove();
    // }
    cart()
    precal()
}