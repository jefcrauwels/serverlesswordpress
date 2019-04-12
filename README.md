# serverlesswordpress

This project creates a API Gateway pointing to a WordPress website.

One service of WordPress (formatting) is made serverless (runs on a AWS Lambda).

For the moment the service is present in both the legacy application and in a AWS Lambda function (hybrid architecture).
The service is only called at:

    Line 1076, file wp-includes/general-templates.php

When it is proved the service functions correctly,it will replace the legacy service, which will be erased from the monolithic application.

This project aims to show that WordPress could be run in a serverless environment.