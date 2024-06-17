<!-- resources/views/auth/reset-password.blade.php -->
<x-guest-layout>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <!-- Password -->
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div>
            <button type="submit">Reset Password</button>
        </div>
    </form>
</x-guest-layout>
