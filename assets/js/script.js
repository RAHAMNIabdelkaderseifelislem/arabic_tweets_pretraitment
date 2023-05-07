// functions to show data in the tables
function showData() {
    document.getElementById("original_tweets").style.display = "block";
    document.getElementById("processed_tweets").style.display = "block";
    document.getElementById("tokenized_tweets").style.display = "block";
    document.getElementById("arabic_sentiment").style.display = "block";
    document.getElementById("arabic_sentiment_words").style.display = "block";
    document.getElementById("showDataButton").style.display = "none";
    document.getElementById("hideDataButton").style.display = "block";
    document.getElementById("showOriginalTweetsButton").style.display = "none";
    document.getElementById("hideOriginalTweetsButton").style.display = "block";
    document.getElementById("showProcessedTweetsButton").style.display = "none";
    document.getElementById("hideProcessedTweetsButton").style.display = "block";
    document.getElementById("showTokenizedTweetsButton").style.display = "none";
    document.getElementById("hideTokenizedTweetsButton").style.display = "block";
    document.getElementById("showArabicSentimentButton").style.display = "none";
    document.getElementById("hideArabicSentimentButton").style.display = "block";
    document.getElementById("showArabicSentimentWordsButton").style.display = "none";
    document.getElementById("hideArabicSentimentWordsButton").style.display = "block";
}
function showOriginalTweets() {
    // check if the other tables are displayed or not
    var x = document.getElementById("processed_tweets").style.display ;
    var y = document.getElementById("tokenized_tweets").style.display ;
    var z = document.getElementById("arabic_sentiment").style.display ;
    var w = document.getElementById("arabic_sentiment_words").style.display ;
    if (x == "block" && y == "block" && z == "block" && w == "block") {
        document.getElementById("showDataButton").style.display = "none";
        document.getElementById("hideDataButton").style.display = "block";
    }
    document.getElementById("original_tweets").style.display = "block";
    document.getElementById("showOriginalTweetsButton").style.display = "none";
    document.getElementById("hideOriginalTweetsButton").style.display = "block";
}
function showProcessedTweets() {
    // check if the other tables are displayed or not
    var x = document.getElementById("original_tweets").style.display ;
    var y = document.getElementById("tokenized_tweets").style.display ;
    var z = document.getElementById("arabic_sentiment").style.display ;
    var w = document.getElementById("arabic_sentiment_words").style.display ;
    if (x == "block" && y == "block" && z == "block" && w == "block") {
        document.getElementById("showDataButton").style.display = "none";
        document.getElementById("hideDataButton").style.display = "block";
    }
    document.getElementById("processed_tweets").style.display = "block";
    document.getElementById("showProcessedTweetsButton").style.display = "none";
    document.getElementById("hideProcessedTweetsButton").style.display = "block";
}
function showTokenizedTweets() {
    // check if the other tables are displayed or not
    var x = document.getElementById("original_tweets").style.display ;
    var y = document.getElementById("processed_tweets").style.display ;
    var z = document.getElementById("arabic_sentiment").style.display ;
    var w = document.getElementById("arabic_sentiment_words").style.display ;
    if (x == "block" && y == "block" && z == "block" && w == "block") {
        document.getElementById("showDataButton").style.display = "none";
        document.getElementById("hideDataButton").style.display = "block";
    }
    document.getElementById("tokenized_tweets").style.display = "block";
    document.getElementById("showTokenizedTweetsButton").style.display = "none";
    document.getElementById("hideTokenizedTweetsButton").style.display = "block";
}
function showArabicSentiment() {
    // check if the other tables are displayed or not
    var x = document.getElementById("original_tweets").style.display ;
    var y = document.getElementById("processed_tweets").style.display ;
    var z = document.getElementById("tokenized_tweets").style.display ;
    var w = document.getElementById("arabic_sentiment_words").style.display ;
    if (x == "block" && y == "block" && z == "block" && w == "block") {
        document.getElementById("showDataButton").style.display = "none";
        document.getElementById("hideDataButton").style.display = "block";
    }
    document.getElementById("arabic_sentiment").style.display = "block";
    document.getElementById("showArabicSentimentButton").style.display = "none";
    document.getElementById("hideArabicSentimentButton").style.display = "block";
}
function showArabicSentimentWords(){
    var x = document.getElementById("original_tweets").style.display ;
    var y = document.getElementById("processed_tweets").style.display ;
    var z = document.getElementById("tokenized_tweets").style.display ;
    var w = document.getElementById("arabic_sentiment").style.display ;
    if (x == "block" && y == "block" && z == "block" && w == "block") {
        document.getElementById("showDataButton").style.display = "none";
        document.getElementById("hideDataButton").style.display = "block";
    }
    document.getElementById("arabic_sentiment_words").style.display = "block";
    document.getElementById("showArabicSentimentWordsButton").style.display = "none";
    document.getElementById("hideArabicSentimentWordsButton").style.display = "block";
}
// function to hide the tables
function hideData() {
    document.getElementById("original_tweets").style.display = "none";
    document.getElementById("processed_tweets").style.display = "none";
    document.getElementById("tokenized_tweets").style.display = "none";
    document.getElementById("arabic_sentiment").style.display = "none";
    document.getElementById("arabic_sentiment_words").style.display = "none";
    document.getElementById("showDataButton").style.display = "block";
    document.getElementById("hideDataButton").style.display = "none";
    document.getElementById("showOriginalTweetsButton").style.display = "block";
    document.getElementById("hideOriginalTweetsButton").style.display = "none";
    document.getElementById("showProcessedTweetsButton").style.display = "block";
    document.getElementById("hideProcessedTweetsButton").style.display = "none";
    document.getElementById("showTokenizedTweetsButton").style.display = "block";
    document.getElementById("hideTokenizedTweetsButton").style.display = "none";
    document.getElementById("showArabicSentimentButton").style.display = "block";
    document.getElementById("hideArabicSentimentButton").style.display = "none";
    document.getElementById("showArabicSentimentWordsButton").style.display = "block";
    document.getElementById("hideArabicSentimentWordsButton").style.display = "none";
}
function hideOriginalTweets() {
    //check if the other tables are hidden or not
    var x = document.getElementById("processed_tweets").style.display ;
    var y = document.getElementById("tokenized_tweets").style.display ;
    var z = document.getElementById("arabic_sentiment").style.display ;
    if (x == "none" && y == "none" && z == "none") {
        document.getElementById("showDataButton").style.display = "block";
        document.getElementById("hideDataButton").style.display = "none";
    }
    document.getElementById("original_tweets").style.display = "none";
    document.getElementById("showOriginalTweetsButton").style.display = "block";
    document.getElementById("hideOriginalTweetsButton").style.display = "none";
}
function hideProcessedTweets() {
    //check if the other tables are hidden or not
    var x = document.getElementById("original_tweets").style.display ;
    var y = document.getElementById("tokenized_tweets").style.display;
    var z = document.getElementById("arabic_sentiment").style.display;
    if (x == "none" && y == "none" && z == "none") {
        document.getElementById("showDataButton").style.display = "block";
        document.getElementById("hideDataButton").style.display = "none";
    }
    document.getElementById("processed_tweets").style.display = "none";
    document.getElementById("showProcessedTweetsButton").style.display = "block";
    document.getElementById("hideProcessedTweetsButton").style.display = "none";
}
function hideTokenizedTweets() {
    //check if the other tables are hidden or not
    var x = document.getElementById("original_tweets").style.display ;
    var y = document.getElementById("processed_tweets").style.display ;
    var z = document.getElementById("arabic_sentiment").style.display ;
    if (x == "none" && y == "none" && z == "none") {
        document.getElementById("showDataButton").style.display = "block";
        document.getElementById("hideDataButton").style.display = "none";
    }
    document.getElementById("tokenized_tweets").style.display = "none";
    document.getElementById("showTokenizedTweetsButton").style.display = "block";
    document.getElementById("hideTokenizedTweetsButton").style.display = "none";
}
function hideArabicSentiment() {
    //check if the other tables are hidden or not
    var x = document.getElementById("original_tweets").style.display ;
    var y = document.getElementById("processed_tweets").style.display ;
    var z = document.getElementById("tokenized_tweets").style.display ;
    if (x == "none" && y == "none" && z == "none") {
        document.getElementById("showDataButton").style.display = "block";
        document.getElementById("hideDataButton").style.display = "none";
    }
    document.getElementById("arabic_sentiment").style.display = "none";
    document.getElementById("showArabicSentimentButton").style.display = "block";
    document.getElementById("hideArabicSentimentButton").style.display = "none";
}
function hideArabicSentimentWords() {
    //check if the other tables are hidden or not
    var x = document.getElementById("original_tweets").style.display ;
    var y = document.getElementById("processed_tweets").style.display ;
    var z = document.getElementById("tokenized_tweets").style.display ;
    var w = document.getElementById("arabic_sentiment").style.display ;
    if (x == "none" && y == "none" && z == "none" && w == "none") {
      document.getElementById("showDataButton").style.display = "block";
      document.getElementById("hideDataButton").style.display = "none";
    }
    document.getElementById("arabic_sentiment_words").style.display = "none";
    document.getElementById("showArabicSentimentWordsButton").style.display = "block";
    document.getElementById("hideArabicSentimentWordsButton").style.display = "none";
}

