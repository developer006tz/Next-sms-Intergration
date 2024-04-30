# SMS OTP Sender

This project includes a function to send an OTP (One-Time Password) via SMS using a specific SMS provider.

## Requirements

1. **API Key and Secret Key**: These are used for authentication. They are typically provided when you create an account with the SMS provider.

2. **Phone Number**: This is the recipient's phone number. The OTP will be sent to this number.

3. **OTP**: This is the One-Time Password that will be sent to the recipient.

4. **Message (optional)**: This is an optional custom message that will be sent instead of the default message.

5. **CURL**: This is a library used to make HTTP requests. The code uses CURL to send a POST request to the SMS provider's API.

6. **Internet Connection**: Since the request is made over the internet, an active internet connection is required.

## Usage

```php
sendOtp($phone_number, $otp, $message = null)
