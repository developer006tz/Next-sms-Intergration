# SMS Sender

This project includes a function to send an SMS using a specific SMS provider.

## Requirements

1. **API Key and Secret Key**: These are used for authentication. They are typically provided when you create an account with the SMS provider.

2. **Phone Number**: This is the recipient's phone number. The SMS will be sent to this number.

3. **SMS**: This is the message that will be sent to the recipient.

4. **CURL**: This is a library used to make HTTP requests. The code uses CURL to send a POST request to the SMS provider's API.

5. **Internet Connection**: Since the request is made over the internet, an active internet connection is required.

## Usage

```php
sendSms($phone_number, $sms)
