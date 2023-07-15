<section style="background-color: #1c1b20; padding: 50px; font-family: Open Sans, Arial, sans-serif !important;">
    <div style="margin-left: auto; margin-right: auto; max-width: 56rem; border-radius: 8px; background-color: #fff; padding-left: 80px; padding-right: 80px; padding-top: 48px; padding-bottom: 48px;">
        <div>
            <table>
                <tr>
                    <td align="left" width="100%">
                        <img src="https://bnic.io/img/global/bnic-email-logo-dark.png" alt="Bnic logo" style="width: 150px;" />
                    </td>
                    <td align="right" style="background-color: rgba(0, 132, 255, 0.3); color: #0084ff;  padding: 8px; font-weight: 600; border-radius: 8px; display:block; width:max-content">
                        From:{{ $request->sender_full_name }}
                    </td>
                </tr>
            </table>
            <div style="margin-top: 8px;">
                <h1 style="font-size: 2rem; font-weight: 400;">Invitation to Explore BNIC.io - Unlock the Power of Blockchain
                    Authentication</h1>
                <p style="font-size: 1.125rem;">Dear {{ $request->reciver_first_name }} {{ $request->reciver_last_name }} </p>
                <p style="margin-top: 4px; font-size: 1.125rem;">We are thrilled to extend a special invitation to you to explore
                    BNIC.io, the revolutionary platform that enables you and your company to harness the transformative power of
                    blockchain authentication. As someone who values security, transparency, and cutting-edge technology, we believe
                    BNIC.io will be a game-changer for you.</p>
                <p style="margin-top: 4px; font-size: 1.125rem;">BNIC.io is a trusted online destination that offers seamless
                    integration of blockchain technology into your authentication processes. Whether you are an individual
                    professional, a small business owner, or a large corporation, BNIC.io has the tools and expertise to streamline
                    your authentication needs and enhance the integrity of your certificates.</p>
            </div>
            <div style="width: 100%; padding-top: 1px; padding-bottom: 1px; margin-top: 36px; margin-bottom: 36px; background-color: #f7fafc;">
            </div>
            <table>
                <tr>
                    <td valign="bottom">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ $url }}" style="width: 120px;">
                    </td>
                    <td valign="bottom" style="padding-left:16px">
                        <div stlye="padding:0px;">You can join by scanning QRCode or clicking on the following link <a style="color: #0084ff; text-decoration: none; display:block" href="{{ $url }}">{{ $url }}
                            </a></div>
                    </td>
        </div>
        </tr>
        </table>
    </div>
</section>
