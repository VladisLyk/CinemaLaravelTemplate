$(".genre-add").click(function (e) {
    e.preventDefault();

    location.href = "/genres/add"
});
$(".film-add").click(function (e) {
    e.preventDefault();

    location.href = "/films/add"
});

$("input[name='search']").keyup(function (e) { 
    var input_val = $("input[name='search']").val();

    if(input_val.length == 0) {
        location.href = "/";
    } else {
        $.ajax({
            type: "GET",
            url: "/films/find/" + input_val,
            success: function (response) {
                $('.films').html(response);
            }
        });
    }
});
