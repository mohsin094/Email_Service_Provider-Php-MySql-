# ess
email sending service

We need to create an email sending service : 

- We will create a merchant account 

- Now our register merchants can use our Email sending service using our REST API

- Merchants can see the all listing of requests in the back office.

- Also merchants can check the billing info and payments.

- Merchants also can add new secondary users with different roles

- Also can assign different permission to different secondary users.

- Also need to create admin back-office in which admin can see all merchants, secondary users, request and billing info and payments

- Price of every email is 0.0489 $

EMAIL Sending Rest API : 

- USE Auth 2.0 or Auth 10.0 or basic auth

- Create Below API Endpoints

- Send Email Endpoint: POST

- Get status End Point: POST

Send Email Request Object : 

```

{

    "reference": "request_reference",

    "webhook_url": "https://test.com/webhook_url",

    "data": {

        "from": "",

        "to": "",

        "cc": "",

        "bcc": "",

        "subject": "",

        "body": ""

    }

}

```

Email Status EndPoint : 

```

{

    "reference": "request_reference"

}

```

Response Object : 

```

{

    "status": "invalid",

    "error": {

        "key": "",

        "message": ""

    },

    "descroption": ""

}

```



status : 

- received

- processed 

- error

- invalid



Cron jobs : 

- Using process merchant's emails in the background.

- Sending low balance emails.

- Sending daily invoices and usage.

