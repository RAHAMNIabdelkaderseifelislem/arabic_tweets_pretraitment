# arabic tweets pretraitment

this website contains a pretraitment of arabic tweets to be used in sentiment analysis

## structure

```bash
- tweets_pre/
    - index.php              // the main entry point for the application
    - upload.php             // handles the CSV file upload and preprocessing
    - preprocess.php         // contains the pre-processing functions for the tweets
    - database.php           // contains functions to connect to the database
    - models/
        - Tweet.php          // a model for a single tweet
    - views/
        - upload.php         // the form to upload a CSV file
        - results.php        // displays the pre-processed tweets
    - assets/
        - css/
            - style.css      // styles for the views
    - vendor/
        - autoload.php       // autoloader for third-party packages

```
