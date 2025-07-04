# TrustlinePay API (v1) - B2C Mobile Payment Endpoint

This guide helps developers integrate with TrustlinePay's B2C API to initiate mobile money payments securely and reliably.

---

## 🔐 Authentication

* **Method**: HTTP Basic Auth
* **Header Format**:

  ```
  Authorization: Basic base64(username:password)
  ```
* Credentials are validated against registered API users.

---

## 📤 Endpoint

`POST https://trustline.co.ke/api/v1/pay`

Initiate a payment to a user's mobile money account.

---

## 📝 Request Body

Send as `application/json`:

| Field                | Type    | Required | Description                                  |
| -------------------- | ------- | -------- | -------------------------------------------- |
| `external_reference` | string  | ✅        | Unique ID for tracking your transaction.     |
| `amount`             | number  | ✅        | Minimum: 40. Total fees are auto-calculated. |
| `phone_number`       | string  | ✅        | MSISDN to pay, e.g. `0112920153`.            |
| `network_code`       | string  | ✅        | Supported: `safaricom`, `airtel`.            |
| `channel`            | string  | ✅        | Use `mobile`.                                |
| `channel_id`         | integer | ✅        | Assigned per client.                         |
| `payment_service`    | string  | ✅        | Always `b2c`.                                |
| `callback_url`       | string  | ✅        | HTTPS webhook to receive transaction status. |

---

## ✅ Successful Response

```json
{
  "success": true,
  "code": 200,
  "status": "processing",
  "data": {
    "merchant_reference": "...",
    "checkout_request_id": "..."
  }
}
```

---

## ❌ Error Responses

### 400 - Invalid Request

```json
{
  "success": false,
  "code": 400,
  "message": "Phone number is required."
}
```

### 401 - Missing/Invalid Auth

```json
{
  "success": false,
  "code": 401,
  "message": "Authorization failed: username or password is missing in the request header."
}
```

### 404 - User Not Found

```json
{
  "success": false,
  "code": 404,
  "message": "User account not found for these credentials."
}
```

### 429 - Duplicate Transaction

```json
{
  "success": false,
  "code": 429,
  "message": "Similar transaction already made recently. Please try again in 5 minutes."
}
```

---

## 📩 Callback Webhook

Once the transaction is processed, your `callback_url` will receive a POST request from TrustlinePay.

> Sample callback structure will be added after we examine the PayHeroService callback format.

---

## 💰 Transaction Fees

Fees are fetched from:

```
GET https://trustline.co.ke/api/get-transaction-fee?amount=XXX
```

If the endpoint fails, a default fee of **30** is applied.

---

## 📊 Transaction Logging

All successful requests are logged and stored in:

* `transaction_logs`
* `payment_transactions`

Prevents duplicate attempts within a 5-minute window.

---

## ⚠️ Notes

* Requests below 40 KES are rejected.
* Phone number, amount, and network are strictly validated.
* Ensure callback URL is live and publicly accessible (HTTPS recommended).

---

## 🔧 Test with Thunder Client / Postman

1. Set method to `POST`.
2. URL: `https://trustline.co.ke/api/v1/pay`
3. Auth: Basic (username + password)
4. Body (raw JSON):

```json
{
  "external_reference": "mpesa101",
  "amount": 41,
  "phone_number": "0112920153",
  "network_code": "safaricom",
  "channel": "mobile",
  "channel_id": 1768,
  "payment_service": "b2c",
  "callback_url": "https://yourdomain.com/webhook"
}
```

---

For support, contact the TrustlinePay team.
