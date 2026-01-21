<div>
    <h4 class="mb-2">Adventure starts here 🚀</h4>
    <p class="mb-4">Make your app management easy and fun!</p>

    <form wire:submit="register">
        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" id="name"
                placeholder="Enter your name" autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email"
                placeholder="Enter your email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Password</label>
            <div class="input-group input-group-merge">
                <input type="password" wire:model="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                <span class="input-group-text cursor-pointer">
                    <i class="bx bx-hide"></i>
                </span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <div class="input-group input-group-merge">
                <input type="password" wire:model="password_confirmation" id="password_confirmation"
                    class="form-control"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                <span class="input-group-text cursor-pointer">
                    <i class="bx bx-hide"></i>
                </span>
            </div>
        </div>

        <!-- Terms & Privacy -->
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" wire:model="terms"
                    id="terms-conditions">
                <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="javascript:void(0);">privacy policy & terms</a>
                </label>
            </div>
            @error('terms')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button class="btn btn-primary d-grid w-100" type="submit" wire:loading.attr="disabled">
            <span wire:loading.remove>Sign up</span>
            <span wire:loading>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Creating account...
            </span>
        </button>
    </form>

    <p class="text-center mt-4">
        <span>Already have an account?</span>
        <a href="{{ route('login') }}" wire:navigate>
            <span>Sign in instead</span>
        </a>
    </p>
</div>