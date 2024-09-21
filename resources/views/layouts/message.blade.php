<div class="error">
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                html: `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonText: 'Close'
            });
        </script>
    @endif
</div>

<div class="success">
    @if (session('success') != null)
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
</div>
{{-- <div class="error">
    @if ($errors->any)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger p-1 my-1">{{ $error }}</div>
        @endforeach

    @endif
</div>
<div class="success">
    @if (session('success') != null)
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
</div>
<div class="success">
    @if (session('success') != null)
        <div class="alert alert-success p-1 my-1">{{ session('success') }}</div>
    @endif
</div> --}}
