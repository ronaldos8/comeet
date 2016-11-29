function coba()
{
	var form;
	var nama;
	form = document.forms['form2'];
	nama = form.elements['m_name'].value;

	var name_m = document.getElementById('name_m');
	name_m.value = nama;

	nama = form.elements['m_desc'].value;
	var name_m = document.getElementById('desc_m');
	name_m.value = nama;

	nama = form.elements['venue'].value;
	var name_m = document.getElementById('venue_m');
	name_m.value = nama;
}

function role()
{
	var el = document.getElementById('num_role');
	// var n = document.getElementById('n_role');
	// var nn = n.value;

	var container = document.createElement('div');
	container.setAttribute('class', 'col-md-3');

	var clearfix = document.createElement('div');
	clearfix.setAttribute('class', 'br');

	var new_element = document.createElement('input');
	new_element.setAttribute('type', 'text');
	new_element.setAttribute('class', 'form-control col-md-3');
	new_element.setAttribute('placeholder', 'Nama peran');
	new_element.setAttribute('name', 'rolelist[]');

	var new_element2 = document.createElement('input');
	new_element2.setAttribute('type', 'text');
	new_element2.setAttribute('class', 'form-control col-md-3');
	new_element2.setAttribute('placeholder', 'kuorum');
	new_element2.setAttribute('name', 'kuorumlist[]');

	var new_element3 = document.createElement('input');
	new_element3.setAttribute('type', 'text');
	new_element3.setAttribute('class', 'form-control col-md-3');
	new_element3.setAttribute('placeholder', 'nama');
	new_element3.setAttribute('name', 'nama[]');

	var new_element4 = document.createElement('br');

	container.appendChild(new_element);
	container.appendChild(new_element2);
	container.appendChild(new_element3);
	container.appendChild(clearfix);

		/*el.appendChild(new_element);
		el.appendChild(new_element);
		el.appendChild(new_element2);
		el.appendChild(new_element3);*/
		el.appendChild(container);	
}

function cari()
{
	$(document).ready(function() {
	 $('#textcari').keyup(function(){
	 	if (strcari != "") {
	 		$("#hasil").html("")
	 		$.ajax({
	 			type:"post",
	 			url:"localhost/home/cari",
	 			data:"q="+ strcari,
	 			success: function(data){
	 				$("#hasil").html(data);
	 			}
	 		});
	 	}
	 });
	}); 
}