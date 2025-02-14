<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailAccount;
use App\Services\DigitalOceanDnsService;
use Illuminate\Support\Facades\Hash;
use DirectoryTree\ImapEngine\Mailbox;
use App\Services\EmailAccountService;

class EmailAccountController extends Controller
{
    protected $dnsService;

    public function __construct(DigitalOceanDnsService $dnsService)
    {
        $this->dnsService = $dnsService;
    }

    public function createEmail(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|unique:email_accounts,email',
            'password' => 'required|min:8',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Save email in database
        EmailAccount::create([
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        // Create Email in Postfix/Dovecot
        $this->createEmailOnServer($email, $password);

        // Configure DNS via DigitalOcean API
        $domain = substr(strrchr($email, "@"), 1);
        $this->dnsService->setupEmailDns($domain);

        session()->flash('success', 'Email created.');

        // return response()->json(['message' => 'Email created successfully']);
        return redirect()->route('dashboard');
    }

    private function createEmailOnServer($email, $password)
    {
        shell_exec("sudo /usr/local/bin/add-email.sh '$email' '$password'");
    }

    public function fetchEmails($email)
    {
        $mailbox = new Mailbox([
            'host'     => config('imapengine.host'),
            'port'     => config('imapengine.port'),
            'username' => $email,
            'password' => EmailAccount::where('email', $email)->first()->password,
        ]);

        return response()->json($mailbox->emails());
    }

    public function dashboard()
    {
        $emails = EmailAccountService::all();

        return view('dashboard', compact('emails'));
    }
}
