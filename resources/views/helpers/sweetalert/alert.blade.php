@if (Session::has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            iconColor: 'white',
            color: '#fff',
            timerProgressBar: true,
            background: '#a5dc86',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        })
    </script>
@endif

@if (Session::has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            iconColor: 'white',
            color: '#fff',
            background: '#f27474',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}'
        })
    </script>
@endif

@if (Session::has('update'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            iconColor: 'white',
            color: '#fff',
            background: '#3fc3ee',

            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'info',
            title: '{{ session('update') }}'
        })
    </script>
@endif

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("con_pass").value;

        if (password != confirm_password) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                iconColor: 'white',
                color: '#fff',
                timerProgressBar: true,
                background: '#a5dc86',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'warning',
                title: 'Password Confirm tidak sama'
            })
            return false;
        }

        return true;
    }
</script>

@if (Session::has('status'))
    <script>
        Swal.fire({
            title: "{{ session('status') }}",
            showClass: {
                popup: `
      animate__animated
      animate__fadeInUp
      animate__faster
    `
            },
            hideClass: {
                popup: `
      animate__animated
      animate__fadeOutDown
      animate__faster
    `
            }
        });
    </script>
@endif

@if (Session::has('pasif'))
    <script>
        Swal.fire({
            title: "Warning",
            text: "{{ session('pasif') }}",
            icon: "Warning",
            confirmButtonText: "Yes"
        })
    </script>
@endif
{{-- @if (Session::has('logFirst'))
    <script>
        const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		iconColor: 'white',
		color: '#fff',
		background: '#f8bb86',

		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
		})

		Toast.fire({
		icon: 'warning',
		title: '{{ session("logFirst") }}'
		})
    </script>
@endif --}}
