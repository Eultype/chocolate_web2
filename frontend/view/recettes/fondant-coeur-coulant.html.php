<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fondant au Chocolat Cœur Coulant - Chocolat Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../../css/style.css" />
    <link
      rel="icon"
      href="../../images/tablette_chocolat1.ico"
      type="image/png"
    />
    <style>
      body {
        background-color: #f7efe6;
        color: #4d2c16;
      }
      .checkbox-custom:checked {
        accent-color: #d4a15a;
      }
      .step-number {
        font-weight: bold;
        font-size: 1.875rem;
        line-height: 1;
        color: #d4a15a;
        min-width: 40px;
      }
      .hero-gradient {
        background: linear-gradient(
          to top,
          rgba(29, 17, 10, 0.7),
          rgba(29, 17, 10, 0.2)
        );
      }

      /* Bouton d'impression */
      .print-btn:hover {
        transform: scale(1.05);
      }

      /* ================================= IMPRESSION ================================= */
      @media print {
        body {
          background: white !important;
          color: black !important;
          font-size: 13pt;
          line-height: 1.5;
        }
        .no-print {
          display: none !important;
        }
        #printable {
          display: block !important;
          padding: 20mm 15mm;
        }
        #printable h1 {
          font-size: 28pt;
          text-align: center;
          margin-bottom: 12mm;
        }
        #printable h2 {
          font-size: 18pt;
          margin: 15mm 0 8mm 0;
          border-bottom: 3px solid #d4a15a;
          padding-bottom: 4mm;
        }
        #printable ul,
        #printable ol {
          padding-left: 10mm;
        }
        #printable li {
          margin-bottom: 5mm;
        }
        #printable .tip {
          background: #fbf3e0;
          padding: 10mm;
          border-left: 6px solid #d4a15a;
          font-style: italic;
          margin-top: 15mm;
        }
        @page {
          margin: 15mm;
        }
      }
    </style>
  </head>
  <body class="overflow-x-hidden min-h-screen">
    <!-- Bouton d'impression (visible seulement à l'écran) -->
    <div class="fixed top-6 right-6 z-50 no-print">
      <button
        onclick="window.print()"
        class="print-btn bg-white/95 backdrop-blur-lg shadow-2xl rounded-2xl px-6 py-4 flex items-center gap-3 text-[#4d2c16] font-bold text-lg hover:shadow-xl transition"
      >
        <i data-lucide="printer" class="w-7 h-7"></i>
        Imprimer
      </button>
    </div>

    <!-- Navigation inférieure -->
    <?php include "../../frontend/view/components/_menu.html.php"; ?>

    <!-- ===================== BELLE VERSION POUR L'ÉCRAN ===================== -->
    <div class="no-print">
      <!-- Hero -->
      <div class="relative h-[85vh] min-h-[600px] flex items-end">
        <img
          src="../../frontend/assets/images/<?= htmlspecialchars($recette->getRecipeImg()) ?>"
          class="absolute inset-0 w-full h-full object-cover"
          alt="Fondant au chocolat cœur coulant"
        />
        <div class="absolute inset-0 hero-gradient"></div>
        <div class="relative z-10 px-8 md:px-20 pb-16 max-w-5xl">
          <span
            class="text-sm font-bold uppercase tracking-wider text-[#d4a15a] mb-3 block"
            >Gâteau iconique</span
          >
          <h1
            class="text-5xl md:text-7xl lg:text-8xl font-medium text-white leading-tight"
          >
            Fondant<br />Cœur Coulant
          </h1>
          <p class="text-xl md:text-2xl text-white/90 mt-6 max-w-3xl">
            Le dessert qui fait fondre tout le monde. Un extérieur croustillant,
            un cœur ultra coulant… prêt en 25 minutes seulement.
          </p>
        </div>
      </div>

      <!-- Meta info -->
      <div class="px-8 md:px-20 -mt-12 relative z-20">
        <div class="flex flex-wrap justify-center md:justify-start gap-6 mb-12">
          <div
            class="bg-white/95 backdrop-blur-sm px-8 py-5 rounded-3xl shadow-2xl flex items-center gap-4 min-w-[200px]"
          >
            <i data-lucide="clock" class="w-8 h-8 text-[#d4a15a]"></i>
            <div>
              <div class="text-sm opacity-70">Temps total</div>
              <div class="font-bold text-lg">25 min</div>
            </div>
          </div>

          <div
            class="bg-white/95 backdrop-blur px-8 py-5 rounded-3xl shadow-2xl flex items-center gap-4 min-w-[200px]"
          >
            <i data-lucide="users" class="w-8 h-8 text-[#d4a15a]"></i>
            <div>
              <div class="text-sm opacity-70">Portions</div>
              <div class="font-bold text-lg">4 personnes</div>
            </div>
          </div>

          <div
            class="bg-white/95 backdrop-blur px-8 py-5 rounded-3xl shadow-2xl flex items-center gap-4 min-w-[200px]"
          >
            <i data-lucide="flame" class="w-8 h-8 text-[#d4a15a]"></i>
            <div>
              <div class="text-sm opacity-70">Difficulté</div>
              <div class="font-bold text-lg">Moyen</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Grille de contenu -->
      <div
        class="px-8 md:px-20 max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 lg:gap-20"
      >
        <!-- Ingrédients avec cases à cocher -->
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl">
          <h2 class="text-3xl font-bold mb-8 flex items-center gap-4">
            <i
              data-lucide="shopping-basket"
              class="w-10 h-10 text-[#d4a15a]"
            ></i>
            Ingrédients
          </h2>
          <ul class="space-y-5 text-lg">
            <li class="flex items-center gap-5">
              <input type="checkbox" class="w-7 h-7 rounded checkbox-custom" />
              <label>100 g de chocolat noir (70% idéalement)</label>
            </li>
            <li class="flex items-center gap-5">
              <input type="checkbox" class="w-7 h-7 rounded checkbox-custom" />
              <label>100 g de beurre doux + un peu pour les moules</label>
            </li>
            <li class="flex items-center gap-5">
              <input type="checkbox" class="w-7 h-7 rounded checkbox-custom" />
              <label>3 œufs moyens</label>
            </li>
            <li class="flex items-center gap-5">
              <input type="checkbox" class="w-7 h-7 rounded checkbox-custom" />
              <label>80 g de sucre en poudre</label>
            </li>
            <li class="flex items-center gap-5">
              <input type="checkbox" class="w-7 h-7 rounded checkbox-custom" />
              <label>50 g de farine T55</label>
            </li>
          </ul>
        </div>

        <!-- Préparation -->
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl">
          <h2 class="text-3xl font-bold mb-10 flex items-center gap-4">
            <i data-lucide="chef-hat" class="w-10 h-10 text-[#d4a15a]"></i>
            Préparation
          </h2>
          <ol class="space-y-8">
            <li class="flex gap-6">
              <span class="step-number">1</span>
              Préchauffer le four à 200°C. Beurrer et chemiser 4 ramequins.
            </li>
            <li class="flex gap-6">
              <span class="step-number">2</span>
              Faire fondre chocolat + beurre. Laisser tiédir.
            </li>
            <li class="flex gap-6">
              <span class="step-number">3</span>
              Fouetter œufs + sucre jusqu’à blanchiment.
            </li>
            <li class="flex gap-6">
              <span class="step-number">4</span>
              Verser le chocolat tiède et mélanger.
            </li>
            <li class="flex gap-6">
              <span class="step-number">5</span>
              Ajouter la farine, mélanger délicatement.
            </li>
            <li class="flex gap-6">
              <span class="step-number">6</span>
              Répartir dans les ramequins. Cuire <strong>9–11 min</strong>.
            </li>
            <li class="flex gap-6">
              <span class="step-number">7</span>
              Repos 2 min, démouler et servir avec glace vanille.
            </li>
          </ol>
          <div
            class="mt-12 bg-[#fbe7cd] rounded-2xl p-6 text-[#7a3c18] font-medium text-center"
          >
            Astuce secrète : congeler 30 min avant cuisson = cœur ultra coulant!
          </div>
        </div>
      </div>
        <!--Footer-->
      <?php include "../../frontend/view/components/_footer.html.php"; ?>
    </div>

    <!-- ===================== VERSION UNIQUEMENT POUR L'IMPRESSION (1 page) ===================== -->
    <div id="printable" class="hidden">
      <h1>Fondant au Chocolat Cœur Coulant</h1>
      <p style="text-align: center; font-size: 15pt; margin-bottom: 20mm">
        4 personnes • 25 minutes • Niveau moyen
      </p>

      <h2>Ingrédients</h2>
      <ul>
        <li>100 g de chocolat noir (70 %)</li>
        <li>100 g de beurre doux + un peu pour les moules</li>
        <li>3 œufs moyens</li>
        <li>80 g de sucre en poudre</li>
        <li>50 g de farine T55</li>
        <li><em>Optionnel : cacao amer pour chemiser</em></li>
      </ul>

      <h2>Préparation</h2>
      <ol>
        <li>Préchauffer le four à 200 °C. Beurrer et chemiser 4 ramequins.</li>
        <li>Faire fondre chocolat + beurre. Laisser tiédir.</li>
        <li>Fouetter œufs + sucre jusqu’à blanchiment (2-3 min).</li>
        <li>Ajouter le chocolat tiède et mélanger.</li>
        <li>Incorporer la farine en une fois.</li>
        <li>
          Répartir dans les ramequins. Cuire <strong>9 à 11 min</strong> (centre
          tremblotant).
        </li>
        <li>Repos 2 min, démouler et servir avec glace vanille.</li>
      </ol>

      <div class="tip">
        <strong>Astuce infaillible :</strong> Congeler les ramequins remplis 30
        minutes avant cuisson → cœur ultra coulant (cuisson 8-9 min seulement).
      </div>
    </div>

    <script>
      lucide.createIcons();
    </script>
  </body>
</html>
