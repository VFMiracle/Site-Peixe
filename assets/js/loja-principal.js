const PrdtsEscndds = [];

/*Limitar quais produtos são exibidos na página 'loja-principal'. Recebe os ids-banco dos produtos que devem permanecer visíveis.*/
function filtrarTipoProduto(idsPrdtsValidos){
	const IdsVsvsPrdtsVlds = [], PrdtsInvlds = [];
	/*Salvar uma referência a tabela visual que contém todos os produtos.*/
	const TabelaPrdts = document.getElementById("TabelaProdutos");
	/*Montar uma lista que contenha todos os produtos carregados da database, estejam eles visíveis ou não.*/
	const TodosPrdts = (PrdtsEscndds.concat(Array.from(TabelaPrdts.children)));
	
	/*Montar uma lista contendo os ids-visuais dos produtos que devem continuar a ser visíveis.*/
	for(var idProdutoValido of idsPrdtsValidos){
		IdsVsvsPrdtsVlds.push("CelulaProduto" + String(idProdutoValido));
	}
	/*Adicionar à lista de produtos inválidos todos os produtos cujos ids-visuais não estão na lista de ids-visuais válidos.*/
	for(var celulaProduto of TodosPrdts){
		if (!IdsVsvsPrdtsVlds.includes(celulaProduto.id)){
			PrdtsInvlds.push(celulaProduto);
		}
	}
	
	if(PrdtsEscndds.length > 0){ //Caso já existam produtos escondidos...
		const PrdtsAEscndr = [];
		var qtdPrdtsJaEscndd = 0;
		
		/*Verificar quais produtos inválidos já estão escondidos. Caso o produto não esteja, ele é adicionado a lista de produtos a esconder. Caso contrário, adiciona 1 ao número de produtos já escondidos.*/
		for(var produtoInvld of PrdtsInvlds){
			if(!PrdtsEscndds.includes(produtoInvld)){
				PrdtsAEscndr.push(produtoInvld);
			}
			else{
				qtdPrdtsJaEscndd++;
			}
		}
		
		if(qtdPrdtsJaEscndd != PrdtsEscndds.length){ //Caso pelo menos um dos produtos inválidos não esteja escondido...
			const PrdtsARevelar = [];
			/*Verificar quais produtos escondidos não fazem parte da lista de produtos inválidos. Caso o produto não faça parte, ele é adicionado a lista de produtos a revelar.*/
			for(var produtoEscndd of PrdtsEscndds){
				if(!PrdtsInvlds.includes(produtoEscndd)){
					PrdtsARevelar.push(produtoEscndd);
				}
			}
			
			/*Passar por todas as entradas da lista de produtos a revelar para: 1- Adiciona-los novamente à tabela. 2- Remove-los da lista de produtos escondidos.*/
			for(var produtoARevelar of PrdtsARevelar){
				TabelaPrdts.appendChild(produtoARevelar);
				PrdtsEscndds.splice(PrdtsEscndds.indexOf(produtoARevelar), 1);
			}
			/*Passar por todas as entradas da lista de produtos a esconder para: 1- Remove-los da tabela. 2- Adiciona-los à lista de produtos escondidos.*/
			for(produtoAEscndr of PrdtsAEscndr){
				TabelaPrdts.removeChild(produtoAEscndr);
				PrdtsEscndds.push(produtoAEscndr);
			}
		}
		else{ //Caso contrário, adicionar todos os produtos escondidos a tabela novamente e resetar a lista.
			for(var produtoEscndd of PrdtsEscndds){
				TabelaPrdts.appendChild(produtoEscndd);
			}
			PrdtsEscndds.length = 0;
		}
	}
	else{ //Caso contrário, remover todos os produtos inválidos da tabela e adiciona-los a lista de produtos escondidos.
		for(var produtoInvld of PrdtsInvlds){
			PrdtsEscndds.push(produtoInvld);
			TabelaPrdts.removeChild(produtoInvld);
		}
	}
}