import numpy as np
import pandas as pd
from sklearn.model_selection import train_test_split, GridSearchCV, cross_val_score
from sklearn.linear_model import LogisticRegression
from sklearn.preprocessing import StandardScaler
from sklearn.pipeline import Pipeline
from sklearn.metrics import classification_report, roc_auc_score

# Chargement des données
data = pd.read_csv('votre_fichier.csv')
X = data.drop('target', axis=1)
y = data['target']

# Division des données
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Pipeline pour standardisation et régression logistique
pipeline = Pipeline([
    ('scaler', StandardScaler()),
    ('logreg', LogisticRegression())
])

# Paramètres pour la recherche sur grille
param_grid = {
    'logreg__C': [0.1, 1, 10, 100],
    'logreg__penalty': ['l1', 'l2'],
    'logreg__solver': ['liblinear']  # nécessaire pour L1
}

# Recherche sur grille avec validation croisée
grid_search = GridSearchCV(pipeline, param_grid, cv=5, scoring='roc_auc')
grid_search.fit(X_train, y_train)

# Meilleurs paramètres
print(f"Meilleurs paramètres : {grid_search.best_params_}")

# Performance du modèle
y_pred = grid_search.predict(X_test)
print(classification_report(y_test, y_pred))
print(f"AUC : {roc_auc_score(y_test, grid_search.predict_proba(X_test)[:, 1])}")
