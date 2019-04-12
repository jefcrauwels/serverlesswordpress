def hello(event, context):
    response = {
        "statusCode": 200,
        "body": 'Hello, world!'
    }

    return response