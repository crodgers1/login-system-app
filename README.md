Login System App - CS Rodgers

This app was built on request to show my handling of laravel.
 
 The login uses middleware to prevent unauthorised access as well as logging a user out if their password is changed. The file for which is in 'app/Http/middleware/AccessControl'
 
 The application does not use any controllers as the operations are simple enough to stay in the route. I would move these into the controller if the needs arrives.
 
This design has been made into a bland template in order to allow customisation so the login could be reused or even made reusable for a multi company login with customisable designs. 
