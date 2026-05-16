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
		"tagLine":"Sète, l'étang de Thau et la côte Méditerranéenne"
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

let index = 0;//Index de suivi des fleches

//Incrémentation du slider (fleche de droite)
arrowRight.addEventListener('click', () => {
    index++;
    if(index >= nbSlides) {
        index = 0;
	}
	updateSlide(index)
	console.log(index)
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

/*function updateSlide(i) {
	// fade
	bannerImg.classList.add('fade');
	tagLine.classList.add('fade');

	setTimeout(() => {
    // changement de contenu
    bannerImg.src = slides[i].image;
    tagLine.innerHTML = slides[i].tagLine;
    
    // fade-in
    bannerImg.classList.remove('fade');
    tagLine.classList.remove('fade');
    }, 600);} // même durée que le CSS*/

function updateSlide(i) {

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

    }, 400);
}