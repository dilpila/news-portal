<script>

    function statusCode(status_code) {
        if (status_code == 'Paid') {
            $('.payment_method').html(' <div class="form-group col-lg-4 payment_form">\n' +
                '                    <label for="payment_method">Payment Method</label>\n' +
                '                    <select name="payment_method"  class="form-control">\n' +
                '                        <option value="cash" selected>Cash</option>\n' +
                '                        <option value="cheque">Cheque</option>\n' +
                '                    </select>\n' +
                '                </div><div class="form-group col-lg-4 payment_form">\n' +
                '                    <label for="account_id">Account Id</label>\n' +
                '                    <input type="number" class="account_id form-control" name="account_id" id="account_id" placeholder="Enter Account Id">\n' +
                '                </div>')
            $(".account_id").attr("required", "true");
        } else {
            $('.payment_form').remove();
            $(".account_id").attr("required", "false");
        }
    }
</script>