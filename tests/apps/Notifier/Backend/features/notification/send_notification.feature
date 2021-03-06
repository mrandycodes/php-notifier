Feature: Send notifications
    In order to send notifications
    As an api client
    I want an endpoint to send the notification data

    Scenario: Send an email notification
        Given I send a POST request to "/notify" with body:
            """
            {
                "type": "email",
                "message": "Morbi leo risus, porta ac consectetur ac, vestibulum at eros.",
                "arguments": {
                    "subject": "[INFO] Ornare Pellentesque Malesuada",
                    "to": "user@email.com",
                    "alias": "user"
                }
            }
            """
        Then the response status code should be 200

    Scenario: Send a not processable notification
        Given I send a POST request to "/notify" with body:
            """
            {
                "type": "wrong-notification",
                "message": "Morbi leo risus, porta ac consectetur ac, vestibulum at eros.",
                "arguments": {
                    "subject": "[INFO] Ornare Pellentesque Malesuada",
                    "to": "user@email.com",
                    "alias": "user"
                }
            }
            """
        Then the response status code should be 400