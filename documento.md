Projeto de Ciência de Dados
Entrega 1: Análise Descritiva dos Dados
Objetivo
O objetivo desta entrega é utilizar técnicas estatísticas básicas para descrever os dados, visualizá-los e identificar padrões e tendências.

Bibliotecas Utilizadas
Para esta etapa, utilizamos as seguintes bibliotecas:

pandas para manipulação de dados.
matplotlib e seaborn para visualização de dados.
Explicação do Código
Importação de Bibliotecas: Inicialmente, importamos pandas para manipulação de dados, matplotlib.pyplot para criação de gráficos e seaborn para visualização estatística.

Carregamento dos Dados: Definimos um conjunto de dados fictícios contendo três características (feature1, feature2, feature3) e uma variável alvo (stars). Esses dados são carregados em um DataFrame do pandas.

Descrição dos Dados: Utilizamos o método describe do pandas para gerar estatísticas descritivas dos dados, como média, desvio padrão, mínimo e máximo.

Visualização dos Dados:

Histogramas: Criamos histogramas para cada uma das características, utilizando seaborn.histplot para visualizar a distribuição dos dados.
Boxplots: Geramos boxplots para cada característica usando seaborn.boxplot, ajudando a identificar outliers e a distribuição dos dados.
Scatter Plot Matrix: Utilizamos seaborn.pairplot para criar uma matriz de gráficos de dispersão, o que permite visualizar as relações entre as características, com a variável stars utilizada para colorir os pontos.
Identificação de Padrões e Tendências:

Matriz de Correlação: Calculamos a matriz de correlação entre as características usando pandas e visualizamos essa matriz com um heatmap usando seaborn.heatmap. Essa análise ajuda a identificar relações lineares entre as variáveis.
Entrega 2: Modelagem Estatística
Objetivo
O objetivo desta entrega é aplicar técnicas estatísticas avançadas para modelagem dos dados, treinar modelos preditivos e comparar diferentes abordagens de análise preditiva.

Bibliotecas Utilizadas
Para esta etapa, utilizamos as seguintes bibliotecas:

pandas para manipulação de dados.
scikit-learn (sklearn.model_selection, sklearn.linear_model, sklearn.ensemble, sklearn.metrics) para construção e avaliação de modelos preditivos.
Explicação do Código
Importação de Bibliotecas: Importamos módulos específicos do scikit-learn para separação dos dados, criação de modelos de regressão linear e de classificação, e para avaliação dos modelos.

Separação das Características e Alvo: Separamos as características (feature1, feature2, feature3) da variável alvo (stars) no DataFrame.

Divisão dos Dados: Utilizamos train_test_split do scikit-learn para dividir os dados em conjuntos de treino e teste. Esta etapa é crucial para validar a performance dos modelos.

Modelagem:

Regressão Linear: Treinamos um modelo de regressão linear (LinearRegression) para prever a variável alvo com base nas características. Avaliamos a performance do modelo usando o Erro Quadrático Médio (mean_squared_error).
Classificação com RandomForest: Treinamos um classificador de Random Forest (RandomForestClassifier) para prever a variável alvo. Avaliamos a performance do modelo utilizando a acurácia (accuracy_score) e geramos um relatório de classificação (classification_report).
Comparação de Modelos: Comparamos a performance dos dois modelos utilizando as métricas mencionadas acima. Esta comparação ajuda a entender qual modelo é mais eficaz para o conjunto de dados específico.

Instruções de Execução
1. Instalar Dependências
Execute o comando abaixo para instalar todas as bibliotecas necessárias:

pip install pandas matplotlib seaborn scikit-learn


2. Executar o Código
Copie e cole o código das respectivas seções em um ambiente Python (como Jupyter Notebook ou um script Python) e execute as células em ordem.

3. Analisar os Resultados
Observe as saídas geradas pelas execuções do código, incluindo descrições estatísticas, visualizações, métricas de modelo e relatórios de classificação.

Estrutura do Projeto
descritiva.py: Contém a análise descritiva dos dados.
modelagem.py: Contém a modelagem estatística e a comparação de modelos.
Contribuições
Contribuições são bem-vindas! Sinta-se à vontade para abrir um issue ou enviar um pull request.

Licença
Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.