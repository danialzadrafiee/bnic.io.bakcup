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
        $mail_body =
            '<section style="background-color: #1c1b20; padding: 50px; font-family: Open Sans, Arial, sans-serif !important;">
            <div
              style="margin-left: auto; margin-right: auto; max-width: 56rem; border-radius: 8px; background-color: #fff; padding-left: 80px; padding-right: 80px; padding-top: 48px; padding-bottom: 48px;">
              <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                  <img src="https://svgur.com/i/uiX.svg" alt="Bnic logo" style="width: 150px;" />
                  <div
                    style="background-color: rgba(0, 132, 255, 0.3); color: #0084ff; padding: 8px; font-weight: 600; border-radius: 8px;">
                    From : ' . $request->sender_full_name . '</div>
                </div>
                <h1 style="font-size: 2rem; font-weight: 400;">Invitation to Explore BNIC.io - Unlock the Power of Blockchain
                  Authentication</h1>
              </div>
              <div style="margin-top: 8px;">
                <p style="font-size: 1.125rem;">Dear ' . $request->reciver_first_name . ' ' . $request->reciver_last_name . ',</p>
                <p style="margin-top: 4px; font-size: 1.125rem;">We are thrilled to extend a special invitation to you to explore
                  BNIC.io, the revolutionary platform that enables you and your company to harness the transformative power of
                  blockchain authentication. As someone who values security, transparency, and cutting-edge technology, we believe
                  BNIC.io will be a game-changer for you.</p>
                <p style="margin-top: 4px; font-size: 1.125rem;">BNIC.io is a trusted online destination that offers seamless
                  integration of blockchain technology into your authentication processes. Whether you are an individual
                  professional, a small business owner, or a large corporation, BNIC.io has the tools and expertise to streamline
                  your authentication needs and enhance the integrity of your certificates.</p>
              </div>
              <div
                style="width: 100%; padding-top: 1px; padding-bottom: 1px; margin-top: 36px; margin-bottom: 36px; background-color: #f7fafc;">
              </div>
              <div style="display: flex; gap: 16px; align-items: flex-end;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/QR_Code_Example.svg/1024px-QR_Code_Example.svg.png" style="width: 120px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-radius: 8px; padding: 8px;">
                <div stlye="padding:0px;">You can join by scanning QRCode or clicking on the following link <a href="#"
                    style="color: #0084ff; text-decoration: none; display:block">https://bnic.io/invitation/' . $request->sender_id . '/213819</a></div>
              </div>
            </div>
          </section>
      ';

        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'mail.developerpie.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '_mainaccount@developerpie.com';
            $mail->Password   = 'WTFIS0124WTFIS0124';
            $mail->SMTPSecure = false;  // Turn off SMTP encryption
            $mail->SMTPAutoTLS = false; // Turn off automatic TLS encryption
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('develop1@developerpie.com', 'Develop1');
            $mail->addAddress($request->reciver_email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Invitation to Explore BNIC.io';
            $mail->Body    = $mail_body;

            $mail->send();
            echo 'Message has been sent';
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
