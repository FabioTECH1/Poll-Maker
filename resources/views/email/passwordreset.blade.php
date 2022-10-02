<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 text-center my-2">
        <h4>Hi {{ $user->email }}</h4>
        <p>Clcik <a href="{{ route('resetLink', $user->passwordreset->token) }}" style="text-decoration:none">here</a>
            or copy the link below to
            your browser to reset your password</p>
        <br>
        <a style="text-decoration:none"
            href="{{ route('resetLink', $user->passwordreset->token) }}">{{ route('resetLink', $user->passwordreset->token) }}</a>
        <div class="col-sm-4"></div>
    </div>
</div>
