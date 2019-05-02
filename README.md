# Serverless WordPress

One Paragraph of project description goes here

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
Give examples
```

### Installing

A step by step series of examples that tell you how to get a development env running

Say what the step will be

```
Give the example
```

And repeat

```
until finished
```

End with an example of getting some data out of the system or using it for a little demo

## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc








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