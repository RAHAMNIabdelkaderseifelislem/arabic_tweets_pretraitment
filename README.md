# arabic tweets pretraitment

this website contains a pretraitment of arabic tweets to be used in sentiment analysis

## structure

```bash
app/
|-- config/
|   |-- database.php
|   |-- constants.php
|-- controller/
|   |-- PreprocessingController.php
|   |-- TweetController.php
|-- db/
|   |-- tweets_pre.sql
|-- helper/
|   |-- utility.php
|-- model/
|   |-- TweetModel.php
|-- view/
|   |-- index.php
|   |-- preprocessing.php
|-- preprocess/
|   |-- Tokenizer.php
|   |-- Normalizer.php
|-- vendor/
|   |-- (third-party libraries)
|-- index.php
|-- README.md
```
