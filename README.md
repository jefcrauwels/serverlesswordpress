/!\ The application has to be deployed in us-east-1 region /!\

Requirements
	PHP 7
	Composer
	Docker
	AWS CLI
	AWS SAM
	npm

Prerequisites
	Set AWS access key and secret key

Create project file with dependencies

	composer require mnapoli/bref
	composer require guzzlehttp/guzzle:~6.0
	composer require slim/slim "^3.12"
	npm i -g serverless

Copy index.php and template.yaml at root of the project

Deploy application
	aws s3 mb s3://<bucket-name> (only done for initial deployment, not necessary anymore after)
	sam package --output-template-file .stack.yaml --s3-bucket <bucket-name>
	sam deploy --template-file .stack.yaml --capabilities CAPABILITY_IAM --stack-name <stack-name>

Make sure to replace <stack_name> and <bucket-name>

TODO
Create Ansible file to automate the application's installation
