window.addEventListener("load", function() {

	var arrChars = new Array(
	['а', 'a'], ['б', 'b'], ['в', 'v'], ['г', 'g'],
	['д', 'd'],  ['е', 'e'], ['ё', 'yo'], ['ж', 'zh'], ['з', 'z'],
	['и', 'i'], ['й', 'j'], ['к', 'k'], ['л', 'l'],
	['м', 'm'],  ['н', 'n'], ['о', 'o'], ['п', 'p'],  ['р', 'r'],
	['с', 's'], ['т', 't'], ['у', 'u'], ['ф', 'f'],
	['х', 'h'],  ['ц', 'c'], ['ч', 'ch'],['ш', 'sh'], ['щ', 'ssh'],
	['ъ', ''],  ['ы', 'y'], ['ь', ''],  ['э', 'e'], ['ю', 'yu'],
	['я', 'ya'], [' ', '-']
	);

	function txtSourceInput(evt) {
	var s = txtSource.value.toLowerCase();
	for (i in arrChars) {
	  s = s.replace(new RegExp(arrChars[i][0], "g"), arrChars[i][1]);
	}
	txtDestination.value = s;
	}

	var txtSource = document.getElementById("source");
	var txtDestination = document.getElementById("destination");
	if ((txtSource) && (txtDestination)) {
	txtSource.addEventListener("input", txtSourceInput, false);
	}
});
