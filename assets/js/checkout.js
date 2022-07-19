const DivsDtlhsPgmntPorId = {};
var divDtlhsPgmntEmExbc = null;

window.addEventListener("DOMContentLoaded", function(event){
	const SlcndrEstado = document.getElementById("slcndrEstado");
	const OpcoesMetodoPgmnt = document.getElementsByName("metodoPgmnt");
	SlcndrEstado.addEventListener("change", exibirOpcoesCddsNoEstado);
	//OBS: Utiliza-se um 'for loop' para passar pelos botões de rádio. Cheque as anotações do projeto se quiser entender o porque.
	for(var opcaoMetodoPgmnt of OpcoesMetodoPgmnt) opcaoMetodoPgmnt.addEventListener("change", exibirDivDetalhesPgmnt);
	montarDivStripePgmntNoCartao();
	extrairDivsDetalhesPgmnt();
	exibirDivDetalhesPgmnt();
	prepararFrmtcAtmtcFrmlr();
});

function montarDivStripePgmntNoCartao(){
	var codigoPgmntCliente;
	const CartaoEltrnc = document.getElementById("cartaoEltrnc");
	const InfosPgmnt = document.getElementById("infosPgmnt");
	
	//Iniciar o Stripe no Javascript utilizando o código inicialização, instanciar um controlador de elementos do Stripe e utiliza-lo para criar uma divisória do Stripe que recebe as informações de pagamento, a qual será exibida na página como uma filha da divisória 'cartaoEltrnc'.
	var stripe = Stripe("pk_test_51JNzAhJw9GgPwoWeYKOLfpiUJDQ0P0UoPQ66yYBSFBS3WmNqUSegAm8BslDy6N9MqyphY67Kd9p47GDtb48mWbxh00bAFVyu90");
	var cntrldrElmntsStripe = stripe.elements();
	var dtlhsEmStrpCrtao = cntrldrElmntsStripe.create('card');
	dtlhsEmStrpCrtao.mount(CartaoEltrnc);
	
	//Requisitar à função 'checkout' do controlador 'Loja' que retorne o código de pagamento do cliente, deste pedido, para que ele seja salvo neste script.
	fetch("/SitePeixe/Loja/checkout", {method: 'POST', body: JSON.stringify({deveMontrSgrdPgmntClnt : true}), headers: {"Content-Type": "application/json"}})
		.then(function(response){return response.json()})
		.then(function(cdgTempPgmntClnt){codigoPgmntCliente = cdgTempPgmntClnt});
	
	//OBS: Já qua a função que é conectada utiliza o código de pagamento do cliente, ela não pode ser definida externamente a esta função. (Para mais informações verifique a seção 'Stripe - Restrições a Formatação de Código' das anotações do projeto.)
	//Cancelar o recarregamento da página pós-submição, e confirmar o pagamento por meio do Stripe. Quando a confirmação for concluída, inicia-se a finalização do processo de pagamento.
	InfosPgmnt.addEventListener("submit", function(event){
		event.preventDefault();
		stripe.confirmCardPayment(codigoPgmntCliente, {payment_method : {card : dtlhsEmStrpCrtao}}).then(fnlzrProcessoPgmnt);
	});
}

//Chamada quando o usuário selecionar um estado.
function exibirOpcoesCddsNoEstado(eventoMudanca){
	var estadoSlcnd = eventoMudanca.target.value;
	const SlcndrCidade = document.getElementById("slcndrCidade");
	//Requisitar ao controlador um texto HTML das cidades pertencentes ao estado selecionado pelo usuário, a qual está organizada como opções de um elemento selecionador. Quando ela for recebida, será aplicada ao elemento 'Selecionador de Cidade'.
	fetch("/SitePeixe/Loja/checkout?estdOpcsCddsAExbr=" + estadoSlcnd, {method: 'GET'})
		.then(function(response){return response.text()})
		.then(function(HTMLCddsEstdSlcnd){SlcndrCidade.innerHTML = HTMLCddsEstdSlcnd});
}

//Chamada quando pagamento Stripe for finalizado.
function fnlzrProcessoPgmnt(resultado){
	const InfoPedido = document.getElementById("infoPedido");
	//Caso a resposta não possua uma mensagem de erro, a mensagem de sucesso predefinida é exibida. Caso contrário, a mensagem de erro da resposta é exibida.
	if(!resultado.error) alert("Sua compra foi realizada com sucesso.");
	else alert(resultado.error.message);
	InfoPedido.submit();
}

//Tambem é chamada quando uma das opções de método de pagamento for selecionada.
function exibirDivDetalhesPgmnt(){
	const OpcoesMetodoPgmnt = document.getElementsByName("metodoPgmnt");
	const ZonaDtlhsPgmnt = document.getElementById("zonaDtlhsPgmnt");
	//Se uma divisória de detalhes de pagamento estiver salva neste script, significa que ela está sendo exibida no script visual e que será removida agora.
	if(divDtlhsPgmntEmExbc != null) {
		ZonaDtlhsPgmnt.removeChild(divDtlhsPgmntEmExbc);
		divDtlhsPgmntEmExbc = null;
	}
	//Passar pelas opções de método de pagamento e determinar qual delas foi selecionada, para que sua divisória de detalhes de pagamento correspondente possa ser exibida de forma apropriada.
	for(var opcaoMetodoPgmnt of OpcoesMetodoPgmnt) {if(opcaoMetodoPgmnt.checked){
		//Caso a opção selecionada não seja "pgmntNaEntrega", deve-se passar pela lista de divisórias organizadas por seus respectivos ids e encontrar aquela que corresponde a opção selecionada, para que ela seja exibida no script visual e uma referência a ela seja salva neste script.
		if(opcaoMetodoPgmnt.value != "pgmntNaEntrega") {for(var [idDtlhsPgmnt, divDtlhsPgmnt] of Object.entries(DivsDtlhsPgmntPorId)) {if(opcaoMetodoPgmnt.value == idDtlhsPgmnt){
			ZonaDtlhsPgmnt.appendChild(divDtlhsPgmnt);
			divDtlhsPgmntEmExbc = divDtlhsPgmnt;
			break;
		}}}
		break;
	}}
}

function extrairDivsDetalhesPgmnt(){
	const DivsDtlhsPgmnt = document.getElementsByClassName("dtlhsPgmnt");
	//Remover cada uma das divisórias de detalhes de pagamento do script visual e salvar suas referências em uma lista, em que cada uma vai estar em uma entrada cuja chave corresponde ao seu respectivo id.
	for(var divDtlhsPgmnt of DivsDtlhsPgmnt){
		DivsDtlhsPgmntPorId[divDtlhsPgmnt.id] = divDtlhsPgmnt;
		divDtlhsPgmnt.remove();
	}
}

//OBS: Esta é uma função especial feita para designar formatações específicas para determinados campos do formulário. Assim, ela não receberá comentários em seus blocos de código.
function prepararFrmtcAtmtcFrmlr(){
	var frmtcNumeroEndrc = new Cleave('#numeroEndrc', {
		delimiter: '.',
		numeral: true,
		numeralPositiveOnly: true,
		numeralDecimalMark: ',',
		numeralDecimalScale: 0
	});
	
	var frmtcCEP = new Cleave('#cep', {
		blocks: [5, 3],
		delimiter: '-',
		numericOnly: true,
		delimiterLazyShow: true
	});
	
	var frmtcCelular = new Cleave('#celular', {
		phone: true,
		phoneRegionCode: 'BR'
	});
}