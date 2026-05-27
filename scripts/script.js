/*********************SLIDER IMAGES DU #DISCOVERING**********************/

const slides = [
    {
		"image":"/images/slider/fleurs3028.webp",
		"tagLine":"Découvrir le parc du Haut-Languedoc"
	},
	{
		"image":"/images/slider/capimont3360.webp",
		"tagLine":"En route pour la chapelle de Capimont"
	},
	{
		"image":"/images/slider/montagne3683.webp",
		"tagLine":"L'Hérault, pays de montagne"
	},
	{
		"image":"/images/slider/moureze3084.webp",
		"tagLine":"Le Cirque de Mourèze près du Salagou"
	},
	{
		"image":"/images/slider/orgues3043.webp",
		"tagLine":"Les Orgues de Taussac dans le Geoparc"
	},
	{
		"image":"/images/slider/passap3049.webp",
		"tagLine":"La PassaPaïs, à pieds, en vélo, à cheval!"
	},
	{
		"image":"/images/slider/rando3668.webp",
		"tagLine":"Grand choix de randonnées dans le Parc>"
	},
	{
		"image":"/images/slider/sete3808.webp",
		"tagLine":"Sète, la côte Méditerranéenne"
	}
]

slides.forEach(slide => {
    const img = new Image();
    img.src = slide.image;
});

//Variables des images et des fleches
const arrowLeft = document.querySelector(".arrow_left");
const arrowRight = document.querySelector(".arrow_right");

const nbSlides = slides.length;

const bannerImg = document.querySelector('.slider-image');
const tagLine = document.getElementById('tag-line');

const slider = document.getElementById('slider');//

let index = 0;//Index de suivi des fleches

//Incrémentation du slider (fleche de droite)
arrowRight.addEventListener('click', () => {
    index++;
    if(index >= nbSlides) {
        index = 0;
	}
	updateSlide(index)
})

//décrémentation du slider (fleche de gauche)
arrowLeft.addEventListener('click', () => {
    if(index <= 0) {
        index = nbSlides;
	}
	index--;
    updateSlide(index)
    console.log(index)
})

function updateSlide(i) {

	slider.style.opacity = 0.7;

    // fade-out
    bannerImg.classList.add('fade');
    tagLine.classList.add('fade');

    // attendre la fin du fade-out
    setTimeout(() => {

        // changement image + texte
        bannerImg.src = slides[i].image;
        tagLine.innerHTML = slides[i].tagLine;

        // attendre que l'image soit chargée
        bannerImg.onload = () => {

            // fade-in
            bannerImg.classList.remove('fade');
            tagLine.classList.remove('fade');

        };
		slider.style.opacity = 1;

    }, 300);
}

function nextSlide() {
    index++;
    if(index >= nbSlides) {
        index = 0;
    }
    updateSlide(index);
}


function prevSlide() {
    if(index <= 0) {
        index = nbSlides;
    }
    index--;
    updateSlide(index);
}

//**********AUTO SLIDER***********/

let autoSlide = setInterval(nextSlide, 3000);


// Reset timer après action utilisateur
function resetAutoSlide() {

    clearInterval(autoSlide);

    autoSlide = setInterval(nextSlide, 3000);
}

//*********PAUSE AU HOVER*********/

slider.addEventListener("mouseenter", () => {
    clearInterval(autoSlide);
});

slider.addEventListener("mouseleave", () => {
    autoSlide = setInterval(nextSlide, 3000);
});

/****************SLIDER DU #EXTRAS****************/

const articles = document.querySelector(".articles");
const cards = document.querySelectorAll(".xtra-card");

let indexcards = 0;

const visibleCards = 6;

const totalCards = 8;

function slideCards() {

	indexcards++;

	// retour au début
	if(indexcards > totalCards - visibleCards) {
		indexcards = 0;
	}

	// largeur d'une card + gap
	const cardWidth = cards[0].offsetWidth + 20;

	articles.style.transform = `translateX(-${indexcards * cardWidth}px)`;
}
// auto slide
setInterval(slideCards, 1000);

/*****************MODALE DE CONTACT*****************/

const modal = document.getElementById('modal-contact');
const openBtn = document.getElementById('open-contact-modal');
const closeBtn = document.getElementById('close-contact-modal');
const submitForm = document.getElementById('modal-contact-form');
const submitBtn = document.getElementById('submit-modal-contact');


const modalOpen = document.body.dataset.modalOpen;

        openBtn.addEventListener('click', () => {
            modal.classList.add('active');
        });

        closeBtn.addEventListener('click', () => {
			submitBtn.disabled = false;
			submitBtn.value = 'ENVOYEZ VOTRE MESSAGE';
			modal.classList.remove('active');
        });

		submitForm.addEventListener('submit', () => {
			submitBtn.disabled = true;
		});
			
		if(modalOpen === 'true') {
			modal.classList.add('active');
			submitBtn.disabled = true;	
		};

