# Importar bibliotecas necessárias
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns

# Carregar dados fictícios
data = {
    'feature1': [5, 2, 1, 4, 5, 1, 3, 2, 4, 5],
    'feature2': [3, 1, 4, 2, 5, 1, 3, 4, 2, 5],
    'feature3': [4, 3, 2, 5, 4, 2, 1, 3, 5, 4],
    'stars': [5, 2, 1, 4, 5, 1, 3, 2, 4, 5]
}

df = pd.DataFrame(data)

# 1. Descrever os dados utilizando estatísticas básicas
print("Descrição dos dados:")
print(df.describe())

# 2. Visualização dos dados
# Histogramas
plt.figure(figsize=(12, 6))
for i, column in enumerate(df.columns[:-1]):
    plt.subplot(1, 3, i+1)
    sns.histplot(df[column], kde=True)
    plt.title(f'Histograma de {column}')
plt.tight_layout()
plt.show()

# Boxplots
plt.figure(figsize=(12, 6))
for i, column in enumerate(df.columns[:-1]):
    plt.subplot(1, 3, i+1)
    sns.boxplot(y=df[column])
    plt.title(f'Boxplot de {column}')
plt.tight_layout()
plt.show()

# Scatter plot matrix
sns.pairplot(df, hue='stars', palette='viridis')
plt.show()

# 3. Identificação de padrões e tendências
# Correlação entre as variáveis
print("Matriz de correlação:")
print(df.corr())

sns.heatmap(df.corr(), annot=True, cmap='coolwarm', linewidths=0.5)
plt.title('Heatmap de Correlação')
plt.show()
