from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import mean_squared_error, accuracy_score, classification_report
from descritiva import df

# Separar as características (X) e o alvo (y)
X = df.drop('stars', axis=1)
y = df['stars']

# Dividir os dados em conjuntos de treino e teste
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# 1. Regressão Linear para prever uma das características com base nas outras
lin_reg = LinearRegression()
lin_reg.fit(X_train, y_train)

y_pred_lin_reg = lin_reg.predict(X_test)
mse = mean_squared_error(y_test, y_pred_lin_reg)
print(f"Erro Quadrático Médio da Regressão Linear: {mse}")

# 2. Classificação utilizando RandomForestClassifier
clf = RandomForestClassifier(n_estimators=100, random_state=42)
clf.fit(X_train, y_train)

y_pred_clf = clf.predict(X_test)
accuracy = accuracy_score(y_test, y_pred_clf)
print(f"Acurácia do RandomForestClassifier: {accuracy}")
print("Relatório de Classificação do RandomForestClassifier:\n", classification_report(y_test, y_pred_clf))

# 3. Comparação de Modelos
print(f"Erro Quadrático Médio da Regressão Linear: {mse}")
print(f"Acurácia do RandomForestClassifier: {accuracy}")
