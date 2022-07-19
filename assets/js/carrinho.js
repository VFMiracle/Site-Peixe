const SIMBOLO_MOEDA_REAL = "R$ ";
const NOME_BOTAO_RMC_CMPR = "botaoRemocaoCompra";

window.addEventListener("DOMContentLoaded", function(event){
	clclrCustoPorCompra();
});

//É chamada pelo evento ativado quando a página termina de ser carregada.
function clclrCustoPorCompra(){
	const Compras = document.getElementsByClassName("compra");
	//Calcular o custo específico de cada compra e preparar os elementos 'quantidade' de cada uma delas para o recalcular e requisitar uma atualização do carrinho sempre que esses sofram alguma mudança.
	for(var compra of Compras){
		const BotaoRemocao = compra.getElementsByClassName("botaoRemocao")[0];
		const Quantidade = compra.getElementsByClassName("quantidade")[0];
		BotaoRemocao.addEventListener("click", removerCompraCarrinho);
		Quantidade.addEventListener("change", calcularPrecoCompra);
		Quantidade.addEventListener("change", calcularPrecoCarrinho);
		calcularPrecoCompra(compra, Quantidade);
	}
}

//INFO: Também é chamada pelo evento de mudança de quantidade de uma compra.
function calcularPrecoCompra(aux, quantidade = null){
	var compra;
	//Se o parâmetro auxiliar for um evento, a referência ao elemento compra relacionado a ele será extraída dele. Caso contrário, o parâmetro auxiliar já terá essa referência.
	if(aux instanceof Event) {compra = aux.target.parentNode.parentNode;}
	else {compra = aux;}
	//Calcular o custo da compra utilizando o preço do produto dela, o qual foi extraído da página, e a quantidade comprada, a qual pode ter sido extraída da página. O custo da compra é então convertido em valor monetário e exíbido.
	const PrecoProduto = compra.getElementsByClassName("precoProduto")[0];
	if(quantidade == null) {quantidade = compra.getElementsByClassName("quantidade")[0];}
	var precoCompra = parseFloat(PrecoProduto.innerHTML.substring(SIMBOLO_MOEDA_REAL.length)) * quantidade.value;
	compra.getElementsByClassName("precoCompra")[0].innerHTML = SIMBOLO_MOEDA_REAL + String(precoCompra.toFixed(2));
}

//INFO: Chamada pelo evento de mudança de quantidade de uma compra.
function calcularPrecoCarrinho(eventoMudanca){
	const PrecoCrnh = document.getElementById("precoCrnh");
	const Quantidade = eventoMudanca.target;
	//Requisitar à função carrinho do controlador deste javascript de acordo com o nome e o valor do campo de quantidade modificado, os quais são enviados no pedido. A resposta se trata do novo preço do carrinho que é exibido na página.
	fetch("/SitePeixe/Loja/carrinho?" + Quantidade.name + "=" + Quantidade.value, {method: 'GET'})
		.then(function(response){return response.text()})
		.then(function(precoAtlzdCrnh){PrecoCrnh.innerHTML = SIMBOLO_MOEDA_REAL + String(precoAtlzdCrnh);});
}

//INFO: É chamada quando o botão de remoção de um dos produtos é clicado.
function removerCompraCarrinho(eventoClique){
	const BotaoRemocao = eventoClique.target;
	const PrecoCrnh = document.getElementById("precoCrnh");
	var idCmprARmvr = BotaoRemocao.id.substring(NOME_BOTAO_RMC_CMPR.length, BotaoRemocao.id.length);
	//Requisitar ao controlador desta página que remova a compra com o id especificado do carrinho. Quando a resposta chegar, apague a seção visual da compra removida e exiba o novo valor do carrinho, o qual veio junto com ela.
	fetch("/SitePeixe/Loja/carrinho?idCmprARmvr=" + idCmprARmvr, {method: 'GET'}).then(function(response){return response.text()}).then(function(precoAtlzdCrnh){
		PrecoCrnh.innerHTML = SIMBOLO_MOEDA_REAL + String(precoAtlzdCrnh);
		removerDivCompra(BotaoRemocao.parentNode.parentNode);
	});
}

function removerDivCompra(compra){
	const ListaCompras = compra.parentNode;
	compra.remove();
	//Caso não haja mais nenhuma divisória de compra na página, a divisória que as continha é removida e uma mensagem de aviso de carrinho vazio é exibida.
	if(ListaCompras.childElementCount == 0){
		const DivTblListaCmprs = ListaCompras.parentNode.parentNode;
		const InfosPedido = document.getElementById("infosPedido");
		InfosPedido.remove();
		//Montar uma divisória informando o usuário de que seu carrinho está vazio, a qual é igual àquela que está descrita no script visual deste javascript.
		const DivFaltaCompras = document.createElement("div");
		DivFaltaCompras.classList.add("title-all", "text-center");
		const Cabecalho = document.createElement("h2");
		Cabecalho.innerHTML = "Não há produtos no carrinho.";
		DivFaltaCompras.appendChild(Cabecalho);
		
		DivTblListaCmprs.appendChild(DivFaltaCompras);
	}
}