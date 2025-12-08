<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gâteau praliné chocolat-noisette</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="stylesheet" href="../../frontend/assets/css/style.css" />
</head>

<body style="background-color: #E8E0D8;">
  <!-- NAVBAR FLOTANTE -->
  <?php include "../../frontend/view/components/_menu.html.php"; ?>
  <div class="flex items-center justify-center p-6">
    <div class=" shadow-lg rounded-2xl overflow-hidden max-w-4xl w-full" style="background-color: #C4AF9A;">
      <!-- image du dessert -->
      <div class="h-64 md:h-auto">
        <img src="../../frontend/assets/images/JM-recette/<?= htmlspecialchars($recette->getRecipeImg()) ?>" alt="Delicious Recipe" class="w-full h-full object-cover">
      </div>

      <!-- titre de la recette et petite description si nécessaire -->
      <div class="p-6">
        <h2 class="text-3xl font-bold font-serif text-white mb-2">Gâteau praliné chocolat-noisette</h2>
        <p class="text-white mb-4"></p>

        <!-- ingrédients -->
        <div class="mb-4">
          <h3 class="text-xl font-semibold text-white mb-2">Ingrédients (pour 6 personnes) :</h3>
          <ul class="list-disc pl-5 space-y-1 text-white text-sm">
            <li>200 g de chocolat noir</li>
            <li>150 g de pâte de noisette</li>
            <li>100 g de beurre</li>
            <li>100 g de sucre</li>
            <li>3 œufs</li>
            <li>50 g de farine</li>
          </ul>
        </div>

        <!-- Carousel -->
        <div x-data="carousel()" x-cloak class="relative mb-6" style="background-color: #C4AF9A;border: solid 3px #E8E0D8; border-radius: 10px">
          <div class="relative overflow-hidden rounded-lg shadow-xl p-4">
            <div class="flex" :style="trackStyle" @transitionend="onTransitionEnd">
              <template x-for="(slide, index) in track" :key="`${slide.id}-${index}`">
                <div class="flex-none px-2 py-4" :style="`width: ${slidePercentage}%;`">
                  <div class="rounded-lg overflow-hidden h-full">
                    <div class="aspect-square flex items-center justify-center">
                      <img :src="slide.image" :alt="slide.title || ('Slide ' + (index+1))" class="w-full h-full object-cover rounded-lg" @error="handleImageError(slide)">
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </div>
          <!-- précédent -->
          <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md z-10" aria-label="Previous">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <!-- suivant -->
          <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-md z-10" aria-label="Next">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>

        <!-- préparation -->
        <div>
          <h3 class="text-xl font-semibold text-white mb-2">Préparation :</h3>
          <ol class="list-decimal pl-5 space-y-1 text-white text-sm">
            <li>Préchauffez le four à 180°C.</li>
            <li>Faites fondre le chocolat et le beurre au bain-marie.</li>
            <li>Ajoutez la pâte de noisette et le sucre, puis mélangez bien.</li>
            <li>Incorporez les œufs un à un, puis la farine.</li>
            <li>Versez la pâte dans un moule beurré, saupoudrez de noisettes concassées et enfournez 25-30 minutes.</li>
            <li>Laissez refroidir avant de démouler.</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include "../../frontend/view/components/_footer.html.php"; ?>

  <script>
    function carousel() {
      return {
        current: 0,
        internalIndex: 0,
        visibleSlides: 1,
        slidePercentage: 100,
        useTransition: true,
        slides: [{
            id: 1,
            image: '../../frontend/assets/images/JM-recette/beurre.png'
          },
          {
            id: 2,
            image: '../../frontend/assets/images/JM-recette/cacao.png'
          },
          {
            id: 3,
            image: '../../frontend/assets/images/JM-recette/chocolat-noir.png'
          },
          {
            id: 4,
            image: '../../frontend/assets/images/JM-recette/farine.png'
          },
          {
            id: 5,
            image: '../../frontend/assets/images/JM-recette/lait.png'
          },
          {
            id: 6,
            image: '../../frontend/assets/images/JM-recette/noisettes.png'
          },
          {
            id: 7,
            image: '../../frontend/assets/images/JM-recette/oeufs.png'
          },
          {
            id: 8,
            image: '../../frontend/assets/images/JM-recette/sucre.png'
          },
          {
            id: 9,
            image: '../../frontend/assets/images/JM-recette/vanille.png'
          },
        ],

        track: [],
        get pagesCount() {
          return Math.max(1, this.slides.length - this.visibleSlides + 1);
        },
        get trackStyle() {
          const translate = `transform: translateX(-${this.internalIndex * this.slidePercentage}%);`;
          const transition = this.useTransition ? 'transition: transform 0.5s ease-in-out;' : 'transition: none;';
          return `${translate} ${transition}`;
        },
        init() {
          this.updateVisibleSlides();
          this.buildTrack();
          window.addEventListener('resize', () => {
            const prevCurrent = this.current;
            this.updateVisibleSlides();
            this.buildTrack(prevCurrent);
          });
        },
        updateVisibleSlides() {
          if (window.innerWidth < 768) {
            this.visibleSlides = 1;
          } else {
            this.visibleSlides = 3;
          }
          this.slidePercentage = 100 / this.visibleSlides;
        },
        buildTrack(keepCurrent = null) {
          if (keepCurrent !== null) {
            this.current = Math.max(0, Math.min(keepCurrent, this.pagesCount - 1));
          } else {
            this.current = Math.max(0, Math.min(this.current, this.pagesCount - 1));
          }
          const head = this.slides.slice(-this.visibleSlides);
          const tail = this.slides.slice(0, this.visibleSlides);
          this.track = [...head, ...this.slides, ...tail];

          this.useTransition = false;
          this.internalIndex = this.current + this.visibleSlides;

          requestAnimationFrame(() => {
            this.useTransition = true;
          });
        },
        next() {
          this.current = (this.current + 1) % this.pagesCount;
          this.internalIndex += 1;
        },
        prev() {
          this.current = (this.current - 1 + this.pagesCount) % this.pagesCount;
          this.internalIndex -= 1;
        },
        goTo(index) {
          index = Math.max(0, Math.min(index, this.pagesCount - 1));

          const targetInternal = index + this.visibleSlides;
          this.current = index;
          this.internalIndex = targetInternal;
        },
        onTransitionEnd() {
          if (this.internalIndex >= this.slides.length + this.visibleSlides) {
            this.useTransition = false;
            this.internalIndex = this.visibleSlides;
            requestAnimationFrame(() => {
              this.useTransition = true;
            });
          }

          if (this.internalIndex <= 0) {
            this.useTransition = false;
            this.internalIndex = this.slides.length;
            requestAnimationFrame(() => {
              this.useTransition = true;
            });
          }
        },
        handleImageError(slide) {
          slide.image = 'https://picsum.photos/id/21/800/600';
        }
      }
    }
  </script>
</body>

</html>
