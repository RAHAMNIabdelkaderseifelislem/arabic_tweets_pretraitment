# arabic tweets pretraitment

this website contains a pretraitment of arabic tweets to be used in sentiment analysis

## structure

```bash
- tweets_pre/
    - index.php              // the main entry point for the application
    - preprocess.php         // the pretraitment of the tweets
    - pretraitment/                    // pretraitment of the tweets
        - tokenize.php      // tokenization of the tweets
        - normalize.php     // normalization of the tweets
    - uploads/               // the uploaded files
        - tokens.csv        // the tokens of the tweets
        - tweets-ar.csv     // the arabic tweets after deleting the english tweets and every thing that is not arabic
```
