<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Support\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private const THANKS = 'Thank you. Your message has reached me and I will reply to your email soon.';

    public function store(Request $request): RedirectResponse
    {
        // Spam trap: real visitors never see or fill the hidden "website" field.
        if ($request->filled('website')) {
            return $this->done(self::THANKS);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ]);

        // The enquiry is saved first, so it is in your admin panel even if the email below fails.
        Enquiry::create($data + [
            'status' => 'new',
            'ip_address' => $request->ip(),
        ]);

        $this->notifyOwner($data);

        return $this->done(self::THANKS);
    }

    private function done(string $message): RedirectResponse
    {
        return redirect()->to(route('home') . '#contact')->with('contact_success', $message);
    }

    /** Sends you an email about the new enquiry. A mail problem never breaks the visitor's form. */
    private function notifyOwner(array $data): void
    {
        $to = Site::setting('notify_email') ?: Site::profile()->email;

        if (! $to) {
            return;
        }

        $body = "New enquiry from your portfolio website\n\n"
            . "Name: {$data['name']}\n"
            . "Email: {$data['email']}\n"
            . "Subject: {$data['subject']}\n\n"
            . $data['message'] . "\n\n"
            . 'Open it in your admin panel: ' . route('admin.enquiries.index');

        try {
            Mail::raw($body, function ($mail) use ($to, $data) {
                $mail->to($to)
                    ->replyTo($data['email'], $data['name'])
                    ->subject('New portfolio enquiry: ' . $data['subject']);
            });
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