function showGraphs() {
    document.getElementById("numWords").style.display = "block";
    document.getElementById("pieChart").style.display = "block";
    document.getElementById("barProbabilitiesChart").style.display = "block";
    document.getElementById("showGraphsButton").style.display = "none";
    document.getElementById("hideGraphsButton").style.display = "block";
    document.getElementById("showNumWordsButton").style.display = "none";
    document.getElementById("hideNumWordsButton").style.display = "block";
    document.getElementById("showPieSentimentButton").style.display = "none";
    document.getElementById("hidePieSentimentButton").style.display = "block";
    document.getElementById("showProbabilitiesButton").style.display = "none";
    document.getElementById("hideProbabilitiesButton").style.display = "block";
}

function hideGraphs() {
    document.getElementById("showGraphsButton").style.display = "block";
    document.getElementById("hideGraphsButton").style.display = "none";
    document.getElementById("numWords").style.display = "none";
    document.getElementById("pieChart").style.display = "none";
    document.getElementById("barProbabilitiesChart").style.display = "none";
    document.getElementById("showNumWordsButton").style.display = "block";
    document.getElementById("hideNumWordsButton").style.display = "none";
    document.getElementById("showPieSentimentButton").style.display = "block";
    document.getElementById("hidePieSentimentButton").style.display = "none";
    document.getElementById("showProbabilitiesButton").style.display = "block";
    document.getElementById("hideProbabilitiesButton").style.display = "none";
}

