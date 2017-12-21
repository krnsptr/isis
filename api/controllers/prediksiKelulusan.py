import sys
import os
import json
import pandas as pd
import numpy as np
import pickle
import warnings

warnings.filterwarnings('ignore')
angkatan = sys.argv[1:][0]
directory = os.getcwd()
path = directory + '/public/uploads/prediksi/'
prediksid = pd.read_excel(path + angkatan + '.xlsx')
prediksid = prediksid.drop(['No', 'RESP', 'NIM', 'Nama', 'L/P', 'Jalur', 'IPB112'], axis=1)
arrayKey = {"A":4, "AB":3.5 , "B":3, "BC":2.5, "C":2, "D":1, "E":0}
len1= prediksid['AGB100'].count()
list1=["AGB100","BIO101","EKO100","FIS100","IPB100","IPB106","IPB107","IPB108","IPB111","KIM100","KOM101","KOM201","KPM130","MAT100","MAT103"]
len2 = len(list1)
for i in range(0,len2):
    for j in range(0,len1):
        prediksid[list1[i]][j]=arrayKey[prediksid[list1[i]][j]]
filename= "model-kelulusan.sav"
model = pickle.load(open(directory + '/controllers/' + filename, 'rb'))
hasil=model.predict(prediksid)
list2=[]
list2= hasil
list2= np.array(list2)
lulusT=0
for i in range(0,len(list2)):
    if list2[i] == "YA":
        lulusT = 1 + lulusT
presentasi = (lulusT/len(list2)) * 100

hasil = {}
hasil['presentasi']=presentasi
# print(presentasi)
print(json.dumps(presentasi))