<?php
session_start();
require_once '../php/visits.php';
require_once 'comments-service.php';
require_once '../php/auto-logout.php';
$counter = getVisitsCounter();

$isLoggedIn = isset($_SESSION['username']);
if ($isLoggedIn) {
  $username = $_SESSION['username'];
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Zakamarki Kryptografii | Algorytm szyfrowania probabilistycznego</title>
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
  <div id="user-menu">
    <?php if ($isLoggedIn) : ?>
      <p>Zalogowano jako <span><?php echo $username; ?></span></p>
      <a class="user-menu-button" href="../index.php?logout='1'">Wyloguj</a>
    <?php else: ?>
      <a class="user-menu-button" href="../auth/login.php">Zaloguj</a>
      <a class="user-menu-button" href="../auth/register.php">Zarejestruj</a>
    <?php endif ?>
  </div>
</nav>
<header class="all-center photo-background">
  <a class="all-center" href="../index.php">
    <h1>Zakamarki Kryptografii</h1>
    <h2>Aleksandra Malinowska</h2>
  </a>
</header>
<main class="all-center">
  <article>
    <h1 class="article-title">Schemat Goldwasser-Micali szyfrowania probabilistycznego</h1>
    <section>
      <h2>Algorytm generowania kluczy</h2>
      <p>Schemat Goldwasser-Micali wymaga wygenerowania klucza prywatnego i publicznego. Proces tworzenia tych
        kluczy
        przedstawia poniższy algorytm.
      </p>
      <ol class="algorithm">
        <li>Wybierz losowo dwie duże liczby pierwsze $p$ oraz $q$ (podobnego rozmiaru)</li>
        <li>Policz $n = pq$</li>
        <li>Wybierz $y \in \mathbb{Z_n}$, takie, że $y$ jest nieresztą kwadratową modulo $n$ i symbol Jakobiego
          $\left(\frac{y}{n}\right) = 1$ (czyli $y$ jest pseudokwadratem modulo $n$)
        </li>
      </ol>
      <p>Otrzymana w ten sposób para $(n,y)$ stanowi klucz publiczny, zaś odpowiadający mu klucz prywatny to para
        $(p,q)$.
      </p>
    </section>
    <section>
      <h2>Algorytm szyfrowania</h2>
      <p>Chcąc zaszyfrować wiadomość $m$ przy użyciu klucza publicznego $(n, y)$ należy wykonać przedstawiony
        poniżej
        algorytm.
      </p>
      <ol class="algorithm">
        <li>Przedstaw $m$ w postaci łańcucha binarnego $m=m_1m_2...m_t$ długości $t$</li>
        <li class="pseudocode">
          <p>For $i$ from $1$ to $t$ do</p>
          <p class="tab-1">wybierz losowe $x \in \mathbf{Z_n^*}$</p>
          <p class="tab-1">If $m_i = 1$ then set $c_i \leftarrow yx^2 \mod n$</p>
          <p class="tab-1">Else set $c_i \leftarrow x^2 \mod n$</p>
        </li>
      </ol>
      <p>Kryptogram wiadomości $m$ stanowi $c = (c_1,c_2,...,c_t)$.</p>
    </section>
    <section>
      <h2>Algorytm deszyfrowania</h2>
      <p>Chcąc odzyskać wiadomość z kryptogramu $c$ przy użyciu klucza prywatnego $(p,q)$ należy przeprowadzić
        poniższy
        algorytm.
      </p>
      <ol class="algorithm">
        <li class="pseudocode">
          <p>For $i$ from $1$ to $t$ do</p>
          <p class="tab-1">policz symbol Legendre'a $e_i = \left( \frac{c_i}{p}\right)$ (algorytm
            $(\ref{jacobi})$)</p>
          <p class="tab-1">If $e_i = 1$ then set $m_i \leftarrow 0$</p>
          <p class="tab-1">Else set $m_i \leftarrow 1$</p>
        </li>
      </ol>
      <p>Zdeszyfrowana wiadomość to $m = m_1m_2...m_t$.</p>
    </section>
    <hr class="break-point">
    <section>
      <h2>Reszta/niereszta kwadartowa</h2>
      <section class="definition">
        <h3>Definicja</h3>
        <p>Niech $a \in \mathbf{Z_n}$. Mówimy, ze $a$ jest
          <span>resztą kwadratową modulo $n$ (kwadartem modulo $n$)</span>, jeżeli
          istnieje $x \in \mathbf{Z_n^*}$ takie, że $x^2 \equiv a \mod p$. Jeżeli takie $x$ nie istnieje, to
          wówczas
          $a$ nazywamy <span>nieresztą
            kwadartową modulo $n$</span>.
          Zbiór wszystkich reszt kwadartowych modulo $n$ oznaczamy $Q_n$, zaś zbiór wszystkich niereszt
          kwadartowych
          modulo $n$ oznaczamy $\bar{Q_n}$.
        </p>
      </section>
    </section>
    <hr class="break-point">
    <section>
      <h2>Symbol Legendre'a</h2>
      <section class="definition">
        <h3>Definicja</h3>
        <p>Niech $p$ będzie nieparzystą liczbą pierwszą a $a$ liczbą całkowitą. <span>Symbol Legendre'a</span>
          $\left(\frac{a}{p}\right)$ jest zdefiniowany jako:
        <div class="math-container">
          $$
          \left(\frac{a}{p}\right) = \left\{
          \begin{array}{1}
          0 & \textrm{ jeżeli } p|a\\
          1 & \textrm{ jeżeli } a \in Q_p\\
          -1 & \textrm{ jeżeli } a \in \bar{Q_p}
          \end{array}
          \right.
          $$
        </div>
        </p>
      </section>
      <section class="definition">
        <h3>Własności</h3>
        <p>Niech $a,b \in \mathbb{Z}$, zaś $p$ to nieparzysta liczba pierwsza. Wówczas:</p>
        <ul class="math-container">
          <li>$\left(\frac{a}{p}\right) \equiv a^{\frac{p-1}{2}} \pmod p$</li>
          <li>$\left(\frac{ab}{p}\right) = \left(\frac{a}{p}\right) \left(\frac{b}{p}\right)$</li>
          <li>$a \equiv b \pmod{p} \Longrightarrow \left(\frac{a}{p}\right) = \left(\frac{b}{p}\right)$</li>
          <li>$\left(\frac{2}{p}\right) = (-1)^{\frac{(p^2 - 1)}{8}}$</li>
          <li>Jeżeli $q$ jest nieparzystą liczbą pierwszą inną od $p$ to: $$\left(\frac{p}{q}\right) =
            \left(\frac{q}{p}\right) \left(-1\right)^{\frac{(p-1)(q-1)}{4}}$$
          </li>
        </ul>
      </section>
    </section>
    <hr class="break-point">
    <section>
      <h2>Symbol Jacobiego</h2>
      <section class="definition">
        <h3>Definicja</h3>
        <p>Niech $n\geqslant3$ będzie liczbą nieparzystą a jej rozkład na czynniki pierwsze to
          $n=p_{1}^{e_1}p_{2}^{e_2}...p_{k}^{e_k}$
          . <span>Symbol Jacobiego</span> $\left(\frac{a}{n}\right)$ jest zdefiniowany jako:
        <div class="math-container">
          $$
          \bigg(\frac{a}{n}\bigg) = \bigg(\frac{a}{p_1}\bigg)^{e_1} \bigg(\frac{a}{p_2}\bigg)^{e_2} \dots
          \bigg(\frac{a}{p_k}\bigg)^{e_k}
          $$
        </div>
        </p>
        <p>Jeżeli $n$ jest liczbą pierwszą, to symbol Jacobiego jest symbolem Legendre'a.</p>
      </section>
      <section class="definition">
        <h3>Własności</h3>
        <p>Niech $a,b \in \mathbb{Z}$, zaś $m,n \geqslant 3$ to nieparzyste liczby całkowite. Wówczas:</p>
        <ul class="math-container">
          <li>$\left(\frac{a}{n}\right) = 0,1, \textrm{albo} -1$</li>
          <li>$\left(\frac{a}{n}\right) = 0 \iff gcd(a,n) \neq 1$</li>
          <li>$\left(\frac{ab}{n}\right) = \left(\frac{a}{n}\right)\left(\frac{b}{n}\right)$</li>
          <li>$\left(\frac{a}{mn}\right) = \left(\frac{a}{m}\right)\left(\frac{a}{n}\right)$</li>
          <li>$a \equiv b \pmod{n} \Longrightarrow \left(\frac{a}{n}\right) = \left(\frac{b}{n}\right)$</li>
          <li>$\left(\frac{1}{n}\right) = 1$</li>
          <li>$\left(\frac{-1}{n}\right) = (-1)^{\frac{n-1}{2}}$</li>
          <li>$\left(\frac{2}{n}\right) = (-1)^{\frac{n^2-1}{8}}$</li>
          <li>$\left(\frac{m}{n}\right) = \left(\frac{n}{m}\right) \left(-1\right)^{\frac{(m-1)(n-1)}{4}}$
          </li>
        </ul>
        <p>Z własności symbolu Jacobiego wynika, że jeżeli $n$ nieparzyste oraz $a$ nieparzyste i w postaci $a =
          2^ea_1$, gdzie $a_1$ też nieparzyste to:
        <div class="math-container">
          $$
          \bigg(\frac{a}{n}\bigg) = \bigg(\frac{2^e}{n}\bigg)\bigg(\frac{a_1}{n}\bigg)
          = \bigg(\frac{2}{n}\bigg)^e\bigg(\frac{n \mod
          a_1}{a_1}\bigg)\left(-1\right)^{\frac{(a_1-1)(n-1)}{4}}
          $$
        </div>
        </p>
      </section>
    </section>
    <hr class="break-point">
    <section>
      <h2>Algorytm obliczania symbolu Jacobiego (i Legendre'a)</h2>
      <p>Niech $n$ będzie nieparzystą liczbą całkowitą i $n \geqslant 3$ oraz niech $a$ będzie liczbą całkowitą
        taką, że
        $0 \leqslant a < n$. Wtedy algorytm obliczania symbolu Jacobiego ($Jacobi(a,n)$) przedstawia się
        następująco:
      </p>
      <ol class="algorithm pseudocode">
        $$\begin{equation} Jacobi(a,n) \tag{*} \label{jacobi} \end{equation}$$
        <li>If $a = 0$ then return $0$</li>
        <li>If $a=1$ then return $1$</li>
        <li>Write $a=2^ea_1$, gdzie $a_1$ nieparzyste</li>
        <li>If $e$ parzyste set $s \leftarrow 1$<br>Else set $s \leftarrow 1$ if $n \equiv 1 \lor 7 \pmod 8$, or
          set
          $s \leftarrow -1$ if $n \equiv 3 \lor 5 \pmod 8$
        </li>
        <li>If $n \equiv 3 \pmod 4$ and $a_1 \equiv 3 \pmod 4$ then set $s \leftarrow -s$</li>
        <li>Set $n_1 \leftarrow n \mod a_1$</li>
        <li>If $a_1 = 1$ then return $s$<br>Else return $s\cdot Jacobi(n_1,a_1)$</li>
      </ol>
      <p>Czas działania tego algorytmu wynosi $\mathcal{O}((\lg{n})^2)$ operacji bitowych.</p>
    </section>
    <hr class="break-point">
    <section>
      <h2>Komentarze</h2>
      <div id="add-comment">
        <?php if (isset($_SESSION['username'])) : ?>
          <form method="post" action="schemat-progowy.php">
            <input type="hidden" name="article-id" value="1">
            <input type="hidden" name="author" value='<?php echo "$username"; ?>'/>
            <label>Treść komentarza
              <textarea name="comment" rows="3" placeholder="Tu wpisz komentarz..." required></textarea>
            </label>
            <input type="submit" value="Dodaj" name="add-comment" class="btn-submit">
          </form>
        <?php else: ?>
          <p>Tylko zalogowani użytkownicy mogą dodawać komentarze</p>
          <a href="../auth/login.php" class="btn-sign">Zaloguj się</a>
        <?php endif ?>

      </div>
      <?php $articleId = 1; ?>
      <div id="comments">
        <?php include('comments.php'); ?>
      </div>
    </section>
  </article>
</main>
<footer class="all-center">
  <p>2020 &copy; AM. Wszystkie prawa zastrzeżone. <a href="../php/cookie-policy.php">Polityka cookies</a></p>
</footer>
<?php include("../php/cookies.php"); ?>
</body>
</html>
