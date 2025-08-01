<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-size: 20px;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .header img {
            width: 100px;
            height: 60px; /* Adjust as needed */
        }
        h1 {
            color: #333;
            text-align: center;
        }
        p {
            color: #666;
        }
        .otp {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .signature {
            margin-top: 20px;
/*            text-align: center;*/
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="">
            <img src="https://ciphet.icar.gov.in/wp-content/themes/grd/img/ciphet-logo.PNG" alt="Company Logo" style="width:570px;height:90px !important;"> <!-- Replace the URL with your logo image -->
        </div>
        <h1>OTP Notification</h1>
        <p>Hi, {{$name}},</p>
        <p>Use the following One Time Password (OTP) to Log in to Icar Doca Application:</p>
        <div class="otp"><b>{{$otp}}</b></div>
        <p>This OTP is valid for 30 minutes. Please do not share this OTP with anyone for security reasons.</p>
        <div class="signature">
            <p>Thanks & Regards, <br> ICAR-Central Institute of Post-Harvest Engineering <br> and Technology,Ministry of Agriculture and <br> Farmers Welfare, Government of India</p>
            <br><br>
        </div>
    </div>
</body>
</html>
