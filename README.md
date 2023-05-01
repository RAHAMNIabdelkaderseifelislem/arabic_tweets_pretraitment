# arabic tweets pretraitment

this website contains a pretraitment of arabic tweets to be used in sentiment analysis

it is a website that is built using php and javascript and it uses composer to manage the packages

## structure

```bash
- tweets_pre/
    - assets/               // the assets of the website
        - css/             // the css files
            - style.css   // the main css file
        - js/              // the javascript files
            - script.js   // the main javascript file
    - Data/                 // the data that i used to test the website
        - 7-tweets.csv       // the arabic tweets
    - uploads/               // the uploaded files
        - tokens.csv        // the tokens of the tweets
        - tweets-ar.csv     // the arabic tweets after deleting the english tweets and every thing that is not
    - vendor/                // the composer packages
        - autoload.php      // the composer autoloader
        - composer/         // the composer packages
        - khaled.alshamaa/  // the arabic sentiment analysis API
    - index.php              // the main entry point for the application
    - composer.json          // the composer configuration file
    - composer.lock          // the composer lock file
```

## installation

to install the website you need to have composer installed on your machine

```bash
# clone the repository
git clone https://github.com/RAHAMNIabdelkaderseifelislem/arabic_tweets_pretraitment.git

# install the composer packages
composer install
```

## usage

to use the website you need to run the following command

```bash
php -S localhost:8000
```

then you can access the website from your browser using the following url

```bash
http://localhost:8000
```

## credits

- [khaled alshamaa](https://github.com/khaled-alshamaa/ar-php)
