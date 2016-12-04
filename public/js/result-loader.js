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

            var source = $('#policy-template').html();
            var template = Handlebars.compile(source);

            for (var i = 0; i < data.mp.policies.length; i++) {
                var policy = data.mp.policies[i];

                var context = {
                    policy_name: policy.policy,
                    policy_text: policy.position,
                    agreement_width: policy.agreement_width,
                    disagreement_width: policy.disagreement_width
                };

                $('#policies').append(template(context));
            }
        }
    }
});
