var pessoas = [];
var pessoaSelecionada;

const url = '../../backend/api/person.php';

/**
 * Função responsável por listar todos os registros
 */
function listarDados(){
    axios({
        method:'GET',
        url: url,
        responseType:'json'
    }).then(res=>{
        console.log(res.data);
        this.pessoas = res.data;
        preencherTabela();
    }).catch(error=>{
        console.error(error);
    });
}

listarDados();

/**
 * Função que preenche a tabela
 */
function preencherTabela(){
    document.querySelector('#table-dados tbody').innerHTML = '';
    for(let i = 0; i<pessoas.length; i++){
        document.querySelector('#table-dados tbody').innerHTML += 
        `<tr>
            <td>${pessoas[i].name}</td>
            <td>${pessoas[i].endereco}</td>
            <td>${pessoas[i].cep}</td>
            <td>${pessoas[i].dataNasc}</td>
            <td>${pessoas[i].telefone}</td>
            <td><button type="button" onclick="deletar(${i})">X</button></td>
            <td><button type="button" onclick="selecionar(${i})">Editar</button></td>
        </tr>`;
    }
}

/**
 * Fução que deleta dados
 */
function deletar(indice){
    console.log('Deletar o elemento com o indece ' + indice);
    axios({
        method:'DELETE',
        url: url + `?id=${indice}`,
        responseType:'json'
    }).then(res=>{
        console.log(res.data);
        listarDados();
    }).catch(error=>{
        console.error(error);
    });
}

/**
 * Função que salva dados
 */
function salvar(){
    document.getElementById('btn-salvar').disabled = true;
    document.getElementById('btn-salvar').innerHTML = 'Salvando...';
    let pessoa = {
        name: document.getElementById('name').value,
        endereco: document.getElementById('endereco').value,
        cep: document.getElementById('cep').value,
        dataNasc: document.getElementById('dataNasc').value,
        telefone: document.getElementById('telefone').value
    };
    console.log('Dados a Salvar', pessoa);
    axios({
        method:'POST',
        url: url,
        responseType:'json',
        data: pessoa
    }).then(res=>{
        console.log(res.data);
        limpar();
        listarDados();
        document.getElementById('btn-salvar').disabled = false;
        document.getElementById('btn-salvar').innerHTML = 'Salvar';
    }).catch(error=>{
        console.error(error);
    });
}

/**
 * Função para limpar o formulário
 */
function limpar(){
    document.getElementById('name').value = null;
    document.getElementById('endereco').value = null;
    document.getElementById('cep').value = null;
    document.getElementById('dataNasc').value = null;
    document.getElementById('telefone').value = null;
    document.getElementById('btn-atualizar').style.display = 'none';
    document.getElementById('btn-salvar').style.display = 'inline';
}

/**
 * Função responsável por selecionar um registro
 */
 function selecionar(indice){
    pessoaSelecionada = indice;
    console.log('Se seleciono o elemento ' + indice);
    axios({
        method:'GET',
        url: url + `?id=${indice}`,
        responseType:'json',
    }).then(res=>{
        console.log(res);
        document.getElementById('name').value = res.data.name;
        document.getElementById('endereco').value = res.data.endereco;
        document.getElementById('cep').value = res.data.cep;
        document.getElementById('dataNasc').value = res.data.dataNasc;
        document.getElementById('telefone').value = res.data.telefone;
        document.getElementById('btn-salvar').style.display = 'none';
        document.getElementById('btn-atualizar').style.display = 'inline';
    }).catch(error=>{
        console.error(error);
    });
}

/**
 * Função para atualizar os dados
 */
function atualizar(){
    let pessoa = {
        name: document.getElementById('name').value,
        endereco: document.getElementById('endereco').value,
        cep: document.getElementById('cep').value,
        dataNasc: document.getElementById('dataNasc').value,
        telefone: document.getElementById('telefone').value
    };
    console.log('Dados a atualizar', pessoa);
    axios({
        method:'PUT',
        url: url + `?id=${pessoaSelecionada}`,
        responseType:'json',
        data: pessoa
    }).then(res=>{
        console.log(res.data);
        limpar();
        listarDados();
    }).catch(error=>{
        console.error(error);
    });
}

