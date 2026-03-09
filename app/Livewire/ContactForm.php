<?php

namespace App\Livewire;

use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;

    public $email;

    public $phone;

    public $message;

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required|min:10',
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter your full name.',
        'name.min' => 'Your name must be at least 3 characters long.',
        'email.required' => 'We need your email address to contact you.',
        'email.email' => 'Please enter a valid email address.',
        'phone.required' => 'Please enter your phone number.',
        'phone.regex' => 'Please enter a valid phone number.',
        'phone.min' => 'Your phone number must be at least 10 characters long.',
        'message.required' => 'Please enter your message.',
        'message.min' => 'Your message must be at least 10 characters long.',
    ];

    public function submit()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ];

        Mail::to('deliveryvaale@gmail.com')->send(new ContactMessageMail($data));

        $this->reset();

        session()->flash('success', 'Message sent successfully. We will get back to you shortly.');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
