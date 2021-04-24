if (window.location.href == url + "index.php?page=admin_articles" || window.location.href == url + "index.php?page=admin_articles#") {
    $(document).ready(function () {
        printArticlesTable()
    })

    function printArticlesTable() {
        $.ajax({
            url: "models/articles/get_all_articles.php",
            method: "POST",
            dataType: "json",
            success: function (data) {
                makeArticlesTable(data)
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
                console.log(xhr)
            }
        })
    }

    function makeArticlesTable(articles) {
        let html = ""
        let num = 1
        html = `
    <table class="table table-striped table-bordered table-hover">
            <thead>
                <th>Order <br/>Number</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Date Posted</th>
                <th>Setup</th>
            </thead>
            <tbody>`
        for (let article of articles) {
            html += ` <tr>
                    <td>${num++}</td>
                    <td>${article.article_name}</td>
                    <td>${article.price}&euro;</td>
                    <td><img src="${article.new_image}" alt="${article.alt}"/></td>
                    <td>${article.category_name}</td>
                    <td>${article.date_posted}</td>
                    <td>
                        <a href="#" class="btn btn-primary update-article-btn" data-id="${article.article_id}">Update</a>
                        <a href="#" class="btn btn-danger delete-article-btn" data-id="${article.article_id}" data-original_image="${article.original_image}" data-new_image="${article.new_image}">Delete</a>
                    </td>
                </tr>`
        }
        `</tbody>
        </table>`
        $("#articles-table").html(html)
    }

    $(".update-article").hide()

    $(document).on("click", ".update-article-btn", function (e) {
        e.preventDefault()
        let id = $(this).data("id")

        $(".update-article").show(800)

        $.ajax({
            url: "models/articles/get_article.php",
            method: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function (data) {
                $("#hiddenArticleId").val(data.article_id)
                $("#articleName").val(data.article_name)
                $("#articlePrice").val(data.price)
                $("#originalImage").val(data.original_image)
                $("#newImage").val(data.new_image)
                $("#showImage").attr("src", data.new_image)
                $("#showImage").attr("alt", data.alt)
                $("#articleDescription").val(data.description)
                let date_posted = data.date_posted.split(" ")
                $("#updateDate").val(date_posted[0])
                $("#ddlCategory").val(data.category_id)
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
                console.log(xhr)
                console.log(statusTxt)
                console.log(xhr.responseText)
            }
        })
    })

    $(document).on("click", ".delete-article-btn", function (e) {
        e.preventDefault()

        let id = $(this).data("id")
        let original_image = $(this).data("original_image")
        let new_image = $(this).data("new_image")

        $.ajax({
            url: "models/articles/delete.php",
            method: "POST",
            data: {
                id: id,
                original_image: original_image,
                new_image: new_image
            },
            success: function (xhr, status, data) {
                printArticlesTable()
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
                console.log(xhr)
            }
        })
    })
}