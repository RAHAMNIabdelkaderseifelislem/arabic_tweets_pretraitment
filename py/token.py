import sys

sys.path.append("c:\program files\python39\lib\site-packages")

import nltk
from nltk.tokenize import word_tokenize
import csv

print('<html><head><title>Tokenization</title> <meta charset="UTF-8"></head><body>')

tweets_tokenized = []
# Open the file
with open('../uploads/tweets-ar.csv', 'r', encoding='utf-8') as f:
    reader = csv.reader(f)
    for row in reader:
        # Tokenize the tweet
        tokens = [nltk.word_tokenize(i) for i in row]
        # Print the tokens
        for i in tokens:
            tokens_list = u"['" + u"', '".join(i) + u"']"
        tweets_tokenized.append(tokens_list)
        print(tokens_list)

print(tweets_tokenized)

print("</body></html>")