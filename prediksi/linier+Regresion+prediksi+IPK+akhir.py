
# coding: utf-8

# In[1]:


#import library
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
import numpy as np
from scipy.stats import norm
from sklearn.preprocessing import StandardScaler
from scipy import stats
import warnings
warnings.filterwarnings('ignore')
get_ipython().magic('matplotlib inline')




# In[51]:


df= pd.read_excel('MPPLPRED.xlsx')


# In[52]:


pr = pd.read_excel('PRD.xlsx')


# In[53]:


df = df.drop(['RESP','NIM','Nama','L/P','IPB112','No','Jalur'], axis=1)
pr = pr.drop(['RESP','NIM','Nama','L/P','IPB112','No','Jalur','NilaiIPKAkhir'], axis=1)


# In[55]:


df


# In[56]:


arrayKey= {"A":4, "AB":3.5 , "B":3, "BC":2.5, "C":2, "D":1, "E":0}

list1=["AGB100","BIO101","EKO100","FIS100","IPB100","IPB106","IPB107","IPB108","IPB111","KIM100","KOM101","KOM201","KPM130","MAT100","MAT103"]
lenCol=len(list1)
lenRow=df['AGB100'].count()


# In[57]:


for i in range(0,lenCol):
    for j in range(0,lenRow):
        df[list1[i]][j]=arrayKey[df[list1[i]][j]]


# In[58]:


arrayKey= {"A":4, "AB":3.5 , "B":3, "BC":2.5, "C":2, "D":1, "E":0}

list1=["AGB100","BIO101","EKO100","FIS100","IPB100","IPB106","IPB107","IPB108","IPB111","KIM100","KOM101","KOM201","KPM130","MAT100","MAT103"]
lenColP=len(list1)
lenRowP=pr['AGB100'].count()


# In[59]:


for i in range(0,lenColP):
    for j in range(0,lenRowP):
        pr[list1[i]][j]=arrayKey[pr[list1[i]][j]]


# In[62]:


Y = df["NilaiIPKAkhir"]
X = df.drop("NilaiIPKAkhir", 1)


# In[64]:


from sklearn import metrics
from sklearn.linear_model import LinearRegression


# In[66]:


clasifier= LinearRegression()


# In[68]:


model= clasifier.fit(X,Y)


# In[69]:


model


# In[70]:


hasil_prediksi = model.predict(pr)

