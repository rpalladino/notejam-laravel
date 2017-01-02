@if (session('signup_success'))
    <div class="alert alert-success">
        {{ session('signup_success') }}
    </div>
@endif
