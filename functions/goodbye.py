def goodbye(event, context):
    response = {
        "statusCode": 200,
        "body": 'Goodbye, world!'
    }

    return response