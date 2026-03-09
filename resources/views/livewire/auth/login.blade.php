<div>
    <h4 class="mb-2">Welcome! 👋</h4>
    <p class="mb-4">Please sign-in to your account and start the adventure</p>

    <form wire:submit="login">
        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email"
                placeholder="Enter your email" autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" wire:model="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer">
                    <!-- <i class="bx bx-hide"></i> -->
                </span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model="remember" id="remember-me">
                <label class="form-check-label" for="remember-me">
                    Remember Me
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Sign in</span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Signing in...
                </span>
            </button>
        </div>
    </form>

    <div class="mt-4 text-center">
        <p class="mb-2 text-muted">Get our mobile app for the best experience</p>
        <a href="{{ asset('apk/delivery-wale.apk') }}"
            class="btn btn-outline-primary d-inline-flex align-items-center gap-2" download>
            <i class="bx bxl-android fs-4"></i>
            Download APK
        </a>
    </div>
</div>