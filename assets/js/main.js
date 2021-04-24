const url = "http://localhost/Gentleman(copy)/"
if (window.location.href == url + "index.php?page=articles" || window.location.href == url + "index.php?page=articles#") {
    $(document).ready(function () {
        populateArticles()
        showPagination(0)
    })

    function populateArticles() {
        $.ajax({
            url: "models/articles/get_articles_pagination.php",
            method: "POST",
            dataType: "json",
            data: {
                id: 1,
                category_id: 0
            },
            success: function (data) {
                printArticles(data)
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
                console.log(xhr)
                console.log(status)
                console.log(statusTxt)
                console.log(xhr.responseText)
            }
        })
    }

    function printArticles(articles) {
        let print = ""
        for (let article of articles) {
            print += printArticle(article)
        }
        $("#all-articles").html(print)
        $("#pagination").show()
    }

    function printArticle(article) {
        return `
            <div class="col-xs-12 col-sm-4 one-article mb-4">
                <img src="${article.original_image}" alt="${article.alt}" class="img-fluid d-block mx-auto" />
                <div class="overlay">
                    <a href="index.php?page=article&id=${article.article_id}" data-id="${article.article_id}" class="btn btn-outline-light p-3">Buy Now</a>
                </div>
                <div class="text-center">
                    <p>${article.article_name}</p>
                    <p>${article.price} &euro;</p>
                    <p>${article.description}</p>
                </div>
            </div>
    `
    }

    function showPagination(id) {
        $.ajax({
            url: "models/articles/pagination.php",
            method: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function (data) {
                let print = ``
                let num = data.articlesCount
                let numLinks = Math.ceil(num / 6)
                for (let i = 1; i <= numLinks; i++) {
                    if (i == 1) {
                        print += `<li class='active'><a href="javascript:void(0)" class="pagination-link" data-id="${i}">${i}</a></li>`
                    } else {
                        print += `<li><a href="javascript:void(0)" class="pagination-link" data-id="${i}">${i}</a></li>`
                    }
                }
                $("#pagination-list").html(print)
            },
            error: function (xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(xhr.responseText)
            }
        });
    }

    $("#pagination").on("click", ".pagination-link", function () {
        let id = $(this).data("id")
        let category_id = $("#ddlCategory").val()
        let sort_id = $("#ddlSort").val()

        $("#pagination-list .active").removeAttr("class")
        $(this).parent().attr("class", "active")

        $.ajax({
            url: "models/articles/filter_sort.php",
            method: "POST",
            dataType: "json",
            data: {
                pagination_id: id,
                category_id: category_id,
                sort_id: sort_id,
                send: true
            },
            success: function (data) {
                printArticles(data)
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr)
            }
        })
    })

    $("#ddlCategory").change(function () {
        let category_id = $(this).val()
        $("#ddlSort").val(0)
        showPagination(category_id)

        $.ajax({
            url: "models/articles/filter_sort.php",
            method: "POST",
            dataType: "json",
            data: {
                pagination_id: 1,
                category_id: category_id,
                sort_id: 0,
                send: true
            },
            success: function (data) {
                printArticles(data)
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr)
            }
        })
    })

    $("#ddlSort").change(function () {
        let sort_id = $(this).val()
        let category_id = $("#ddlCategory").val()
        showPagination(category_id)

        $.ajax({
            url: "models/articles/filter_sort.php",
            method: "POST",
            dataType: "json",
            data: {
                pagination_id: 1,
                category_id: category_id,
                sort_id: sort_id,
                send: true
            },
            success: function (data) {
                printArticles(data)
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr)
            }
        })
    })


    $("#search-articles").keyup(function () {
        let value_string = $(this).val()

        if (value_string != "") {
            $.ajax({
                url: "models/articles/search.php",
                method: "POST",
                dataType: "json",
                data: {
                    value_string: value_string,
                    send: true
                },
                success: function (data) {
                    printArticles(data)
                    $("#pagination").hide()
                },
                error: function (xhr, status, error) {
                    console.log(xhr)
                }
            })
        }
    })
}