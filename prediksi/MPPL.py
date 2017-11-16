
# coding: utf-8

# In[33]:


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


# In[34]:


df_train= pd.read_excel('MPPL.xls')


# In[35]:


df_train.info()


# In[36]:


#menghapus colom yang tidak diperlukan

df = df_train.drop(['RESP','NIM','Nama','L/P','IPB112'], axis=1)
df.info()


# In[37]:


sns.factorplot('IPK','EKO100', data=df,size=4,aspect=4) #pengaruh IPK terhadap nilai ekonomi


# In[38]:


sns.factorplot('IPK','FIS100', data=df,size=4,aspect=4) #pengaruh IPK terhadap matematika


# In[39]:


sns.factorplot('IPK','KOM101', data=df,size=4,aspect=4) #pengaruh IPK terhadap matematika


# In[25]:



sns.factorplot('IPK','KOM201', data=df,size=4,aspect=4) #pengaruh IPK terhadap matematika


# In[41]:


sns.factorplot('IPK','MAT100', data=df,size=4,aspect=4) #pengaruh IPK terhadap matematika


# In[42]:


sns.factorplot('IPK','MAT103', data=df,size=4,aspect=4) #pengaruh IPK terhadap matematika


# In[44]:


df['CLASS'].describe()


# In[121]:


y=df['CLASS']
x=df.drop(['CLASS'],1)
x.info()


# In[122]:


arrayKey= {"A":4, "AB":3.5 , "B":3, "BC":2.5, "C":2, "D":1, "E":0}
x['AGB100'].count()
list1=["AGB100","BIO101","EKO100","FIS100","IPB100","IPB106","IPB107","IPB108","IPB111","KIM100","KOM101","KOM201","KPM130","MAT100","MAT103"]
len(list1)


# In[123]:


for i in range(0,15):
    for j in range(0,96):
        x[list1[i]][j]=arrayKey[x[list1[i]][j]]


# In[124]:


x


# In[127]:


x = x.drop(['Jalur','No'], axis=1)


# In[128]:


from sklearn.cross_validation import cross_val_score
from sklearn.ensemble import RandomForestClassifier


# In[134]:


DTC=RandomForestClassifier(random_state=123)
a=cross_val_score(DTC,x,y,cv=10)


# In[136]:


a.mean()

