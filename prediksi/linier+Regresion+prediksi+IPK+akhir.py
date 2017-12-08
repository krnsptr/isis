
# coding: utf-8

# In[5]:


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


# In[12]:


#import library
import pandas as pdd
import matplotlib.pyplot as plt
import seaborn as sns
import numpy as np
from scipy.stats import norm
from sklearn.preprocessing import StandardScaler
from scipy import stats
import warnings
warnings.filterwarnings('ignore')
get_ipython().magic('matplotlib inline')


# In[8]:


df_train= pd.read_excel('MPPLPRED.xlsx')


# In[11]:


df_train['NilaiIPKAkhir'].describe()


# In[14]:


sns.distplot(df_train['NilaiIPKAkhir']);


# In[19]:


#skewness and kurtosis
print("Skewness: %f" % df_train['NilaiIPKAkhir'].skew())
print("Kurtosis: %f" % df_train['NilaiIPKAkhir'].kurt())


# In[21]:


df_trainf = pd.get_dummies(df_train)
df_trainf


# In[26]:


Y = df_trainf["NilaiIPKAkhir"]
X = df_trainf.drop("NilaiIPKAkhir", 1)


# In[28]:


from sklearn.model_selection import train_test_split
X_train, X_test, Y_train, Y_test = train_test_split(
  X,
  Y,
  test_size=0.4,
  random_state = 42 )


# In[29]:


from sklearn import metrics
from sklearn.linear_model import LinearRegression
from sklearn.linear_model import Ridge
from sklearn.linear_model import Lasso
from sklearn.linear_model import RANSACRegressor
from sklearn.ensemble import RandomForestRegressor
from sklearn.tree import DecisionTreeRegressor


classifiers = [
    LinearRegression()
    
    ]

for clf in classifiers:
    clf.fit(X_train, Y_train)
    name = clf.__class__.__name__
    
    print("="*30)
    print(name)
    
    print('****Results****')
    train_predictions = clf.predict(X_test)
    rmse = np.sqrt( metrics.mean_squared_error( Y_test, train_predictions ) )
    print("RMSE: {}".format(rmse))
    print('Koefisien: \n', clf.coef_)
    print('Intercept: \n', clf.intercept_)
   
    
print("="*30)

