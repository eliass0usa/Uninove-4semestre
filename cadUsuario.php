<?php
  include ("proteger.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tech Mechanical</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js" integrity="sha512-6DC1eE3AWg1bgitkoaRM1lhY98PxbMIbhgYCGV107aZlyzzvaWCW1nJW2vDuYQm06hXrW0As6OGKcIaAVWnHJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>

        .modal-all-requests {
            display: none; /*display: flex; */
            align-items: center;
            background: #00000094;
            justify-content: center;
            position: fixed;
            width: 100%;
            height: 100%;
        }

        .custom-loader {
            width:50px;
            height:50px;
            border-radius:50%;
            background:conic-gradient(#0000 10%,#0d6efd);
            -webkit-mask:radial-gradient(farthest-side,#0000 calc(100% - 8px),#000 0);
            animation:s3 1s infinite linear;
            }
            @keyframes s3 {to{transform: rotate(1turn)}}
    </style>
    <script>

      function limpar(){
        document.querySelector("#id").value  = "";
        document.querySelector("#nome").value  = "";
        document.querySelector("#email").value = "";
        document.querySelector("#senha").value = "";

        document.querySelector("#titulo").innerHTML = "Cadastrar usuário";
      }

      function limparCarro(){
        document.getElementById('placaCarro').value  = "";
        document.getElementById('marcaCarro').value  = "";
        document.getElementById('modeloCarro').value  = "";
        document.getElementById('tipoCarro').value  = "";
      }
      function limparHistorico(){
        document.getElementById('idHistorico').value  = "";
        document.getElementById('mecanicoResponsavel').value  = "";
        document.getElementById('pecasCompradas').value  = "";
        document.getElementById('validade-garantia').value  = "";
        document.getElementById('valor-cobrado').value  = "";
        document.getElementById('data-servico').value  = "";
      }

      function excluir(id){
        var json  = {};
        json.id   = id;
        json.acao = "delete";

        document.querySelector('.modal-all-requests').style.display = "flex";

        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
              exibir_mensagem("Resultado da solicitação", resp);
              consultar();

              document.querySelector('.modal-all-requests').style.display = "none";
          }
        });
      }

      function excluirVeiculo(id){
        var json  = {};
        json.id   = id;
        json.acao = "deleteVeiculo";

        document.querySelector('.modal-all-requests').style.display = "flex";

        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
              exibir_mensagem("Resultado da solicitação", resp);
              consultar();
              document.querySelector('.modal-all-requests').style.display = "none";
          }
        });
      }

      function excluirHistorico ( id , placa) {
        var json  = {};
        json.id   = id;
        json.acao = "deleteHistorico";

        document.querySelector('.modal-all-requests').style.display = "flex";
        
        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
              exibir_mensagem("Resultado da solicitação", resp);

              historico(placa)

              document.querySelector('.modal-all-requests').style.display = "none";
          }
        });

        
      }

      function editarVeiculo(id){
        const placaInput = document.getElementById('placaCarro')
        const marcaInput = document.getElementById('marcaCarro')
        const modeloInput = document.getElementById('modeloCarro')
        const tipoInput = document.getElementById('tipoCarro')

        var json = {};
        json.id  = id;
        json.acao  = "selectCar";

        document.querySelector('.modal-all-requests').style.display = "flex";

        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
            var linhas = JSON.parse(resp);

            for (i=0;i<linhas.length;i++){
              var placa = linhas[i].placa;
              var fabricante = linhas[i].fabricante;
              var modelo = linhas[i].modelo;
              var tipo = linhas[i].tipo;

            }
            placaInput.value = placa
            marcaInput.value = fabricante
            modeloInput.value = modelo
            tipoInput.value = tipo


            document.querySelector('.modal-all-requests').style.display = "none";
          }
        });

      }

      


      function inserir(){
        let select = document.getElementById('idUsuario')
        

        var json = {};

        document.querySelector('.modal-all-requests').style.display = "flex";

        json.nome  = document.querySelector("#nome").value;
        json.email = document.querySelector("#email").value;
        json.senha = document.querySelector("#senha").value;

        json.id    = document.querySelector("#id").value;

        if (json.id==""){
          json.acao  = "insert";
        }else{
          json.acao  = "update";
        }


        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
              exibir_mensagem("Resultado da solicitação", resp);
              consultar();

              document.querySelector('.modal-all-requests').style.display = "none";
          }
        });
      }

      function inserirCarro(){
        var json = {};

        document.querySelector('.modal-all-requests').style.display = "flex";

        if ( document.querySelector("#placaCarro").value == '' || document.querySelector("#marcaCarro").value == '' ||  document.querySelector("#modeloCarro").value == '' || document.querySelector("#tipoCarro").value == '') {
            alert('Preencha todos os campos para enviar com sucesso!')
        } else {
            json.id  = document.querySelector('#idUsuario').value
            json.placa  = document.querySelector("#placaCarro").value;
            json.marca = document.querySelector("#marcaCarro").value;
            json.modelo = document.querySelector("#modeloCarro").value;
            json.tipo = document.querySelector("#tipoCarro").value;

            json.acao  = "insertCarro";

            $.ajax({
            url : "usuarioDAO.php",
            data: json,
            type: "post",
            success: function (resp){
                exibir_mensagem("Resultado da solicitação", resp);
                consultar();

                document.querySelector('.modal-all-requests').style.display = "none";
            }
            });
        }
      }

      function editar(id, nome, email){
        document.querySelector("#id").value    = id;
        document.querySelector("#nome").value  = nome;
        document.querySelector("#email").value = email;
        document.querySelector("#senha").value = "";

        document.querySelector("#titulo").innerHTML   = "Alterar usuário";

      }



      function editarHistorico ( id,id_veiculo_placa, usuario_id, nomeProprietario , mecanico_responsavel,pecas_compradas,validade_garantia, valor_cobrado,data_servico) {
 

        document.getElementById('idHistorico').value = id

        
        let veiculoSelecionado = document.getElementById('veiculosUsuarioSelecionado')
        
        
        Array.from(idUsuario2.options).forEach( (el, index) => {
          let value = el.value
          
          if ( value == usuario_id ) {
            idUsuario2.options[idUsuario2.selectedIndex].click()
            idUsuario2.selectedIndex = index

          }
        })

        Array.from(veiculoSelecionado.options).forEach( (el, index) => {
          let value = el.value
          
          if ( value == id_veiculo_placa ) {
            veiculoSelecionado.options[veiculoSelecionado.selectedIndex].click()
            veiculoSelecionado.selectedIndex = index
          }
        })

        document.getElementById('mecanicoResponsavel').value = mecanico_responsavel
        document.getElementById('pecasCompradas').value = pecas_compradas
        document.getElementById('validade-garantia').value = validade_garantia
        document.getElementById('valor-cobrado').value = valor_cobrado
        document.getElementById('data-servico').value = data_servico

      }

      function historico(id){
        var json  = {};
        json.id   = id;
        json.acao = "historico";
        
        document.querySelector('.modal-all-requests').style.display = "flex";

        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
            console.log('response: ', resp)
            
            var linhas = JSON.parse(resp);

            document.querySelector("#corpoTabelaHistorico").innerHTML = "";

            
            for (i=0;i<linhas.length;i++){


              var historico_id    = linhas[i].historico_id;
              var usuario_id    = linhas[i].usuario_id;
              var id_veiculo_placa  = linhas[i].id_carro_placa;
              var data_servico = linhas[i].data_servico;
              var valor_cobrado = linhas[i].valor_cobrado;
              var validade_garantia = linhas[i].validade_garantia;
              var mecanico_responsavel = linhas[i].mecanico_responsavel;
              var nomeProprietario = linhas[i].nome;
              var pecas_compradas = linhas[i].pecas_compradas;


              var linha = `<tr>
                  <td><button type="button" class="btn btn-outline-secondary" onclick="editarHistorico(${historico_id},${id_veiculo_placa}, ${usuario_id},'${nomeProprietario}','${mecanico_responsavel}','${pecas_compradas}','${validade_garantia}','${valor_cobrado}','${data_servico}')">Editar</button></td>
                  <td><button type="button" class="btn btn-outline-danger" onclick="excluirHistorico(${historico_id}, ${id_veiculo_placa})">Excluir</button></td>

                  <td>${historico_id}</td>
                  <td>${id_veiculo_placa}</td>
                  <td>${nomeProprietario}</td>
                  <td>${mecanico_responsavel}</td>
                  <td>${pecas_compradas}</td>
                  <td>${validade_garantia}</td>
                  <td>${valor_cobrado}</td>
                  <td>${data_servico}</td>
                </tr>`;

              document.querySelector("#corpoTabelaHistorico").innerHTML += linha;

            }
            document.querySelector('.modal-all-requests').style.display = "none";
          }
        });
      }

      function veiculo(id){
        var json  = {};
        json.id   = id;
        json.acao = "veiculo";

        document.querySelector('.modal-all-requests').style.display = "flex";

        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
            var linhas = JSON.parse(resp);
            document.querySelector("#corpoTabelaVeiculo").innerHTML = "";
            for (i=0;i<linhas.length;i++){

              var placa    = linhas[i].placa;
              var id_proprietario  = linhas[i].id_proprietario;
              var fabricante = linhas[i].fabricante;
              var modelo = linhas[i].modelo;
              var tipo = linhas[i].tipo;


              var linha = `<tr>
                  <td><button type="button" class="btn btn-outline-primary" onclick="historico(${placa})">Histórico</button></td>
                  <td><button type="button" class="btn btn-outline-secondary" onclick="editarVeiculo(${placa})">Editar</button></td>
                  <td><button type="button" class="btn btn-outline-danger" onclick="excluirVeiculo(${placa})">Excluir</button></td>
                  <td>${placa}</td>
                  <td>${id_proprietario}</td>
                  <td>${fabricante}</td>
                  <td>${modelo}</td>
                  <td>${tipo}</td>
                </tr>`;

              document.querySelector("#corpoTabelaVeiculo").innerHTML += linha;

            }
            document.querySelector('.modal-all-requests').style.display = "none";
          }
        });
      }
      
      function inserirHistorico() {

        document.querySelector('.modal-all-requests').style.display = "flex";

        const selectUsuario = document.getElementById('idUsuario2');
        const selectVeiculo = document.getElementById('veiculosUsuarioSelecionado');

        const idUsuario = selectUsuario.options[selectUsuario.selectedIndex].value;
        const placa = selectVeiculo.options[selectVeiculo.selectedIndex].value;

        if (selectUsuario.selectedIndex == 0  || selectVeiculo.selectedIndex == 0) {
          alert('Selecione um usuário e carro válido');
          return
        }
        
        
        const idHistorico = document.getElementById('idHistorico').value


        
        const mecanico = document.getElementById('mecanicoResponsavel')
        const pecas = document.getElementById('pecasCompradas')
        const validade = document.getElementById('validade-garantia')
        const valor = document.getElementById('valor-cobrado')
        const data = document.getElementById('data-servico')

        var json = {};

        
        json.id    = idHistorico;

        if (json.id==""){

          json.acao  = "insertHistorico";
        }else{

          json.acao  = "updateHistorico";
        }


        json.placa  = placa
        json.mecanico = mecanico.value
        json.validade = validade.value
        json.valor = valor.value
        json.data = data.value
        json.pecas = pecas.value


        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
              historico();
              exibir_mensagem("Resultado da solicitação", resp);

              document.querySelector('.modal-all-requests').style.display = "none";
            }
          });


      }

      function historicoOptions(){

        document.querySelector('.modal-all-requests').style.display = "flex";

        var select = document.getElementById('idUsuario2');
        var id = select.options[select.selectedIndex].value;
        var option = select.options[select.selectedIndex].textContent;

        var json  = {};
        json.id   = id;
        json.acao = "veiculo";


        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
            var linhas = JSON.parse(resp);
            document.querySelector("#veiculosUsuarioSelecionado").innerHTML = `<option value="">Selecione</option>`;

            for (i=0;i<linhas.length;i++){


              var placa    = linhas[i].placa;
              var id_proprietario  = linhas[i].id_proprietario;
              var fabricante = linhas[i].fabricante;
              var modelo = linhas[i].modelo;
              var tipo = linhas[i].tipo;

              var options = `
                <option value="${placa}">placa: ${placa} modelo: ${modelo}</option>
              `
              document.querySelector("#veiculosUsuarioSelecionado").innerHTML += options;
            }
            document.querySelector('.modal-all-requests').style.display = "none";
          }
        });
      }

      function consultar(){
        var json = {};
        json.acao  = "select";
        document.querySelector('.modal-all-requests').style.display = "flex";
        document.querySelector("#idUsuario").innerHTML = '<option value="">Selecione</option>';
        document.querySelector("#idUsuario2").innerHTML = ' <option value="">Selecione</option>';


        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
            var linhas = JSON.parse(resp);
            document.querySelector("#corpoTabela").innerHTML = "";
            for (i=0;i<linhas.length;i++){
              var id    = linhas[i].id;
              var nome  = linhas[i].nome;
              var email = linhas[i].email;

              var linha = `<tr>
                  <td><button type="button" class="btn btn-outline-primary" onClick="veiculo(${id})">veiculo</button></td>
                  <td><button type="button" class="btn btn-outline-secondary" onClick="editar(${id}, '${nome}', '${email}')">Editar</button></td>
                  <td><button type="button" class="btn btn-outline-danger" onClick="excluir(${id})">Excluir</button></td>
                  
                  <td>${id}</td>
                  <td>${nome}</td>
                  <td>${email}</td>
                </tr>`;

              document.querySelector("#corpoTabela").innerHTML += linha;
              
              var options = `
                <option value="${id}">${nome}</option>
              `
              document.querySelector("#idUsuario").innerHTML += options;
              document.querySelector("#idUsuario2").innerHTML += options;

              

            }

            document.querySelector('.modal-all-requests').style.display = "none";
          }
        });
      }



      function exibir_mensagem(titulo, conteudo){
        document.querySelector("#modalTitulo").innerHTML   = titulo;
        document.querySelector("#modalConteudo").innerHTML = conteudo;
        var myModal = new bootstrap.Modal(document.getElementById('minhaModal'))
        myModal.show();
      }


      window.onload = () => {
        consultar()

        historicoOptions()
        document.getElementById('idUsuario2').addEventListener('change', historicoOptions)

        document.getElementById('inserir-carro-btn').addEventListener('click', () => {
            if ( document.getElementById('idUsuario').selectedIndex == 0 ) {
                alert('Por favor, selecione um usuário válido')
            }
        })

      }
    </script>

  </head>
  <body>

    <div class="modal-all-requests">
        <div class="custom-loader"></div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="minhaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalTitulo">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="modalConteudo">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
          </div>
        </div>
      </div>
    </div>



    <div class="container text-left mt-5">

        <div class="card my-4">
            <div class="card-body">
                <h5 class="card-title">Atençao!</h5>
                <p class="card-text">Para visualizar todos os veículos de um usuário clique em "Veículos"</p>
                <p class="card-text">Para visualizar todos os históricos para um carro especifico de um veículo clique primeiro em "Veículos" e depois em "Histórico" para o veículo que queira.</p>
                <p class="card-text">Não é possível cadastrar carros com a mesma placa para diferentes usuários.</p>
                
                
            </div>
        </div>

      <div class="row">
        <div class="col-12 offset-12">
          <div class="mb-3">
            <h2 id="titulo">Cadastrar usuário</h2>
          </div>

          <div class="mb-3 mt-5 lh-1">
            <label for="id" class="form-label">Id</label>
            <input type="text" class="form-control" id="id" placeholder="" readonly disabled>
          </div>

          <div class="mb-3 lh-1">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="">
          </div>
          <div class="mb-3 lh-1">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="">
          </div>
          <div class="mb-3 lh-1">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" placeholder="">
          </div>
          <div class="mb-3 lh-1">

            <button type="button" class="btn btn-primary" onclick="window.location.href='principal.php'">Voltar</button>
            <button type="button" class="btn btn-primary" onClick="consultar()">Consultar</button>
            <button type="button" class="btn btn-primary" onClick="inserir()">Salvar</button>
            <button type="button" class="btn btn-primary" onClick="limpar()">Limpar</button>

            
          </div>

          <!-- TABELA DOS USUÁRIOS -->
          <div class="mb-3">
            <table class="table caption-top">
              <thead>
                <tr>
                  <th scope="col">Veiculos</th>
                  <th scope="col">editar</th>
                  <th scope="col">excluir</th>
                  <th scope="col">ID</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody id="corpoTabela">
                <!--Linha da tabela aqui-->
              </tbody>
            </table>
          </div>

          <!-- TABELA DOS VEICULOS CADASTRADOS PARA COM O USUÁRIO SELECIONADO -->
          <div class="mb-3">
            <table class="table caption-top">
              <thead>
                <tr>
                  <th scope="col">Histórico Veículo</th>
                  <th scope="col">Editar Veiculo</th>
                  <th scope="col">Excluir Veículo</th>
                  <th scope="col">placa veiculo</th>
                  <th scope="col">dono veiculo</th>
                  <th scope="col">Dono do veiculo id</th>
                  <th scope="col">Marca</th>
                  <th scope="col">Modelo</th>
                </tr>
              </thead>
              <tbody id="corpoTabelaVeiculo">
                <!--Linha da tabela aqui-->
              </tbody>
            </table>
          </div>



        </div>
      </div>


      <div class="row">
        <div class="col-12 offset-12">
          <div class="mb-3">
            <h2 id="titulo">Cadastrar carro para usuário</h2>
          </div>

       
          <div class="mb-3 mt-5 lh-1">
            <select name="" id="idUsuario">
                <option value="0">Selecione</option>

               
              </select>
            <label for="idUsuario" class="form-label">Id usuario</label>
           
          </div>

          <div class="mb-3 lh-1">
            <label for="placaCarro" class="form-label">placa</label>
            <input type="text" class="form-control" id="placaCarro" placeholder="">
          </div>
          <div class="mb-3 lh-1">
            <label for="marcaCarro" class="form-label">marca</label>
            <input type="text" class="form-control" id="marcaCarro" placeholder="">
          </div>

          <div class="mb-3 lh-1">
            <label for="modeloCarro" class="form-label">modelo</label>
            <input type="text" class="form-control" id="modeloCarro" placeholder="">
          </div>

          <div class="mb-3 lh-1">
            <label for="tipoCarro" class="form-label">tipo</label>
            <input type="text" class="form-control" id="tipoCarro" placeholder="">
          </div>
          <div class="mb-3 lh-1">

            <button type="button"  class="btn btn-primary" onclick="window.location.href='principal.php'">Voltar</button>
            <button type="button" id="inserir-carro-btn" class="btn btn-primary" onClick="inserirCarro()">Salvar</button>
            <button type="button" class="btn btn-primary" onClick="limparCarro()">Limpar</button>

            
          </div>

         


          <!-- TABELA DO HISTÓRICO DOS VEICULOS -->
          <div class="mb-3">
            <table class="table caption-top">
              <thead>
                <tr>
                  <th scope="col">Editar</th>
                  <th scope="col">Excluir</th>
                  <th scope="col">id</th>
                  <th scope="col">id_veiculo placa</th>
                  <th scope="col">proprietario</th>
                  <th scope="col">mecanico responsavel</th>
                  <th scope="col">peças compradas</th>
                  <th scope="col">validade_garantia</th>
                  <th scope="col">valor cobrado</th>
                  <th scope="col">data servico</th>
                </tr>
              </thead>
              <tbody id="corpoTabelaHistorico">
                <!--Linha da tabela aqui-->
              </tbody>
            </table>
          </div>

          <div class="row">
        <div class="col-12 offset-12">
          <div class="mb-3">
            <h2 id="titulo">Cadastrar histórico para um carro</h2>
          </div>



          <div class="mb-3 lh-1">
            <label for="idHistorico" class="form-label">id</label>
            <input type="text" class="form-control" id="idHistorico" placeholder="" disabled>
          </div>

                 
          <div class="mb-3 mt-5 lh-1">
            <p><label for="idUsuario2" class="form-label">id Veiculo placa</label></p>
            <select name="" id="idUsuario2">
                <option value="">Selecione</option>               
            </select>
            <select name="" id="veiculosUsuarioSelecionado">
                <option value="">Selecione</option>               
            </select>
           
          </div>
          
          <div class="mb-3 lh-1">
            <label for="mecanicoResponsavel" class="form-label">mecanico responsavel</label>
            <input type="text" class="form-control" id="mecanicoResponsavel" placeholder="">
          </div>

          <div class="mb-3 lh-1">
            <label for="pecasCompradas" class="form-label">peças compradas</label>
            <input type="text" class="form-control" id="pecasCompradas" placeholder="">
          </div>

          <div class="mb-3 lh-1">
            <label for="validade-garantia" class="form-label">validade garantia</label>
            <input type="text" class="form-control" id="validade-garantia" placeholder="">
          </div>

          <div class="mb-3 lh-1">
            <label for="valor-cobrado" class="form-label">valor cobrado</label>
            <input type="text" class="form-control" id="valor-cobrado" placeholder="">
          </div>

          <div class="mb-3 lh-1">
            <label for="data-servico" class="form-label">data servico</label>
            <input type="text" class="form-control" id="data-servico" placeholder="">
          </div>

          <div class="mb-3 lh-1">

            <button type="button" class="btn btn-primary" onclick="window.location.href='principal.php'">Voltar</button>
            <button type="button" class="btn btn-primary" onClick="inserirHistorico()">Salvar</button>
            <button type="button" class="btn btn-primary" onClick="limparHistorico()">Limpar</button>

            
          </div>

        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>