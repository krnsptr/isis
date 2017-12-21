
# coding: utf-8

# In[4]:


# Imports

# pandas
import pandas as pd
from pandas import Series,DataFrame

# numpy, matplotlib, seaborn
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
sns.set_style('whitegrid')
get_ipython().magic('matplotlib inline')

# machine learning
from sklearn.linear_model import LogisticRegression
from sklearn.svm import SVC, LinearSVC
from sklearn.ensemble import RandomForestClassifier
from sklearn.neighbors import KNeighborsClassifier
from sklearn.naive_bayes import GaussianNB


# In[103]:


df_train= pd.read_excel('MPPL.xls')
prediksid=pd.read_excel('prediksi.xlsx')
df_train.shape


# In[104]:


prediksid.shape


# In[97]:


#df_train.info()


# In[105]:


#menghapus colom yang tidak diperlukan

df = df_train.drop(['RESP','NIM','Nama','L/P','IPB112'], axis=1)

df.shape


# In[106]:


prediksid=prediksid.drop(['RESP','NIM','Nama','L/P','IPB112'], axis=1)


# In[107]:


prediksid.shape


# In[95]:


#sns.distplot(df_train['IPK']);


# In[94]:


# #box plot overallqual/saleprice
# var = 'EKO100'
# data = pd.concat([df_train['IPK'], df_train[var]], axis=1)
# f, ax = plt.subplots(figsize=(8, 6))
# fig = sns.boxplot(x=var, y="IPK", data=data)
# fig.axis(ymin=0, ymax=4);


# In[93]:


#sns.factorplot('IPK','EKO100', data=df,size=4,aspect=4) #pengaruh IPK terhadap nilai ekonomi


# In[92]:


#sns.factorplot('IPK','FIS100', data=df,size=4,aspect=4) #pengaruh IPK terhadap matematika


# In[90]:


# var = 'KOM101'
# data = pd.concat([df_train['IPK'], df_train[var]], axis=1)
# f, ax = plt.subplots(figsize=(8, 6))
# fig = sns.boxplot(x=var, y="IPK", data=data)
# fig.axis(ymin=0, ymax=4);


# In[91]:



#sns.factorplot('IPK','KOM201', data=df,size=4,aspect=4) #pengaruh IPK terhadap matematika


# In[89]:


#sns.factorplot('IPK','MAT100', data=df,size=4,aspect=4) #pengaruh IPK terhadap matematika


# In[88]:


#sns.factorplot('IPK','MAT103', data=df,size=4,aspect=4) #pengaruh IPK terhadap matematika


# In[16]:


df['CLASS'].describe()


# In[17]:


y=df['CLASS']
x=df.drop(['CLASS'],1)
x.info()


# In[109]:


prediksid.info()


# In[111]:


for i in range(0,15):
    for j in range(0,17):
        prediksid[list1[i]][j]=arrayKey[prediksid[list1[i]][j]]


# In[110]:


arrayKey= {"A":4, "AB":3.5 , "B":3, "BC":2.5, "C":2, "D":1, "E":0}
prediksid['AGB100'].count()
list1=["AGB100","BIO101","EKO100","FIS100","IPB100","IPB106","IPB107","IPB108","IPB111","KIM100","KOM101","KOM201","KPM130","MAT100","MAT103"]
len(list1)
prediksid.shape


# In[83]:


arrayKey= {"A":4, "AB":3.5 , "B":3, "BC":2.5, "C":2, "D":1, "E":0}
x['AGB100'].count()
list1=["AGB100","BIO101","EKO100","FIS100","IPB100","IPB106","IPB107","IPB108","IPB111","KIM100","KOM101","KOM201","KPM130","MAT100","MAT103"]
len(list1)
x.shape


# In[112]:


prediksid.shape


# In[19]:


for i in range(0,15):
    for j in range(0,96):
        x[list1[i]][j]=arrayKey[x[list1[i]][j]]


# In[113]:


prediksid= prediksid.drop(['Jalur','No'], axis=1)


# In[26]:


x = x.drop(['Jalur','No'], axis=1)


# In[22]:


from sklearn.cross_validation import cross_val_score
from sklearn.ensemble import RandomForestClassifier


# In[29]:


RFC=RandomForestClassifier(random_state=123)
a=cross_val_score(RFC,x,y,cv=5)


# In[30]:


print(a)
print(a.mean())


# In[39]:


clf = RandomForestClassifier(random_state=123)
clf.fit(x, y)
x


# In[68]:


hasil=clf.predict(x)
hasil= pd.DataFrame(hasil)


# In[70]:


awal= df_train['CLASS']
awal= pd.DataFrame(awal)
awal['prediksi']= hasil


# In[115]:


PrediksiDatabaru= clf.predict(prediksid)
PrediksiDatabaru = pd.DataFrame(PrediksiDatabaru)


# In[116]:


PrediksiDatabaru

