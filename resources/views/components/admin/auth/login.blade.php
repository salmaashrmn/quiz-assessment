<div class="login-page">
    <div class="login-card">

        <div class="login-header">
            <h1>Quiz CMS</h1>
            <p>Sign in to your admin account</p>
        </div>

        <form wire:submit="login">

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    placeholder="Enter your email"
                    autocomplete="email"
                    autofocus
                >

                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                >

                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="remember-me">
                <label>
                    <input
                        type="checkbox"
                        wire:model="remember"
                    >

                    <span>Remember me</span>
                </label>
            </div>

            <button
                type="submit"
                class="login-button"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Sign In</span>
                <span wire:loading>Signing in...</span>
            </button>

        </form>

    </div>
</div>