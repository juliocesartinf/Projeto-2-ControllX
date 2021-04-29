function validarCampos() {
	var Csenha = document.getElementById('senha');
	var Csenha1 = document.getElementById('senha_1');
	var Csenha2 = document.getElementById('senha_2');

	var senha =Csenha.value;
	var senhaNova = Csenha1.value;
	var senhaConfirmar = Csenha2.value;
	

	alert(senha+"-"+senhaNova+"-"+senhaConfirmar);
}