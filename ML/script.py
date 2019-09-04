from flask import Flask,json,request
import pickle
import re
from nltk.corpus import stopwords
from nltk.stem.porter import PorterStemmer
def formatHeadline(hl):
	hl=re.sub('[^a-zA-Z]',' ',hl)
	hl=hl.lower()
	hl=hl.split()
	ps=PorterStemmer()
	hl=[ps.stem(word) for word in hl if word not in set(stopwords.words('english'))]
	hl=' '.join(hl)
	return hl
response=['Negative','Positive']
pickle_in=open("Classifier.pickle",'rb')
classifier=pickle.load(pickle_in)
cv=pickle.load(pickle_in)

app = Flask(__name__)

@app.route('/predict',methods=['POST'])
def predict():
	r = request.get_json(force=True)
	new_review = r.get("review")
	new_review= formatHeadline(new_review)
	test_corpus = []
	test_corpus.append(new_review)
	X_new_test = cv.transform(test_corpus).toarray()
	prediction=classifier.predict(X_new_test)
	prediction = response[(classifier.predict(X_new_test)[0])]
	return prediction

app.run(debug=True)
