import os
import sys
import json
import pandas as pd
import numpy as np
import warnings
import pickle

warnings.filterwarnings('ignore')
angkatan = sys.argv[1:][0]
directory = os.getcwd()
path = directory + '/public/uploads/prediksi/'
pr = pd.read_excel(path + angkatan + '.xlsx')
pr = pr.drop(['RESP','NIM','Nama','L/P','IPB112','No','Jalur'], axis=1)
arrayKey= {"A":4, "AB":3.5 , "B":3, "BC":2.5, "C":2, "D":1, "E":0}
list1=["AGB100","BIO101","EKO100","FIS100","IPB100","IPB106","IPB107","IPB108","IPB111","KIM100","KOM101","KOM201","KPM130","MAT100","MAT103"]
lenColP=len(list1)
lenRowP=pr['AGB100'].count()
for i in range(0,lenColP):
    for j in range(0,lenRowP):
        pr[list1[i]][j]=arrayKey[pr[list1[i]][j]]
filename= 'model-IPK.sav'
model= pickle.load(open(directory + '/controllers/' + filename, 'rb'))
hasil = model.predict(pr)
rerata = hasil.mean()
print(json.dumps(rerata))