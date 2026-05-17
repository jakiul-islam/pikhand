<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome Email</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial, sans-serif;">

  <table align="center" width="100%" cellpadding="0" cellspacing="0" style="padding:20px;">
    <tr>
      <td align="center">

```
    <!-- Main Container -->
    <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden;">

      <!-- Header -->
      <tr>
        <td style="background:#4CAF50; color:#ffffff; padding:20px; text-align:center;">
          <h1 style="margin:0;">Welcome 🎉</h1>
        </td>
      </tr>

      <!-- Body -->
      <tr>
        <td style="padding:30px; color:#333;">
          <h4>Thanks for signing up! We're excited to have you on board.</h4>
          <!-- Button -->
          <p style="text-align:center;">
            {{-- <a href="Verification_Link"
               style="background:#4CAF50; color:#ffffff; padding:12px 20px; text-decoration:none; border-radius:5px; display:inline-block;">
               Verify Email
            </a> --}}
            <h1>{{ $mailOtp }}</h1>
          </p>

          <p>If you didnt create an account, you can safely ignore this email.</p>

          <p>Cheers,<br>Your Team</p>
        </td>
      </tr>

      <!-- Footer -->
      <tr>
        <td style="background:#f4f4f4; text-align:center; padding:15px; font-size:12px; color:#777;">
          © 2026 Your Company. All rights reserved.
        </td>
      </tr>

    </table>

  </td>
</tr>
```

  </table>

</body>
</html>
