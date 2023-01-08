@if (session('message'))
<div class="alert alert-dark alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Kategóriák
Adminisztráció, irodai munka
Fizikai, segéd, betanított munka
Diákmunka
Egészségügy, gyógyszeripar
Építőipar, építészet
Gyártás, termelés
Informatika, telekommunikáció
Jog, közigazgatás
Kereskedelem, értékesítés
Közgazdaság, bank, biztosítás
Marketing, média, újságírás, PR
Menedzsment
Mérnök, műszaki, villamossági
Mezőgazdaság, környezetvédelem
Munkaügy, munkavédelem
Művészet, kultúra
Nyomdaipar, dekoráció
Oktatás, fordítás, tolmácsolás
Őrzés-védelem
Pénzügy, számvitel, kontrolling
Raktározás, logisztika
Szakmunka
Szállítás, fuvarozás
Vendéglátás
Vevő-, ügyfélszolgálat
Egyéb munkalehetőségek


legtöbb jelentkező --}}
