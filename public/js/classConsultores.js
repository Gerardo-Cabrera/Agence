classConsultores = {
	monthsFrom: '#monthsFrom',
	yearsFrom: '#yearsFrom',
	monthsTo: '#monthsTo',
	yearsTo: '#yearsTo',
	listConsultores: '#listadoConsultores',
	botonAgregar: '#agregar',
	botonRemover: '#remover',

	initializeInputs: function() {
		$(this.monthsFrom).select2({
			'placeholder': 'Seleccione un mes'
		});
		$(this.yearsFrom).select2({
			'placeholder': 'Seleccione un año'
		});
		$(this.monthsTo).select2({
			'placeholder': 'Seleccione un mes'
		});
		$(this.yearsTo).select2({
			'placeholder': 'Seleccione un año'
		});
		$(this.listConsultores).select2({
			'placeholder': 'Seleccione uno o varios consultores'
		});
	},

	options: function (options) {
		this.listadoConsultores = options.listConsultores;
		this.enviarConsultores = options.consultoresEnviar;
	},

	onEvents: function() {
		var obj = this;

		var listadoConsultores = this.listadoConsultores[0];

		var enviarConsultores = this.enviarConsultores[0];

		var add = $(this.botonAgregar);
		add.on("click", function() {
			// obj.move(options);
			obj.move(listadoConsultores, enviarConsultores);
		});

		var remove = $(this.botonRemover);
		remove.on("click", function() {
			// obj.move(options);
			obj.move(enviarConsultores, listadoConsultores);
		});
	},

	move: function(boxOne, boxTwo) {
		var arrFbox = new Array();
		var arrTbox = new Array();
		var arrLookup = new Array();
		var i;

		for (i = 0; i < boxTwo['options'].length; i++) {
			arrLookup[boxTwo['options'][i].text] = boxTwo['options'][i].value;
			arrTbox[i] = boxTwo['options'][i].text;
		}

		var fLength = 0;
		var tLength = arrTbox.length;

		for(i = 0; i < boxOne['options'].length; i++) {
			arrLookup[boxOne['options'][i].text] = boxOne['options'][i].value;

			if (boxOne['options'][i].selected && boxOne['options'][i].value != "") {
				arrTbox[tLength] = boxOne['options'][i].text;
				tLength++;
			} else {
				arrFbox[fLength] = boxOne['options'][i].text;
				fLength++;
		   	}
		}

		arrFbox.sort();
		arrTbox.sort();

		boxOne.length = 0;
		boxTwo.length = 0;

		var c;

		for(c = 0; c < arrFbox.length; c++) {
			var no = new Option();
			no.value = arrLookup[arrFbox[c]];
			no.text = arrFbox[c];
			boxOne[c] = no;
		}

		for(c = 0; c < arrTbox.length; c++) {
			var no = new Option();
			no.value = arrLookup[arrTbox[c]];
			no.text = arrTbox[c];
			boxTwo[c] = no;
		}
	}
}