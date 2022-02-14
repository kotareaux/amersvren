@if (session('toastr'))
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
        $(function () {
            toastr.options = {
	            "positionClass": "toast-top-left",
	            }
            toastr.{{session('toastr')["type"]}}('{{session('toastr')["text"]}}', '{{session('toastr')["titl"] ?? null}}');
        });
</script>
@endif
