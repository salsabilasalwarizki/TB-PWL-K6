<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: white; padding: 30px; border-radius: 12px 12px 0 0; text-align: center; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 12px 12px; }
        .info-box { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #6366f1; }
        .label { font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
        .value { color: #333; font-size: 14px; margin-bottom: 15px; }
        .message-box { background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #8b5cf6; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-size: 24px;">📧 New Contact Message</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">DataSphere Machine Learning Repository</p>
    </div>
    
    <div class="content">
        <div class="info-box">
            <div class="label">From</div>
            <div class="value">{{ $data['name'] }} &lt;{{ $data['email'] }}&gt;</div>
            
            <div class="label">Subject</div>
            <div class="value" style="color: #6366f1; font-weight: 600;">{{ $data['subject'] }}</div>
            
            <div class="label">Received</div>
            <div class="value">{{ now()->format('l, F j, Y \a\t g:i A') }} WIB</div>
        </div>
        
        <div class="message-box">
            <div class="label">Message</div>
            <div style="white-space: pre-wrap; color: #333; font-size: 14px; line-height: 1.8;">{{ $data['message'] }}</div>
        </div>
    </div>
    
    <div class="footer">
        <p>This email was sent from the DataSphere contact form.</p>
        <p>Reply directly to this email to respond to {{ $data['name'] }}.</p>
    </div>
</body>
</html>