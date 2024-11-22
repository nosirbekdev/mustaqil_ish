<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { box-sizing: border-box; }

/* FlipBook */

.vc {
  /* or any other parent wrapper */
  margin: 0;
  display: flex;
  min-height: 100dvh;
  perspective: 1000px;
  font: 1em/1.4 "Poppins", sans-serif;
  overflow: hidden;
  color: hsl(180 68% 5%);
  background-image: radial-gradient(circle farthest-corner at 50% 50%, hsl(187 20% 88%) 30%, hsl(149 20% 94%) 100%);
}

.book {
  position: relative;
  display: flex;
  margin: auto;
  width: 40cqmin;
  /*1* let pointer event go trough pages of lower Z than .book */
  pointer-events: none;
  transform-style: preserve-3d;
  transition: translate 1s;
  translate: calc(min(var(--c), 1) * 50%) 0%;
  /* Incline on the X axis for pages preview */
  rotate: 1 0 0 30deg;
}

.page {
  /* PS: Don't go below thickness 0.5 or the pages might transpare */
  --thickness: 4;
  flex: none;
  display: flex;
  width: 100%;
  font-size: 2cqmin;
  /*1* allow pointer events on pages */
  pointer-events: all;
  user-select: none;
  transform-style: preserve-3d;
  transform-origin: left center;
  transition:
    transform 1s,
    rotate 1s ease-in calc((min(var(--i), var(--c)) - max(var(--i), var(--c))) * 50ms);
  translate: calc(var(--i) * -100%) 0px 0px;
  transform: translateZ( calc((var(--c) - var(--i) - 0.5) * calc(var(--thickness) * .23cqmin)));
  rotate: 0 1 0 calc(clamp(0, var(--c) - var(--i), 1) * -180deg);
}

.front,
.back {
  position: relative;
  flex: none;
  width: 100%;
  backface-visibility: hidden;
  overflow: hidden;
  background-color: #fff;
  /* Fix backface visibility Firefox: */
  translate: 0px;
}

.back {
  translate: -100% 0;
  rotate: 0 1 0 180deg;
}


/* That's it. Your FlipBook customization styles: */

.book {
  counter-reset: page -1;
  & a {
    color: inherit;
  }
}

.page {
  box-shadow: 0em .5em 1em -.2em #00000020;
}

.front,
.back {
  display: flex;
  flex-flow: column wrap;
  justify-content: space-between;
  padding: 2em;
  border: 1px solid #0002;

  &:has(img) {
    padding: 0;
  }

  & img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  &::after {
    position: absolute;
    bottom: 1em;
    counter-increment: page;
    content: counter(page) ".";
    font-size: 0.8em;
  }
}
.cover {
  &::after {
    content: "";
  }
}
.front {
  &::after {
    right: 1em;
  }
  background: linear-gradient(to left, #f7f7f7 80%, #eee 100%);
  border-radius: .1em .5em .5em .1em;
}
.back {
  &::after {
    left: 1em;
  }
  background-image: linear-gradient(to right, #f7f7f7 80%, #eee 100%);
  border-radius: .5em .1em .1em .5em;
}

.cover {
  background: radial-gradient(circle farthest-corner at 80% 20%, hsl(150 80% 20% / .3) 0%, hsl(170 60% 10% / .1) 100%),
    hsl(231, 32%, 29%) url("https://picsum.photos/id/984/800/900") 50% / cover;
  color: hsl(200 30% 98%);
}
    </style>
</head>
<body>
<div class="vc">
<div class="book">
  <!-- Sahifa 1 -->
  <div class="page">
    <div class="front cover">
      <h1>FlipBook</h1>
      <p>2024.<br>Ikkinchi nashr</p>
    </div>
    <div class="back">
      <h2>Qiziqarli dasturlash</h2>
      <p>Dasturlash tillari haqida oddiy, ammo foydali ma'lumotlar.</p>
    </div>
  </div>

  <!-- Sahifa 2 -->
  <div class="page">
    <div class="front">
      <h2>JavaScript</h2>
      <p>JavaScript – bu veb-ilovalar va saytlarni interaktiv qilish uchun foydalaniladigan dasturlash tili.
         U oddiy qilib aytganda, veb sahifalaringizga hayot baxsh etadi.</p>
    </div>
    <div class="back">
      <ul>
        <li>Dinamik tarkib yaratish</li>
        <li>DOM bilan ishlash</li>
        <li>Frontend va Backend uchun ishlatiladi</li>
      </ul>
    </div>
  </div>

  <!-- Sahifa 3 -->
  <div class="page">
    <div class="front">
      <h2>Python</h2>
      <p>Python – sodda va kuchli dasturlash tili. U tahliliy dasturlar, veb-ishlanmalar va sun'iy intellekt uchun ishlatiladi.</p>
    </div>
    <div class="back">
      <ul>
        <li>Sintaksisi oddiy va oson o'qiladi</li>
        <li>Katta hajmli kutubxonalar</li>
        <li>Data Science va AI uchun mukammal</li>
      </ul>
    </div>
  </div>

  <!-- Sahifa 4 -->
  <div class="page">
    <div class="front">
      <h2>Nima uchun JavaScript?</h2>
      <p>Veb dasturlarni yaratishda keng qo'llaniladi. Framework'lar (React, Vue, Angular) orqali tez rivojlantirish mumkin.</p>
    </div>
    <div class="back">
      <p>JavaScript orqali o'yinlar, real vaqtli dasturlar va hatto mobil ilovalar yaratish mumkin.</p>
    </div>
  </div>

  <!-- Sahifa 5 -->
  <div class="page">
    <div class="front">
      <h2>Nima uchun Python?</h2>
      <p>Python yangi boshlovchilar uchun ideal dasturlash tili hisoblanadi. U sodda va ko'p yo'nalishda ishlatiladi.</p>
    </div>
    <div class="back">
      <p>Python orqali mashina o'rganish, sun'iy intellekt, veb-saytlar va avtomatlashtirish uchun dasturlar yaratish mumkin.</p>
    </div>
  </div>

  <!-- Sahifa 6 -->
  <div class="page">
    <div class="front">
      <img src="https://picsum.photos/id/1073/600/600" alt="Dasturlash">
    </div>
    <div class="back cover">
      <h3>Bu hali boshlanishi...</h3>
      <p>Dasturlashni o'rganishda davom eting va yangi texnologiyalarni o'zlashtiring!</p>
    </div>
  </div>
</div>

</div>

<script>
const flipBook = (elBook) => {
  let currentPage = 1;
  let direction = 1;
  const totalPages = elBook.querySelectorAll(".page").length;

  elBook.style.setProperty("--c", currentPage);

  elBook.querySelectorAll(".page").forEach((page, idx) => {
    page.style.setProperty("--i", idx);
    page.addEventListener("click", (evt) => {
      if (evt.target.closest("a")) return;
      currentPage = evt.target.closest(".back") ? idx : idx + 1;
      elBook.style.setProperty("--c", currentPage);
    });
  });

  setInterval(() => {
    if (currentPage === totalPages - 1 && direction === 1) {
      direction = -1;
    } else if (currentPage === 1 && direction === -1) {
      direction = 1;
    }
    currentPage += direction;
    elBook.style.setProperty("--c", currentPage);
  }, 3000);
};

document.querySelectorAll(".book").forEach(flipBook);



</script>
</body>
</html>
