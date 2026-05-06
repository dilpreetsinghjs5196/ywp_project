<!DOCTYPE html>
<html>
<head>
    <title>Coupon Approved</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #2c3e50;">Hello {{ $coupon->user_name }},</h2>
        <p>Great news! Your coupon request has been approved by the admin.</p>
        <div style="background: #f4f4f4; padding: 15px; border-radius: 5px; text-align: center; margin: 20px 0;">
            <span style="font-size: 24px; font-weight: bold; color: #e74c3c;">{{ $coupon->code }}</span>
        </div>
        <p>You can use this code to get a discount of <strong>₹{{ number_format($coupon->discount_amount, 2) }}</strong> on your next therapist booking.</p>
        <p>To use it, simply enter the code in the coupon field during the booking process.</p>
        <p>Best regards,<br>YWP-Therapy Team</p>
    </div>
</body>
</html>
