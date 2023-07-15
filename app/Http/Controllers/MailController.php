<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class MailController extends Controller
{
  public function send_invite_mail(Request $request)
  {
    $hash = base64_encode($request->sender_email);
    $paid = $request->is_fee_paid;
    if ($paid == 'on') {
      $url = "https://bnic.io/?hash=$hash&p=100";
    } else {
      $url = "https://bnic.io/?hash=$hash&p=200";
    }
    $mail_body = view('emails.invite', compact('url', 'request'));
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'mail.bnic.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = '_mainaccount@developerpie.com';
    $mail->Password   = 'WTFIS0124WTFIS0124';
    $mail->SMTPSecure = false;  // Turn off SMTP encryption
    $mail->SMTPAutoTLS = false; // Turn off automatic TLS encryption
    $mail->Port       = 587;
    //Recipients
    $mail->setFrom('info@bnic.io', 'info@bnic.io');
    $mail->addAddress($request->reciver_email);
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Invitation to Explore BNIC.io';
    $mail->Body    = $mail_body;
    $mail->send();
    return redirect()->back();
  }

  function send_other_mails(array $data)
  {

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    switch ($data['type']) {
      case 'hey_reciver_document_created':
        $url = $data['url'];
        $mail_body = view('emails.hey_reciver_document_created', compact('url', 'data'));
        $mail->addAddress($data['reciver_email']);
        $mail->setFrom('info@bnic.io', 'info@bnic.io');
        $mail->Subject = 'A Document is created BNIC.io';
        break;

      case 'cert_is_signed':
        $url = $data['url'];
        $mail_body = view('emails.cert_is_signed', compact('url', 'data'));
        $mail->addAddress($data['reciver_email']);
        $mail->setFrom('info@bnic.io', 'info@bnic.io');
        $mail->Subject = 'A Certificate is Signed BNIC.io';
        break;

      case 'event_created':
        $url = $data['url'];
        $mail_body = view('emails.event_created', compact('url', 'data'));
        $mail->addAddress($data['reciver_email']);
        $mail->setFrom('info@bnic.io', 'info@bnic.io');
        $mail->Subject = 'You are invited to an event';
        break;

      case 'voting_created':
        $url = $data['url'];
        $mail_body = view('emails.voting_created', compact('url', 'data'));
        $mail->addAddress($data['reciver_email']);
        $mail->setFrom('info@bnic.io', 'info@bnic.io');
        $mail->Subject = 'You are invited to an voting';
        break;
    }



    $mail->isSMTP();
    $mail->Host       = 'mail.bnic.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = '_mainaccount@developerpie.com';
    $mail->Password   = 'WTFIS0124WTFIS0124';
    $mail->SMTPSecure = false;  // Turn off SMTP encryption
    $mail->SMTPAutoTLS = false; // Turn off automatic TLS encryption
    $mail->Port       = 587;
    $mail->isHTML(true);
    $mail->Body    = $mail_body;
    $mail->send();
    return redirect()->back();
  }
}
