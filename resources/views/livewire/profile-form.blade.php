@extends('components.layouts.navbar')

@section('content')

@livewire('user.modal.profile-show')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Livewire.on('invalid-password', () => {
        Swal.fire({
            icon: 'error',
            title: 'Update failed!',
            text: 'Invalid password',
            confirmButtonColor: '#4A2E0F',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
        }).then(() => {
            window.location.href = "{{ route('homepage') }}";
        });
    });

    Livewire.on('profile-update-success', () => {
        Swal.fire({
            icon: 'success',
            title: 'Update successful!',
            text: 'Your profile has been updated successfully.',
            confirmButtonColor: '#4A2E0F',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
        }).then(() => {
            window.location.href = "{{ route('homepage') }}";
        });
    });
</script>
@endpush

@endsection