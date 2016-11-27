var result = false;

$(function() {
    var url = $('#data-url').val();
    var hash = $('#data-hash').val();
    getResult();

    function getResult() {
        console.log("sending ajax request");
        var params = {
            hash: hash
        };
        $.get(url, params, handleResult);
    }

    function handleResult(data) {
        console.log("received ajax response");
        console.log(data);
        if (data.waiting) {
            setTimeout(getResult, 3500, url);
        } else {
            $("#mp-name").text(data.mp.name);
            $("#wait").hide();
            $("#result").show();
        }
    }
});
