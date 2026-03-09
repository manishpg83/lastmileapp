<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message - Delivery Wale</title>
    <style>
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        
        @media screen and (max-width: 600px) {
            .email-container { width: 100% !important; }
            .content-padding { padding: 20px !important; }
            .header-text { font-size: 20px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" class="email-container" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); padding: 30px 40px; text-align: center;" class="content-padding">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="text-align: center;">
                                        <!-- Logo Image -->
                                        <div style="margin-bottom: 15px;">
                                            <img src="{{ asset('frontend/images/delivery_wale.png') }}"
                                                 alt="Delivery Wale Logo"
                                                 style="max-width: 180px; height: auto; display: block; margin: 0 auto;">
                                        </div>
                                        <p style="color: #94A3B8; margin: 8px 0 0 0; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">New Contact Message</p>
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
                                        <h2 style="color: #0F172A; margin: 0 0 15px 0; font-size: 22px; font-weight: 600;">Hello Admin,</h2>
                                        <p style="color: #64748B; margin: 0; font-size: 16px; line-height: 1.6;">
                                            You have received a new contact message from your website. Here are the details:
                                        </p>
                                    </td>
                                </tr>
                                
                                <!-- Message Details Card -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #F8FAFC; border-radius: 10px; border-left: 4px solid #f97316;">
                                            <tr>
                                                <td style="padding: 25px;">
                                                    
                                                    <!-- Name -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 18px;">
                                                        <tr>
                                                            <td width="30" style="vertical-align: top;">
                                                                <span style="display: inline-block; width: 24px; height: 24px; background-color: #f97316; border-radius: 50%; text-align: center; line-height: 24px; color: #ffffff; font-size: 12px;">👤</span>
                                                            </td>
                                                            <td style="vertical-align: top; padding-left: 12px;">
                                                                <p style="margin: 0; color: #94A3B8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Name</p>
                                                                <p style="margin: 4px 0 0 0; color: #0F172A; font-size: 16px; font-weight: 600;">{{ $data['name'] }}</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                    <!-- Email -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 18px;">
                                                        <tr>
                                                            <td width="30" style="vertical-align: top;">
                                                                <span style="display: inline-block; width: 24px; height: 24px; background-color: #f97316; border-radius: 50%; text-align: center; line-height: 24px; color: #ffffff; font-size: 12px;">✉️</span>
                                                            </td>
                                                            <td style="vertical-align: top; padding-left: 12px;">
                                                                <p style="margin: 0; color: #94A3B8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Email</p>
                                                                <p style="margin: 4px 0 0 0; color: #0F172A; font-size: 16px; font-weight: 600;">
                                                                    <a href="mailto:{{ $data['email'] }}" style="color: #0F172A; text-decoration: none;">{{ $data['email'] }}</a>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                    <!-- Phone -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 18px;">
                                                        <tr>
                                                            <td width="30" style="vertical-align: top;">
                                                                <span style="display: inline-block; width: 24px; height: 24px; background-color: #f97316; border-radius: 50%; text-align: center; line-height: 24px; color: #ffffff; font-size: 12px;">📞</span>
                                                            </td>
                                                            <td style="vertical-align: top; padding-left: 12px;">
                                                                <p style="margin: 0; color: #94A3B8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Phone</p>
                                                                <p style="margin: 4px 0 0 0; color: #0F172A; font-size: 16px; font-weight: 600;">
                                                                    <a href="tel:{{ $data['phone'] }}" style="color: #0F172A; text-decoration: none;">{{ $data['phone'] }}</a>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                    <!-- Message -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tr>
                                                            <td width="30" style="vertical-align: top;">
                                                                <span style="display: inline-block; width: 24px; height: 24px; background-color: #f97316; border-radius: 50%; text-align: center; line-height: 24px; color: #ffffff; font-size: 12px;">💬</span>
                                                            </td>
                                                            <td style="vertical-align: top; padding-left: 12px;">
                                                                <p style="margin: 0; color: #94A3B8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Message</p>
                                                                <div style="margin: 8px 0 0 0; padding: 15px; background-color: #ffffff; border-radius: 8px; border: 1px solid #E2E8F0;">
                                                                    <p style="margin: 0; color: #334155; font-size: 15px; line-height: 1.6; font-style: italic;">"{{ $data['message'] }}"</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Timestamp -->
                                <tr>
                                    <td style="border-top: 1px solid #E2E8F0; padding-top: 25px;">
                                        <p style="margin: 0; color: #94A3B8; font-size: 13px; text-align: center;">
                                            📅 Received on {{ now()->format('F j, Y \a\t g:i A') }}
                                        </p>
                                    </td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #0F172A; padding: 30px 40px; text-align: center;" class="content-padding">
                            <p style="margin: 0 0 10px 0; color: #ffffff; font-size: 16px; font-weight: 700;">Delivery Wale</p>
                            <p style="margin: 0 0 20px 0; color: #94A3B8; font-size: 13px;">Fast & Reliable Last-Mile Delivery</p>
                            
                            <!-- Social Links -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 0 auto 20px auto;">
                                <tr>
                                    <td style="padding: 0 8px;">
                                        <a href="#" style="display: inline-block; width: 36px; height: 36px; background-color: rgba(255,255,255,0.1); border-radius: 50%; text-align: center; line-height: 36px; color: #ffffff; text-decoration: none; font-size: 14px;">in</a>
                                    </td>
                                    <td style="padding: 0 8px;">
                                        <a href="#" style="display: inline-block; width: 36px; height: 36px; background-color: rgba(255,255,255,0.1); border-radius: 50%; text-align: center; line-height: 36px; color: #ffffff; text-decoration: none; font-size: 14px;">X</a>
                                    </td>
                                    <td style="padding: 0 8px;">
                                        <a href="#" style="display: inline-block; width: 36px; height: 36px; background-color: rgba(255,255,255,0.1); border-radius: 50%; text-align: center; line-height: 36px; color: #ffffff; text-decoration: none; font-size: 14px;">f</a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="margin: 0; color: #64748B; font-size: 12px;">
                                © {{ date('Y') }} Delivery Wale. All rights reserved.
                            </p>
                            <p style="margin: 8px 0 0 0; color: #64748B; font-size: 11px;">
                                This is an automated message from your website contact form.
                            </p>
                        </td>
                    </tr>
                    
                </table>
                
            </td>
        </tr>
    </table>
    
</body>
</html>