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
        - 7-tweets.csv       // 7 arabic tweets
        - 50tweet.csv        // more than 50 arabic tweets exactly 54
        - 100tweets.csv      // more than 100 arabic tweets exactly 108
        - 1000tweets.csv     // more than 1000 arabic tweets exactly 1008
    - uploads/               // the uploaded files
        - tokens.csv        // the tokens of the tweets
        - tweets-ar.csv     // the arabic tweets after deleting the english tweets and every thing that is not
    - vendor/                // the composer packages
        - autoload.php      // the composer autoloader
        - composer/         // the composer packages
        - khaled.alshamaa/  // the arabic sentiment analysis API
    - index.php              // the main entry point for the application
    - history.php            // the latest treated tweets page
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

## screenshots

first look :
![first look](screenshots/firstlook.png)
after upload :
![full page after upload](screenshots/fullpageafterUpload.png)

history :
![history page](screenshots/historypage.png)
tables :<br>

![Original tweets table shown](screenshots/OriginalTweets.png)
![tweets after deleting the english tweets and every thing that is not table shown](screenshots/ProcessedTweets.png)
![tokenization of each tweet table shows](screenshots/Tokens.png)
![the sentiment analysis](screenshots/word_analysis.png)
![the arabic sentiment analysis table shown](screenshots/SentimentAnalysis.png)

graphs :
![the number of words per tweet bar chart shown](screenshots/WordsNumberChart.png)
![the positive and negative tweets pie chart shown](screenshots/Positive_vs_NegativeChart.png)
![the number of positive and negative words bar chart shown](screenshots/word_analysisChart.png)
![the probability of each tweet to be positive or negative bar chart shown](screenshots/ProbabilityChart.png)

## demo video

<video width="600" height="200" controls preload>
    <source src="screenshots/full_website_showdown.mp4"></source>
</video>

## credits

- [khaled alshamaa](https://github.com/khaled-alshamaa/ar-php)