function showNumWords() {
  var y = document.getElementById("pieChart").style.display;
  var z = document.getElementById("barProbabilitiesChart").style.display;
  //check if the other charts are hidden or not
  if (y == "block" && z == "block") {
    document.getElementById("showGraphsButton").style.display = "none";
    document.getElementById("hideGraphsButton").style.display = "block";
  }
    document.getElementById("numWords").style.display = "block";
    document.getElementById("showNumWordsButton").style.display = "none";
    document.getElementById("hideNumWordsButton").style.display = "block";
}

function hideNumWords() {
  var y = document.getElementById("pieChart").style.display;
  var z = document.getElementById("barProbabilitiesChart").style.display;
  //check if the other charts are hidden or not
  if (y == "none" && z == "none") {
    document.getElementById("showGraphsButton").style.display = "block";
    document.getElementById("hideGraphsButton").style.display = "none";
  }
    document.getElementById("numWords").style.display = "none";
    document.getElementById("showNumWordsButton").style.display = "block";
    document.getElementById("hideNumWordsButton").style.display = "none";
}

function showPieSentiment() {
  var y = document.getElementById("barChart").style.display;
  var z = document.getElementById("barProbabilitiesChart").style.display;
  //check if the other charts are hidden or not
  if (y == "block" && z == "block") {
    document.getElementById("showGraphsButton").style.display = "none";
    document.getElementById("hideGraphsButton").style.display = "block";
  }
    document.getElementById("pieSentiment").style.display = "block";
    document.getElementById("showPieSentimentButton").style.display = "none";
    document.getElementById("hidePieSentimentButton").style.display = "block";
}

