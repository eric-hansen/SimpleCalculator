/**
 * @author Eric Hansen
 **/
function setOperatorStatus(disabled)
{
    $('.op').each(function(index, obj){
        $(obj).prop('disabled', disabled);
    });
}

$(document).ready(function() {
    $(".number").click(function (event) {
        event.preventDefault();

        for (var i = 1; i < 3; i++)
        {
            var numSelector = $('#num' + i);

            if (numSelector.val() == '')
            {
                numSelector.val($(this).val());
                break;
            }
        }
    });

    $(".op").click(function (event) {
        // We really don't want to do anything if we can't distinguish the operation chosen
        switch ($(this).val())
        {
            case '*':
            case '-':
            case '/':
            case '+':
                $("#opSign").text($(this).val());

                setOperatorStatus(true);

                break;
        }
    });

    $('#calculate').click(function(event){
        event.preventDefault();

        // URLs can't have certain characters (i.e.: /) for what we need to do so we use a map
        var opLookup = {'+' : '+', '-' : '-', '*' : 'x', '/' : 'd'};

        var num1 = $('#num1').val();
        var num2 = $('#num2').val();
        var op   = opLookup[$('#opSign').text().trim()];

        if (num1 == '' || num2 == '' || op == '')
        {
            console.log(num1 + ' ' + op + ' ' + num2);
            alert('Missing one (or both) of the numbers and/or the operator.');
            return;
        }

        $.get(
            '/calc/' + num1 + '/' + op + '/' + num2,
            function (result)
            {
                $("#answer").text(result);

                setOperatorStatus(false);
            }
        );
    });

    $("#clearValues").click(function(event){
        event.preventDefault();

        setOperatorStatus(false);

        $("#num1").val("");
        $("#opSign").text("");
        $("#num2").val("");
        $("#answer").text("");
    })
});