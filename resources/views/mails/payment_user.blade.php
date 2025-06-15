<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff;">
                    <tr>
                        <td align="center" bgcolor="#28a745" style="padding: 40px 0 30px 0; color: #ffffff; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                            Payment Confirmation
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #333333; font-family: Arial, sans-serif; font-size: 20px;">
                                        <p style="margin: 0;">Hello,</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 0 10px 0; color: #333333; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        <p style="margin: 0;">We have received your payment. Here are the details:</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #333333; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        <p style="margin: 0;">**Amount Paid:** ${{ $amount }}</p>
                                        <p style="margin: 0;">**Transaction ID:** {{ $transactionId }}</p>
                                        <p style="margin: 0;">**Payment Date:** {{ $paymentDate }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 0 30px 0;">
                                        <p style="margin: 0;">Thank you for your payment. If you have any questions, feel free to contact us.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#28a745" style="padding: 30px 30px 30px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                        &copy; {{ date('Y') }} Taqat. All rights reserved.<br/>
                                        If you have any questions, please contact us at <a href="mailto:info@taqat-gaza.com" style="color: #ffffff;">support@yourcompany.com</a>.
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
