<div>
    <div class="contact-form-wrapper">
        @if(session()->has('success'))
            <div class="alert alert-success"
                style="padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6;">
                {{ session('success') }}
            </div>
        @endif
        <form class="contact-form" wire:submit.prevent="submit" novalidate>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" wire:model.defer="name" placeholder="Ajay">
                @error('name') <span class="error" style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" wire:model.defer="email" placeholder="Ajay@gmail.com">
                @error('email') <span class="error" style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" wire:model.defer="phone" placeholder="+91 00000000">
                @error('phone') <span class="error" style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" wire:model.defer="message" rows="4"
                    placeholder="Tell us about your requirements..."></textarea>
                @error('message') <span class="error" style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit">Send Message</span>
                <span wire:loading wire:target="submit">Sending...</span>
            </button>
        </form>
    </div>
</div>