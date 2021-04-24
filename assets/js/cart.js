function allArticlesInCart() {
    return JSON.parse(localStorage.getItem("articles"))
}

if (!allArticlesInCart()) {
    localStorage.setItem("articles", JSON.stringify([]))
    $("#btn-buy").hide()
}

$(document).on("click", ".add-to-cart-btn", function () {
    alert("You successfully added article to your cart.")

    let id = $(this).data("id")
    let articles = allArticlesInCart()

    if (articles.filter(a => a.id == id).length) {
        for (let article of articles) {
            if (article.id == id) {
                article.quantity++
                break
            }
        }
        localStorage.setItem("articles", JSON.stringify(articles))
    } else {
        articles.push({
            id: id,
            quantity: 1
        })
        localStorage.setItem("articles", JSON.stringify(articles))
    }
})

if (window.location.href == url + "index.php?page=cart" || window.location.href == url + "index.php?page=cart#") {
    fillCart()
    function fillCart() {
        let articles = allArticlesInCart()

        $.ajax({
            url: "models/articles/get_all_articles.php",
            method: "POST",
            dataType: "json",
            success: function (data) {
                data = data.filter(a => {
                    for (let article of articles) {
                        if (article.id == a.article_id) {
                            a.quantity = article.quantity
                            return true
                        }
                    }
                    return false
                })
                makeTable(data)
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status + status)
            }
        })
    }

    function makeTable(data) {
        let num = 1
        let html = `
    <table class='table table-bordered table-hover table-striped'>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Article Name</th>
                <th>Article</th>
                <th>Base Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>`
        for (let i of data) {
            html += `<tr>
                    <td>${num++}</td>
                    <td>${i.article_name}</td>
                    <td><img src='${i.new_image}' alt='${i.alt}' /></td>
                    <td>${i.price}&euro;</td>
                    <td>${i.quantity}</td>
                    <td>${Number(i.price) * Number(i.quantity)}&euro;</td>
                    <td>
                        <a href='#' class='btn btn-danger delete-cart-item'  data-id='${i.article_id}'>Delete</a>
                    </td>
                </tr>`
        }
        html += `</tbody>
    </table>`
        $("#cart").html(html)
    }

    $("#cart").on("click", ".delete-cart-item", function () {
        let articles = allArticlesInCart()
        let id = $(this).data("id")
        let remaining_articles = articles.filter(a => a.id != id)
        localStorage.setItem("articles", JSON.stringify(remaining_articles))
        fillCart()
    })

    $("#btn-buy").click(function () {
        let user_id = $(this).data("id")

        if (allArticlesInCart().length) {
            $.ajax({
                url: "models/orders/order.php",
                method: "POST",
                dataType: "json",
                data: {
                    obj: allArticlesInCart(),
                    user_id: user_id,
                    send: true
                },
                success: function () {
                    alert("Your purchase is successfully done.")
                    localStorage.setItem("articles", JSON.stringify([]))
                    fillCart()
                },
                error: function (xhr, status, statusTxt) {
                    console.log(xhr.status)
                    console.log(xhr.responseText)
                }
            })
        } else {
            alert("Sorry, can't complete purchase.")
        }
    })
}