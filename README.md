# Serverless WordPress

This project is the proof of concept of my master thesis on Serverless Computing. 
The goal of this project is to run WordPress in a serverless environment (on AWS using API Gateway and AWS Lambda). Migrating a monolithic application to serverless implies cutting it into services and implementing them using serverless technologies.

As WordPress is a complex and tightly coupled application, it was difficult to determine the service boundaries. Because migrating monolithic to microservices is beyond the scope of this research, the author decided to only migrate one capability to serverless: Formatting. However, this process shows that it is possible to run WordPress in a serverless environment, it just requires a lot of time and understanding of the legacy application.

Finally, this proof of concept allowed to determine the best practices and the requirements to migrate a monolithic application to a serverless environment.

## Prerequisites

This project relies on several dependencies, mainly due to the Lambda custom runtime. Here is the list and a link to tutorials to install them:
/!\ These installations are for windows only. Please find equivalents if you are not working on Windows. /!\

* PHP 7: https://www.jeffgeerling.com/blog/2018/installing-php-7-and-composer-on-windows-10
* Composer: https://getcomposer.org/download/
* Docker: https://hub.docker.com/ (you need to create an account, and go to get started Docker Desktop)
* AWS CLI: https://docs.aws.amazon.com/cli/latest/userguide/install-windows.html#awscli-install-windows-path
* AWS SAM: https://docs.aws.amazon.com/serverless-application-model/latest/developerguide/serverless-sam-cli-install-windows.html 

/!\ AWS SAM requires Docker to be installed and run. Make sure you installed Docker prior to AWS SAM /!\

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

1. Install & Configure WordPress (https://codex.wordpress.org/Installing_WordPress)
2. Clone the project
3. Replace the wordpress/wp-includes/general-template.php file by the general-template.php from the cloned project (in Files to move to WordPress folder).
4. Delete the general-template.php file in the cloned project.
5. Same for the serverless-functions.php file.
6. Install dependencies

## Dependencies

/!\ Bref requires AWS CLI and AWS SAM to be installed. Make sure these tools are installed prior to Bref /!\

Slim 3: 
```
composer require slim/slim "^3.12"
```
Guzzle and PSR 7:
```
composer require guzzlehttp/guzzle:~6.0
```
Bref: 
```
composer require mnapoli/bref
```

Of course, because this project is meant to be deployed on AWS, you need an AWS account (https://aws.amazon.com/) and you need to configure your credentials (https://docs.aws.amazon.com/sdk-for-java/v1/developer-guide/setup-credentials.html).
By default, Bref deploys the application in the AWS Region us-east-1 (North Virginia, USA). If you are a first time user, using the us-east-1 region (the default region) is highly recommended for the first projects. It simplifies commands and avoids a lot of mistakes when discovering AWS. 

## Run locally
TODO

## Deployment

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

## Author

* **Jef Crauwels** 

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Acknowledgments

* Mathieu Napoli (mnapoli) - His Bref package really simplified my work.
* Hidde Westra and Michiel Bakker - My mentors that gave me great advice/tips.
* The WordPress community - For the amazing documentation.

## Improvements
* Create Ansible file to automate the application's installation.
* Use the serverless formatting in the entire WordPress application and not only in the general-template.php file.
* Build more serverless services (Authentification for example).
* Explain the modifications in general-template
* Explain purpose of serverless-functions.php file
* Explain index.php and template.yaml file
* Make license
