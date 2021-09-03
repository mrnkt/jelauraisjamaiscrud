// compare les email au moment de l'inscription
function compare(event){

	var email = document.querySelector("#email").value;
	var confirmation = document.querySelector("#confirmation").value;


	if (email != confirmation) {
		event.preventDefault();
		document.querySelector("#errormail").innerHTML = "L'email et la confirmation doivent être identiques";
	}
}

// Verifie si la plaque est rentrée correctement 
const plaque = document.querySelector("#plaque");

plaque.addEventListener("change",function(){

	const regex = /^[a-zA-Z]{2}[-][0-9]{3}[-][a-zA-Z]{2}$/;
	plaque.classList.remove("is-valid");
	plaque.classList.remove("is-invalid");
	document.querySelector("#errorPlaque").style.display = "none";

		if (plaque.value.match(regex)){
			plaque.classList.add("is-valid");
		} else{
			plaque.classList.add("is-invalid");
			document.querySelector("#errorPlaque").style.display = "block";
			document.querySelector("#errorPlaque").innerHTML = "La plaque d'immatriculation doit avoir le format AA-123-AA";
			document.querySelector("#errorPlaque").style.color = "red";
			return false;
		}
	});

// Verifie si le choix est une reponse correcte
const choix = document.querySelector("#Choix");

	choix.addEventListener("change",function(){
		choix.classList.remove("is-valid");
		choix.classList.remove("is-invalid");
		document.querySelector("#errorChoix").style.display = "none";

		if (choix.value == "--Choisir une option--"){
			choix.classList.add("is-invalid");
			document.querySelector("#errorChoix").style.display = "block";
			document.querySelector("#errorChoix").innerHTML = "Veuillez choisir une marque";
			document.querySelector("#errorChoix").style.color = "red";
			alert("Please select an option!");
		} else{
			choix.classList.add("is-valid");
		}
	});

// On met une fonction submit sur le bouton 
const btnForm = document.querySelector("form");

	btnForm.addEventListener("submit", insertCar);
	function insertCar(event) {
		event.preventDefault();
		fetch(`/crud-main/controller/FrontController.php?function=insertCar`,{
			method: "POST",
			body: new FormData(btnForm)
		})
			.then(result => result.json())
			.then(data => {
				if (data.status == "OK") {
					document.querySelector('#messageYes').classList.remove('d-none');
					setTimeout(function time() {
						document.querySelector('#messageYes').classList.add('d-none');
					}, 5000);
					console.log("voiture ajoutée");
					displayCars();
			}
		});
	}

function displayCars(){
	fetch(`/crud-main/controller/FrontController.php?function=displayCars`)
		.then(result => result.json())
		.then(data => { 
			if (data.status == "OK") {
				document.querySelector("#tableauCars").style.display = 'block';
				document.querySelector("#tableauCars").innerHTML = data.result;

		}
	});
}

displayCars();

function deleteCar(id){
	console.log(id);
	fetch(`/crud-main/controller/FrontController.php?function=deleteCar&id=${id}`)
	.then(result => result.json())
	.then(data => {
		if (data.status === "OK") {
			let element = document.getElementById(`car${id}`);
			element.parentNode.removeChild(element);
			document.querySelector('#messageNo').classList.remove('d-none');
			setTimeout(function time() {
				document.querySelector('#messageNo').classList.add('d-none');
			}, 5000);
			console.log ("suppression Oki");
	} else {
            console.log ("suppression not Oki");
	}
   } 
  );
}