function hidePieSentiment() {
  var y = document.getElementById("barChart").style.display;
  var z = document.getElementById("barProbabilitiesChart").style.display;
  //check if the other charts are hidden or not
  if (y == "none" && z == "none") {
    document.getElementById("showGraphsButton").style.display = "block";
    document.getElementById("hideGraphsButton").style.display = "none";
  }
    document.getElementById("pieSentiment").style.display = "none";
    document.getElementById("showPieSentimentButton").style.display = "block";
    document.getElementById("hidePieSentimentButton").style.display = "none";
}

function showProbabilities() {
  var y = document.getElementById("barChart").style.display;
  var z = document.getElementById("pieChart").style.display;
  //check if the other charts are hidden or not
  if (y == "block" && z == "block") {
    document.getElementById("showGraphsButton").style.display = "none";
    document.getElementById("hideGraphsButton").style.display = "block";
  }
    document.getElementById("probabilities").style.display = "block";
    document.getElementById("showProbabilitiesButton").style.display = "none";
    document.getElementById("hideProbabilitiesButton").style.display = "block";
}

function hideProbabilities() {
  var y = document.getElementById("barChart").style.display;
  var z = document.getElementById("pieChart").style.display;
  //check if the other charts are hidden or not
  if (y == "none" && z == "none") {
    document.getElementById("showGraphsButton").style.display = "block";
    document.getElementById("hideGraphsButton").style.display = "none";
  }
    document.getElementById("probabilities").style.display = "none";
    document.getElementById("showProbabilitiesButton").style.display = "block";
    document.getElementById("hideProbabilitiesButton").style.display = "none";
}

// delete button function
function deletefunc(){
  // message to confirm deletion
  var r = confirm("هل أنت متأكد من حذف البيانات؟");
  if (r == true) {
    location.href="index.php";
  }
}

// drag and drop
let uploadButton = document.getElementById("upload-button");
let chosenImage = document.getElementById("chosen-image");
let fileName = document.getElementById("file-name");
let error = document.getElementById("error");
let imageDisplay = document.getElementById("image-display");

const fileHandler = (file, name, type) => {
  if (type.split("/")[0] !== "csv") {
    //File Type Error
    error.innerText = "يرجى تحميل ملف بتنسيق .csv";
    return false;
  }
  error.innerText = "";
  let reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onloadend = () => {
    //image and file name
    let imageContainer = document.createElement("figure");
    let img = document.createElement("img");
    img.src = reader.result;
    imageContainer.appendChild(img);
    imageContainer.innerHTML += `<figcaption>${name}</figcaption>`;
    imageDisplay.appendChild(imageContainer);
  };
};

//Upload Button
uploadButton.addEventListener("change", () => {
  imageDisplay.innerHTML = "";
  Array.from(uploadButton.files).forEach((file) => {
    fileHandler(file, file.name, file.type);
  });
});

container.addEventListener(
  "dragenter",
  (e) => {
    e.preventDefault();
    e.stopPropagation();
    container.classList.add("active");
  },
  false
);

container.addEventListener(
  "dragleave",
  (e) => {
    e.preventDefault();
    e.stopPropagation();
    container.classList.remove("active");
  },
  false
);

container.addEventListener(
  "dragover",
  (e) => {
    e.preventDefault();
    e.stopPropagation();
    container.classList.add("active");
  },
  false
);

container.addEventListener(
  "drop",
  (e) => {
    e.preventDefault();
    e.stopPropagation();
    container.classList.remove("active");
    let draggedData = e.dataTransfer;
    let files = draggedData.files;
    imageDisplay.innerHTML = "";
    Array.from(files).forEach((file) => {
      fileHandler(file, file.name, file.type);
    });
  },
  false
);

window.onload = () => {
  error.innerText = "";
};