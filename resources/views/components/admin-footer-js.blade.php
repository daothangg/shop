



    <script src="{{ asset('assets//js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
    
	<script src="{{ asset('assets//js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets//plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets//plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets//plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset('assets//plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets//plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<script src="{{ asset('assets//plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="https://developercodez.com/developerCorner/parsley/parsley.min.js"></script>
    <script src="{{ asset('snackbar//dist/js-snackbar.js') }}"></script>
	<script src="{{ asset('assets//plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('multiSelect/jquery.multi-select.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('multiSelect/jquery.muilti-select.js')}}"></script>
    {{-- <script src="{{ asset('multiSelect/jquery-2.2.4.min.js') }}"></script> --}}

  

	<script src="{{ asset('assets//js/index.js') }}"></script>
	<!--app JS-->
	<script src="{{ asset('assets//js/app.js') }}"></script>


   
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>

<script>
    function showAlter(status, message) {
        SnackBar({
            status: status, // Show the Snackbar based on result type
            message: message,
            position: "br" // Bottom right position for Snackbar
        });

    }
</script>
<script>
    function deleteData(id, table) {
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/deleteData') }}/" + id + "/" + table,
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                if (result.status === 'success') {
                    showAlter(result.status, result.message);

                    // Reload the page if instructed in the result data


                } else {
                    showAlter(result.status, result.message);
                    window.location.reload();
                }
            },
            error: function(xhr) {
                // Ensure the error response is handled correctly
                var response = xhr.responseJSON ? xhr.responseJSON : {
                    status: 'error',
                    message: 'An unexpected error occurred.'
                };

                showAlter(response.status, response.message);
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('#formSubmit').on('submit', function(e) {
            e.preventDefault(); // Always prevent default form submission

            if ($(this).parsley().validate()) { // Validate form using Parsley
                var formData = new FormData(this);
                var loadingButton =
                    '<button class="btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>';
                var submitButton =
                    '<input type="submit" id="submitButton" class="btn btn-primary px-4" value="Submit"/>';

                // Replace submit button with loading button to prevent multiple submissions
                $('#submitButton').replaceWith(loadingButton);

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        // Check for the status and show appropriate message
                        if (result.status === 'success') {
                            showAlter(result.status, result.message);
                            // Optionally reload the page after a delay
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000); // Adjust the delay as needed
                        } else {
                            showAlter(result.status, result.message);
                            setTimeout(function() { window.location.reload(); }, 1000);
                        }
                    },
                    error: function(xhr) {
                        // Handle error response
                        var errorMessage = xhr.responseJSON?.message || 'An error occurred. Please try again.';
                        showAlter('error', errorMessage);
                    },
                    complete: function() {
                        // Reset to original submit button
                        $('#formSubmit').find('.btn').remove(); // Remove loading button
                        $('#multiAttr').html(submitButton); // Restore original submit button
                    }
                });
            }
        });
    });
</script>
{{-- <script>
    $(document).ready(function() {
        $('#attribute_idd').multiSelect();
    })

        </script> --}}

