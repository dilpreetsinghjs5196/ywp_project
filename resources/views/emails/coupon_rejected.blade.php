<!DOCTYPE html>
<html>
<head>
    <title>Coupon Request Update</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #2c3e50;">Hello {{ $coupon->user_name }},</h2>
        <p>Thank you for your coupon request on the YWP Therapy platform.</p>
        <p>We are writing to let you know that after careful review, your coupon request has been <strong>declined</strong> at this time.</p>
        
        <div style="background: #fdf2f2; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #f8b4b4;">
            <p style="margin: 0 0 5px 0;"><strong>Requested Coupon Details:</strong></p>
            <p style="margin: 0; font-size: 15px;">
                Code: <code style="font-size: 16px; background: #fff; padding: 2px 6px; border: 1px solid #ddd; border-radius: 3px; font-weight: bold; color: #9b1c1c; text-transform: uppercase;">{{ $coupon->code }}</code><br>
                Discount Amount: <strong>₹{{ number_format($coupon->discount_amount, 2) }}</strong>
            </p>
        </div>

        <p>If you have any questions or feel this decision was made in error, please don't hesitate to reach out to our support team.</p>
        <p>Thank you for your understanding.</p>
        <p>Best regards,<br>YWP-Therapy Team</p>
    </div>
</body>
</html>
