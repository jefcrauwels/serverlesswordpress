# Serverless WordPress

This project is the proof of concept of my master thesis on Serverless Computing. 
The goal of this project is to run WordPress in a serverless environment (on AWS using API Gateway and AWS Lambda). Migrating a monolithic application to serverless implies cutting it into services and implementing them using serverless technologies.

As WordPress is a complex and tightly coupled application, it was difficult to determine the service boundaries. Because migrating monolithic to microservices is beyond the scope of this research, the author decided to only migrate one capability to serverless: Formatting (please refer to [CoreCodeChanges.md](CCC.md) if you want a deeper understanding at what has been changed to the core WordPress code). However, this process shows that it is possible to run WordPress in a serverless environment, it just requires a lot of time and understanding of the legacy application.

Finally, this proof of concept allowed to determine the best practices and the requirements to migrate a monolithic application to a serverless environment.

## Prerequisites

This project relies on several dependencies, mainly due to the Lambda custom runtime. Here is the list and a link to tutorials to install them:
/!\ These installations are for windows only. Please find equivalents if you are not working on Windows. /!\

* **PHP 7**: https://www.jeffgeerling.com/blog/2018/installing-php-7-and-composer-on-windows-10
* **Composer**: https://getcomposer.org/download/
* **Docker**: https://hub.docker.com/ (you need to create an account, and go to get started Docker Desktop)
* **AWS CLI**: https://docs.aws.amazon.com/cli/latest/userguide/install-windows.html#awscli-install-windows-path
* **AWS SAM**: https://docs.aws.amazon.com/serverless-application-model/latest/developerguide/serverless-sam-cli-install-windows.html 
* **WAMP** (or equivalent) to run the WordPress website : https://sourceforge.net/projects/wampserver/

/!\ AWS SAM requires Docker to be installed and run. Make sure you installed Docker prior to AWS SAM. /!\
/!\ WordPress requires a MySQL managed database (that's why I like to use WAMP). /!\

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system. 

At the end of this section you should have 2 folders: **serverlesswordpress** where the Lambda function is and your **WordPress** where your WordPress files are.

1. **Install & Configure WordPress** (https://codex.wordpress.org/Installing_WordPress). If you are using WAMP, you have to put your WordPress project in the WAMP directory (if you followed the recommended WAMP installation, it should be in C:\wamp64\www). If you are not used to WAMP, please have a look at https://www.makeuseof.com/tag/how-to-set-up-your-own-wampserver/. It explains how to install a local WordPress website using WAMP.
2. **Clone the serverlesswordpress** project from github (this project does not have to be in the WAMP directory).
3. In the **serverlesswordpress** project, open the **FilesToMoveToWordPress** folder.
4. Copy all the content (files and folders).
5. Open your **WordPress** project.
7. Paste and accept the "Replace file in destination folder". Thanks to this action, your **WordPress** will call the Lambda function instead of the legacy function.

8. **Install dependencies.**

## Dependencies

/!\ Bref requires AWS CLI and AWS SAM to be installed. Make sure these tools are installed prior to Bref /!\

Run the following commands using the CLI in your **serverlesswordpress directory**:  
* Slim 3: ```composer require slim/slim "^3.12"```
* Bref: ```composer require mnapoli/bref```

Run the following command using the CLI in your **WordPressProject directory**:
* Guzzle and PSR 7:```composer require guzzlehttp/guzzle:~6.0```

Of course, because this project is meant to be deployed on AWS, you need an **AWS account** (https://aws.amazon.com/) and you need to configure your **credentials** (https://docs.aws.amazon.com/sdk-for-java/v1/developer-guide/setup-credentials.html).
By default, Bref deploys the application in the AWS Region **us-east-1** (North Virginia, USA). If you are a first time user, using the us-east-1 region (the default region) is highly recommended for the first projects. It simplifies commands and avoids a lot of mistakes when discovering AWS. 

## Run locally

Change the API URL by ```'http://127.0.0.1:3000' ``` in the **C:\wamp64\www\<WordPressProjectName>/wp-includes/serverless-functions.php** file.
The ```sam local start-api``` command starts Docker containers that will emulate AWS Lambda and API Gateway on your machine.
Once started, your application will be available at http://localhost:3000.
Start your WordPress website (Open browser and browse http://localhost/WordPressProjectName). Make sure your WAMP server is running.
You should land on the home page of your WordPress website. The formatting of the titles and the archive links is done by a Lambda function and not by the WordPress application anymore.

## Deployment

If you want a full understanding on how this deployment works, please refer to this website https://bref.sh/docs/deploy.html
To deploy the application on AWS type the following commands in the **serverlesswordpress** directory:
```
aws s3 mb s3://<bucket-name> (only done for initial deployment, not necessary anymore after)
```
```
sam package --output-template-file .stack.yaml --s3-bucket <bucket-name>
```
```
sam deploy --template-file .stack.yaml --capabilities CAPABILITY_IAM --stack-name <stack-name>
```

Make sure to replace <stack_name> and <bucket-name>

1. Log into your AWS account and go to the API Gateway page. You will see a Gateway named wptexturize. 
2. Click on it and go to the Stages section. 
3. Click on Prod, and on the displayed page you will see the Invoke URL (should look like  https://XXXXXXXXXX.execute-api.us-east-1.amazonaws.com/Prod). 
4. Copy this URL and paste it in the C:\wamp64\www\<WordPressProjectName>/wp-includes/serverless-functions.php file where <YourAPIGatewayURL> is.
5. Save all your files.
6. Launch your WordPress website (Open browser and browse http://localhost/WordPressProjectName). Make sure your WAMP server is running.
7. In your AWS account go to CloudWatch, Logs, /aws/lambda/wptexturize.
8. Click on the latest log. 
9. You can see that you Lambda Function responsible to format the titles and the archive links of your WordPress website has been used (you might have to wait a minute before the logs appear).
10. You can also go to Lambda and API Gateway pages to see the calls.

## Author

* **Jef Crauwels** 

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Acknowledgments

* **Mathieu Napoli (mnapoli)** - His Bref package really simplified my work.
* **Hidde Westra** and **Michiel Bakker** - My mentors that gave me great advice/tips.
* **The WordPress community** - For the amazing documentation.

## Improvements

* Create Ansible file to automate the application's installation.
* Build more serverless services (Authentification for example).