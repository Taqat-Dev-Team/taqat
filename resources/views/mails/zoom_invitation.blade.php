<!DOCTYPE html>
<html>
<head>
    <title>Zoom Meeting Invitation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff;">
                    <tr>
                        <td align="center" bgcolor="#0073e6" style="padding: 40px 0 30px 0; color: #ffffff; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                            You're Invited to a Zoom Meeting
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
                                        <p style="margin: 0;">You have been invited to join a Zoom meeting.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #333333; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        <p style="margin: 0;">**Meeting Date:** {{ $meetingDate }}</p>
                                        <p style="margin: 0;">**Meeting Time:** {{ $meetingTime }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 0 30px 0;">
                                        <a href="{{ $zoomLink }}" style="background-color: #0073e6; color: #ffffff; padding: 15px 25px; text-decoration: none; font-size: 16px; display: inline-block;">Join Zoom Meeting</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #333333; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        <p style="margin: 0;">If the button above doesn't work, copy and paste the following link into your browser:</p>
                                        <p style="word-break: break-word;"><a href="{{ $zoomLink }}" style="color: #0073e6;">{{ $zoomLink }}</a></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#0073e6" style="padding: 30px 30px 30px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
                                        &copy; {{ date('Y') }} Taqat. All rights reserved.<br/>
                                        If you have any questions, please contact us at <a href="info@taqat-gaza.com" style="color: #ffffff;">support@yourcompany.com</a>.
                                    </td>
                                    <td align="right" width="25%">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <a href="https://www.facebook.com/yourcompany" style="color: #ffffff;"><img src="https://i.imgur.com/4pFaJ2D.png" alt="Facebook" width="30" height="30" style="display: block; border: 0;"/></a>
                                                </td>
                                                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                <td>
                                                    <a href="https://www.twitter.com/yourcompany" style="color: #ffffff;"><img src="https://i.imgur.com/MTVajN7.png" alt="Twitter" width="30" height="30" style="display: block; border: 0;"/></a>
                                                </td>
                                            </tr>
                                        </table>
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
