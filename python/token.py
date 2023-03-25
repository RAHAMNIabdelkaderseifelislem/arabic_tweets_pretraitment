import tkseem as tk
import csv

# initialize the tokenizer
tokenizer = tk.WordTokenizer()
tokenizer.train('data.txt')
# open the csv file and read the text data
with open('../uploads/tweets-ar.csv', mode='r', encoding='utf-8') as csv_file:
    csv_reader = csv.reader(csv_file)
    for row in csv_reader:
        text = row[0]
        # tokenize the text using tkseem
        tokens = tokenizer.tokenize(text)
        print(tokens)
