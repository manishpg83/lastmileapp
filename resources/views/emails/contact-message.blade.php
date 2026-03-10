<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message - Delivery Wale</title>
    <style>
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            outline: none;
            text-decoration: none;
        }

        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }

            .content-padding {
                padding: 20px !important;
            }

            .header-text {
                font-size: 20px !important;
            }
        }
    </style>
</head>

<body
    style="margin: 0; padding: 0; background-color: #F8FAFC; font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
        style="background-color: #F8FAFC;">
        <tr>
            <td align="center" style="padding: 40px 0;">

                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600"
                    class="email-container"
                    style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #E2E8F0;">

                    <!-- Header -->
                    <tr>
                        <td style="background-color: #ffffff; padding: 30px 40px; text-align: center; border-bottom: 4px solid #f97316;"
                            class="content-padding">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <img src="{{ asset('frontend/images/truck_logo.png') }}" alt="Truck Icon"
                                            style="max-width: 40px; height: auto; display: block;">
                                    </td>
                                    <td style="vertical-align: middle; padding-left: 10px;">
                                        <img src="{{ asset('frontend/images/delivery_wale.png') }}"
                                            alt="Delivery Wale Logo"
                                            style="max-width: 150px; height: auto; display: block;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td style="padding: 40px;" class="content-padding">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">

                                <!-- Greeting -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <h2
                                            style="color: #0F172A; margin: 0 0 15px 0; font-size: 24px; font-weight: 800; letter-spacing: -0.5px;">
                                            New Inquiry Received!</h2>
                                        <p style="color: #64748B; margin: 0; font-size: 16px; line-height: 1.6;">
                                            Hello Admin, you have received a new message through the website contact
                                            form.
                                        </p>
                                    </td>
                                </tr>

                                <!-- Message Details Card -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                            width="100%"
                                            style="background-color: #F8FAFC; border-radius: 12px; border: 1px solid #E2E8F0;">
                                            <tr>
                                                <td style="padding: 30px;">

                                                    <!-- Name -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0"
                                                        border="0" width="100%" style="margin-bottom: 20px;">
                                                        <tr>
                                                            <td style="vertical-align: top;">
                                                                <p
                                                                    style="margin: 0; color: #94A3B8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                                                                    Customer Name</p>
                                                                <p
                                                                    style="margin: 4px 0 0 0; color: #0F172A; font-size: 17px; font-weight: 600;">
                                                                    {{ $data['name'] }}</p>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <!-- Contact Details Info Row -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0"
                                                        border="0" width="100%" style="margin-bottom: 24px;">
                                                        <tr>
                                                            <td width="50%"
                                                                style="vertical-align: top; padding-right: 15px;">
                                                                <p
                                                                    style="margin: 0; color: #94A3B8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                                                                    Email Address</p>
                                                                <p
                                                                    style="margin: 4px 0 0 0; color: #f97316; font-size: 15px; font-weight: 600;">
                                                                    <a href="mailto:{{ $data['email'] }}"
                                                                        style="color: #f97316; text-decoration: none;">{{ $data['email'] }}</a>
                                                                </p>
                                                            </td>
                                                            <td width="50%" style="vertical-align: top;">
                                                                <p
                                                                    style="margin: 0; color: #94A3B8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                                                                    Phone Number</p>
                                                                <p
                                                                    style="margin: 4px 0 0 0; color: #0F172A; font-size: 15px; font-weight: 600;">
                                                                    <a href="tel:{{ $data['phone'] }}"
                                                                        style="color: #0F172A; text-decoration: none;">{{ $data['phone'] }}</a>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <!-- Message -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0"
                                                        border="0" width="100%">
                                                        <tr>
                                                            <td style="vertical-align: top;">
                                                                <p
                                                                    style="margin: 0; color: #94A3B8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                                                                    Message Brief</p>
                                                                <div
                                                                    style="margin: 10px 0 0 0; padding: 20px; background-color: #ffffff; border-radius: 8px; border: 1px solid #E2E8F0; border-left: 4px solid #f97316;">
                                                                    <p
                                                                        style="margin: 0; color: #334155; font-size: 15px; line-height: 1.6; font-style: normal;">
                                                                        {{ $data['message'] }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- CTA -->
                                <tr>
                                    <td align="center">
                                        <a href="mailto:{{ $data['email'] }}"
                                            style="background-color: #f97316; color: #ffffff; padding: 14px 35px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 16px; display: inline-block; box-shadow: 0 4px 10px rgba(249, 115, 22, 0.3);">Reply
                                            to {{ explode(' ', trim($data['name']))[0] }}</a>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #0F172A; padding: 40px; text-align: center;"
                            class="content-padding">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center"
                                style="margin-bottom: 20px; background-color: #ffffff; padding: 10px; border-radius: 8px;">
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <img src="{{ asset('frontend/images/truck_logo.png') }}" alt="Truck Icon"
                                            style="max-width: 30px; height: auto; display: block;">
                                    </td>
                                    <td style="vertical-align: middle; padding-left: 8px;">
                                        <img src="{{ asset('frontend/images/delivery_wale.png') }}"
                                            alt="Delivery Wale Logo"
                                            style="max-width: 120px; height: auto; display: block;">
                                    </td>
                                </tr>
                            </table>

                            <p
                                style="margin: 0 0 10px 0; color: #ffffff; font-size: 15px; font-weight: 700; letter-spacing: 0.5px;">
                                Delivery Wale</p>
                            <p style="margin: 0 0 25px 0; color: #94A3B8; font-size: 13px;">Fast & Reliable Delivery
                                Wale Solution</p>

                            <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                align="center" style="margin: 0 auto 30px auto;">
                                <tr>
                                    <td
                                        style="border-top: 1px solid rgba(255,255,255,0.1); width: 200px; padding-top: 25px;">
                                        <p style="margin: 0; color: #64748B; font-size: 12px; line-height: 1.5;">
                                            © {{ date('Y') }} Delivery Wale. All rights reserved.<br>
                                            This is an automated notification from your website.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
