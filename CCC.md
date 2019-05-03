# Core code changes

Here is a deeper explanation for what has been changed to the WordPress core code in order to have a serverless title and archive links formatting.
This explanation is divided in 2 parts: the Serverless WordPress and the WordPress core code.

## Serverless WordPress

The goal of this proof of concept is to split WordPress in microservices and run these services using the serverless technology. This project is hosted in AWS and therefore uses Lambda and API Gateway.
Because WordPress is written in PHP and Lambda does not have PHP as a native runtime, the author used the Bref package to have a stable PHP custom runtime on the Lambda function.
The lambda function uses the Slim Framework to handle the HTTP requests/responses.

In short, the Lambda function is called from the WordPress monolithic application via the API Gateway. The lambda function is a replica of the wptexturize() WordPress function. In order for this function to work, it was necessary to copy several WordPress files to Lambda (serv-wp-includes folder).

## WordPress core code

In order to call the Lambda function instead of the legacy wptexturize() WordPress function, some core code had to be changed. Wptexturize() is called at many moments in WordPress, but for this project the serverless wptexturize() is only called in the wp-includes/general-template.php file. The modifications to the core code look like this :
```
/** 
 * Original version
 */
//$text = wptexturize( $text );

/** 
 * Serverless version
 */
$text = serv_wptexturize($text);
```
The serv_wptexturize() function is defined in the wp-includes/serverless-functions.php file. For this reason, this new file has been included at the top of the wp-includes/general-template.php file:
```
require( dirname( __FILE__ ) . '/serverless-functions.php' );
```