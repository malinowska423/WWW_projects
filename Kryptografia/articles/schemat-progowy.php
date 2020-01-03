<?php
require_once '../php/visits.php';
$counter = getVisitsCounter();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Zakamarki Kryptografii | Schemat progowy dzielenia sekretu Shamira</title>
  <link rel="Shortcut icon" href="../img/icon.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
      window.MathJax = {
          tex: {
              tags: 'ams',
              inlineMath: [['$', '$'], ['\\(', '\\)']]
          },
          "HTML-CSS": {
              linebreaks: {automatic: true}
          },
          "SVG": {
              linebreaks: {automatic: true}
          }
      };
  </script>

  <script type="text/javascript" id="MathJax-script" async
          src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
  <link rel="Stylesheet" type="text/css" href="../css/styles.css"/>
  <link rel="Stylesheet" type="text/css" href="../css/desktop.css"/>
  <link rel="Stylesheet" type="text/css" href="../css/article.css"/>
  <link rel="Stylesheet" type="text/css" href="../css/article-desktop.css"/>
</head>
<body>
<nav>
    <div id="visit-counter">
        <p>Odwiedzono <span><?php echo $counter ?></span> <?php echo($counter == 1 ? "raz" : "razy") ?>
        </p>
    </div>
    <div id="user-menu"></div>
</nav>
<header class="all-center photo-background">
  <a class="all-center" href="../index.php">
    <h1>Zakamarki Kryptografii</h1>
    <h2>Aleksandra Malinowska</h2>
  </a>
</header>
<main class="all-center">
  <article>
    <h1 class="article-title">Schemat progowy $(t,n)$ dzielenia sekretu Shamira</h1>
    <section>
      <h2>Algorytm</h2>
      <ol class="algorithm">
        <h3>Cel</h3>
        <li>Zaufana Trzecia Strona $T$ ma sekret $S \geqslant 0$, który chce podzielić pomiędzy $n$ uczestników
          tak, aby dowolnych $t$ spośród nich mogło sekret odtworzyć.
        </li>
        <h3>Faza inicjalizacji</h3>
        <li>$T$ wybiera liczbę pierwszą $p > max(S,n)$ i definiuje $a_0 = S$</li>
        <li>$T$ wybiera losowo i niezależnie $t-1$ współczynników $a_1,\dots,a_{t-1} \in \mathbf{Z_p}$</li>
        <li>$T$ definiuje wielomian nad $\mathbf{Z_p}$: $$f(x) = a_0 + \sum_{j=0}^{t-1} a_jx^j$$</li>
        <li>Dla $1 \leqslant i \leqslant n$ Zaufana Trzecia Strona $T$ wybiera losowo $x_i \in \mathbf{Z_p}$,
          oblicza:
          $$
          \begin{equation} \tag{*} \label{s}
          S_i = f(x_i) \mod p
          \end{equation}
          $$
          i bezpiecznie przekazuje parę $(x_i,S_i)$ użytkownikowy $P_i$
        </li>
        <h3>Faza łączenia udziałów w sekret</h3>
        <li>Dowolna grupa $t$ lub więcej użytkowników łączy swoje udziały - $t$ różnych punktów $(x_i,S_i)$
          wielomianu $f$ i dzięki interpolacji Lagrange'a odzyskuje sekret $S=a_0=f(0)$
        </li>
      </ol>
    </section>
    <hr class="break-point">
    <section>
      <h2>Interpolacja Lagrange'a</h2>
      <p>Mając dane $t$ różnych punktów $(x_i,y_i)$ nieznanego wielomianu $f$ stopnia mniejszego od $t$ możemy
        policzyć jego współczynniki korzystając ze wzoru:
        <span class="math-container">
          $$
          \begin{equation}
            f(x) = \sum_{i=1}^{t} \left(y_i \prod_{1 \leqslant j \leqslant t,\, j \neq i} \frac{x-x_j}{x_i-x_j} \right)
          \mod p
          \label{sh}
          \end{equation}
          $$
        </span>
      </p>
      <p>W schemacie Shamira, aby odzyskać sekret $S$, użytkownicy nie muszą znać całego wielomianu $f$. Wstawiając
        do wzoru na interpolację Lagrange'a $x=0$, dostajemy wersję uproszczoną, ale wystarczającą aby policzyć
        sekret $S=f(0)$:
        <span class="math-container">
          $$
          \begin{equation}
            f(x) = \sum_{i=1}^{t} \left(y_i \prod_{1 \leqslant j \leqslant t,\, j \neq i} \frac{x_j}{x_j-x_i} \right)
          \mod p
          \label{sh2}
          \end{equation}
          $$
        </span>
      </p>
    </section>
    <hr class="break-point">
    <section>
      <h2>Przykład</h2>
      <p>Sekret dzielony jest na 5 części: $S_1,S_2,S_3,S_4,S_5$. Każdy udziałowiec otrzymuje jedną część sekretu.
        Można go odtworzyć, jeśli zestawione zostaną każde trzy jego części.
      </p>
      <p>Ustalone są wartości $n=5$ oraz $k=3$, zatem rozważany jest schemat progowy Shamira (3,5).</p>
      <p>Niech $p=29$, $S=23$, $a_1 = 12$, $a_2=9$ oraz $x_i = i+2, i=1,\ldots,5$. Odpowiedni wielomian przyjmuje
        postać $$a(x) = 23 + 12x + 9x^2.$$
      </p>
      <p>Poszczególne fragmenty sekretu, liczone według wzoru ($\ref{s}$), przyjmują wartości:
        <span class="math-container">
        $$
        \begin{array}{1}
        S_1 = a(x_1) \mod 29 = 24, \\
        S_2 = a(x_2) \mod 29 = 12, \\
        S_3 = a(x_3) \mod 29 = 18, \\
        S_4 = a(x_4) \mod 29 = 13, \\
        S_5 = a(x_5) \mod 29 = 26,
        \end{array}
        $$
      </span>
      </p>
      <p>Trzej przykładowi udziałowcy sekretu $P_1$, $P_2$ i $P_4$ chcąc uzyskać sekret, obliczają
        <span class="math-container">
        $$
        a(0) = 24 \cdot \frac{4}{1} \cdot \frac{6}{3} + 12 \cdot \left( \frac{3}{-1} \right) \cdot \frac{6}{2} + 13
        \cdot
        \left( \frac{3}{-3} \right) \cdot \left( \frac{4}{-2} \right) = 110
        $$
      </span>
        na podstawie wzoru ($\ref{sh2}$) otrzymuje się wartość sekretu $$S = a(0) \mod 29 = 23.$$
      </p>
    </section>
  </article>
</main>
<footer class="all-center">
  <p>2019 &copy; AM. Wszystkie prawa zastrzeżone.</p>
</footer>
</body>
</html>
