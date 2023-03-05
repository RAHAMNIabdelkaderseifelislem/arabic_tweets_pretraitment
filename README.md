# arabic tweets pretraitment

this website contains a pretraitment of arabic tweets to be used in sentiment analysis

## structure

```bash
app/
|-- config/
|   |-- database.php
|   |-- constants.php
|-- controllers/
|   |-- PreprocessingController.php
|   |-- TweetController.php
|-- helpers/
|   |-- utility.php
|-- models/
|   |-- TweetModel.php
|-- views/
|   |-- index.php
|   |-- preprocessing.php
|-- preprocess/
|   |-- Tokenizer.php
|   |-- Normalizer.php
|   |-- StopwordRemover.php
|-- vendor/
|   |-- (third-party libraries)
|-- index.php
|-- README.md
```
