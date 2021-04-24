if (window.location.href == url + "index.php?page=orders" || window.location.href == url + "index.php?page=orders#") {
    $(document).ready(function () {
        printOrders()
    })

    function printOrders() {
        $.ajax({
            url: "models/orders/get_all_orders.php",
            method: "POST",
            dataType: "json",
            success: function (data) {
                $("#order-table").html(makeOrderTable(data))
                $(".details-order").click(orderDetails)
                $(".delete-order").click(deleteOrder)
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
                console.log(xhr.responseText)
            }
        })
    }

    function makeOrderTable(data) {
        let num = 1
        let print = `
    <table class='table table-hover table-bordered table-striped'>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Name</th>
                <th>Order Date</th>
                <th>Setup</th>
            </tr>
        </thead>
        <tbody>`
        for (let i of data) {
            print += `
            <tr>
                <td>${num++}</td>
                <td>${i.first_name + " " + i.last_name}</td>
                <td>${i.purchase_date}</td>
                <td>
                    <a href='#' data-id='${i.purchase_id}' class='btn btn-danger delete-order'>Delete</a>
                    <a href='#' data-id='${i.purchase_id}' class='btn btn-primary details-order'>More Details</a>
                </td>
            </tr>`
        }
        print += `</tbody>
    </table>`
        return print
    }

    function orderDetails(e) {
        e.preventDefault()

        let id = $(this).data("id")

        $.ajax({
            url: "models/orders/order_details.php",
            method: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function (data) {
                console.log(data)
                $("#order-table").hide()
                $("#order-details").html(makeOrderDetailsTable(data))
                $("#order-details").slideDown("slow")
                $("#hide-details").click(function () {
                    $("#order-details").slideUp("slow")
                    $("#order-table").show("slow")
                })
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
                console.log(xhr.responseText)
            }
        })
    }

    function makeOrderDetailsTable(data) {
        let print = `
    <table class='table table-hover table-bordered table-striped'>
        <tr>
            <td colspan="3">
                ${data[0].first_name}
                ${data[0].last_name}
                ${data[0].purchase_date}
            </td>
        </tr>
        <tr>
            <td colspan="2">Article</td>
            <td>Quantity</td>
        </tr>`
        for (let i of data) {
            print += `
            <tr>
                <td>${i.article_name}</td>
                <td><img src="${i.original_image}" alt="${i.alt}" width=100 height=100/></td>
                <td>${i.quantity}</td>
            </tr>`
        }
        print += `
    </table>
    <button type="button" class="btn btn-warning" id="hide-details">Hide</button>
    `
        return print
    }

    function deleteOrder() {
        let id = $(this).data("id")

        $.ajax({
            url: "models/orders/delete_order.php",
            method: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function (data) {
                printOrders()
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
            }
        })
    }
}
